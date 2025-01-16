@extends('layouts/contentNavbarLayout')

@section('title', 'Daftar Mata Kuliah')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Daftar Mata Kuliah</span>
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
      <form action="{{ route('matkul.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Tambah Mata Kuliah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>ID Mata Kuliah</label>
            <input type="text" name="id_matkul" class="form-control @error('id_matkul') is-invalid @enderror" value="{{ old('id_matkul') }}" required>
            @error('id_matkul')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>Nama Mata Kuliah</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
            @error('nama')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>SKS</label>
            <input type="number" name="sks" class="form-control @error('sks') is-invalid @enderror" value="{{ old('sks') }}" required>
            @error('sks')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Tambah Mata Kuliah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Tombol untuk memunculkan modal tambah -->
@if(Auth::user()->level === 'admin')
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
  Tambah Mata Kuliah
</button>
@endif
<!-- Input Pencarian -->
<div class="mb-3 mt-3">
  <input type="text" id="searchInput" class="form-control" placeholder="Cari mata kuliah...">
</div>

<div class="card mt-3">
  <div class="card">
    <h5 class="card-header">Tabel Mata Kuliah</h5>
    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <table class="table table-bordered" id="matkulTable">
          <thead>
            <tr>
              <th>ID Mata Kuliah</th>
              <th>Nama Mata Kuliah</th>
              <th>SKS</th>
              @if(Auth::user()->level === 'admin')
              <th>Aksi</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($matkuls as $key => $matkul)
            <tr>
              <td>{{ $matkul->id_matkul }}</td>
              <td>{{ $matkul->nama }}</td>
              <td>{{ $matkul->sks }}</td>
              @if(Auth::user()->level === 'admin' || Auth::user()->level === 'dosen')
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <!-- Modal Edit -->
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $matkul->id_matkul }}">
                      <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>

                    <!-- Form Delete -->
                    <form action="{{ route('matkul.destroy', $matkul->id_matkul) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item" onclick="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?');">
                        <i class="bx bx-trash me-1"></i> Delete
                      </button>
                    </form>
                  </div>
                </div>
              </td>
              @endif
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $matkul->id_matkul }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="{{ route('matkul.update', $matkul->id_matkul) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel">Edit Mata Kuliah</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="id_matkul{{ $matkul->id_matkul }}" class="form-label">ID Mata Kuliah</label>
                        <input type="text" name="id_matkul" class="form-control" id="id_matkul{{ $matkul->id_matkul }}" value="{{ $matkul->id_matkul }}" required readonly>
                      </div>
                      <div class="mb-3">
                        <label for="nama{{ $matkul->id_matkul }}" class="form-label">Nama Mata Kuliah</label>
                        <input type="text" name="nama" class="form-control" id="nama{{ $matkul->id_matkul }}" value="{{ $matkul->nama }}" required>
                      </div>
                      <div class="mb-3">
                        <label for="sks{{ $matkul->id_matkul }}" class="form-label">SKS</label>
                        <input type="number" name="sks" class="form-control" id="sks{{ $matkul->id_matkul }}" value="{{ $matkul->sks }}" required>
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
    let rows = document.querySelectorAll("#matkulTable tbody tr");

    rows.forEach(row => {
      let id_matkul = row.cells[0].textContent.toLowerCase();
      let nama = row.cells[1].textContent.toLowerCase();
      if (id_matkul.includes(filter) || nama.includes(filter)) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
</script>
@endsection
