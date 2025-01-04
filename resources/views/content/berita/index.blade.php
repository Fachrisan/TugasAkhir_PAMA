@extends('layouts/contentNavbarLayout')

@section('title', 'Daftar Berita')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Daftar Berita</span>
</h4>

@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('berita.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Tambah Berita</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Judul Berita</label>
            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
            @error('judul')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>Isi Berita</label>
            <textarea name="berita" class="form-control @error('berita') is-invalid @enderror" required>{{ old('berita') }}</textarea>
            @error('berita')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" required>
            @error('tanggal')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Tambah Berita</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Tombol untuk memunculkan modal tambah -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
  Tambah Berita
</button>

<!-- Input Pencarian -->
<div class="mb-3 mt-3">
  <input type="text" id="searchInput" class="form-control" placeholder="Cari berita...">
</div>

<div class="card mt-3">
  <div class="card">
    <h5 class="card-header">Tabel Berita</h5>
    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <table class="table table-bordered" id="beritaTable">
          <thead>
            <tr>
              <th>Judul</th>
              <th>Isi Berita</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($beritas as $berita)
            <tr>
              <td>{{ $berita->judul }}</td>
              <td>{{ Str::limit($berita->berita, 50) }}</td>
              <td>{{ $berita->tanggal }}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <!-- Modal Edit -->
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $berita->id_berita }}">
                      <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>

                    <!-- Form Delete -->
                    <form action="{{ route('berita.destroy', $berita->id_berita) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                        <i class="bx bx-trash me-1"></i> Delete
                      </button>
                    </form>
                  </div>
                </div>
              </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $berita->id_berita }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="{{ route('berita.update', $berita->id_berita) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel">Edit Berita</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="judul{{ $berita->judul }}" class="form-label">Judul Berita</label>
                        <input type="text" name="judul" class="form-control" id="judul{{ $berita->judul }}" value="{{ $berita->judul }}" required>
                      </div>
                      <div class="mb-3">
                        <label for="berita{{ $berita->berita }}" class="form-label">Isi Berita</label>
                        <textarea name="berita" class="form-control" id="berita{{ $berita->berita }}" required>{{ $berita->berita }}</textarea>
                      </div>
                      <div class="mb-3">
                        <label for="tanggal{{ $berita->tanggal }}" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" id="tanggal{{ $berita->tanggal }}" value="{{ $berita->tanggal }}" required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById("searchInput").addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#beritaTable tbody tr");

    rows.forEach(row => {
      let judul = row.cells[0].textContent.toLowerCase();
      let isi = row.cells[1].textContent.toLowerCase();
      if (judul.includes(filter) || isi.includes(filter)) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
</script>
@endsection
