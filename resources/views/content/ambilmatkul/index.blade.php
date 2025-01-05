@extends('layouts/contentNavbarLayout')

@section('title', 'Pengambilan Mata Kuliah')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Pengambilan Mata Kuliah</span>
</h4>

@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('ambilmatkul.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Ambil Mata Kuliah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Mata Kuliah</label>
            <select name="id_matkul" class="form-control @error('id_matkul') is-invalid @enderror" required>
              <option value="">Pilih Mata Kuliah</option>
              @foreach($matkul as $mk)
                <option value="{{ $mk->id_matkul }}">{{ $mk->id_matkul }} - {{ $mk->nama }} ({{ $mk->sks }} SKS)</option>
              @endforeach
            </select>
            @error('id_matkul')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Ambil Mata Kuliah</button>
        </div>
      </form>
    </div>
  </div>
</div>

@if(Auth::user()->level === 'mahasiswa')
<!-- Tombol untuk memunculkan modal tambah hanya untuk mahasiswa -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
  Ambil Mata Kuliah
</button>
@endif

<!-- Input Pencarian -->
<div class="mb-3 mt-3">
  <input type="text" id="searchInput" class="form-control" placeholder="Cari mata kuliah...">
</div>

<div class="card mt-3">
  <div class="card">
    <h5 class="card-header">Daftar Mata Kuliah yang Diambil</h5>
    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <table class="table table-bordered" id="ambilmatkulTable">
          <thead>
            <tr>
              <th>No</th>
              @if(Auth::user()->level !== 'mahasiswa')
              <th>NIM</th>
              @endif
              <th>Kode MK</th>
              <th>Nama Mata Kuliah</th>
              <th>SKS</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ambilmatkul as $key => $am)
            <tr>
              <td>{{ $key + 1 }}</td>
              @if(Auth::user()->level !== 'mahasiswa')
              <td>{{ $am->login->username }}</td>
              @endif
              <td>{{ $am->id_matkul }}</td>
              <td>{{ $am->nama }}</td>
              <td>{{ $am->sks }}</td>
              <td>
                @if(Auth::user()->level !== 'mahasiswa' || $am->id_user === Auth::user()->id_user)
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <!-- Modal Edit -->
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $am->id_ambilmatkul }}">
                      <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>

                    <!-- Form Delete -->
                    <form action="{{ route('ambilmatkul.destroy', $am->id_ambilmatkul) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item" onclick="return confirm('Apakah Anda yakin ingin membatalkan mata kuliah ini?');">
                        <i class="bx bx-trash me-1"></i> Batal
                      </button>
                    </form>
                  </div>
                </div>
                @endif
              </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $am->id_ambilmatkul }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="{{ route('ambilmatkul.update', $am->id_ambilmatkul) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel">Edit Mata Kuliah yang Diambil</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label>Mata Kuliah</label>
                        <select name="id_matkul" class="form-control" required>
                          @foreach($matkul as $mk)
                            <option value="{{ $mk->id_matkul }}" {{ $am->id_matkul == $mk->id_matkul ? 'selected' : '' }}>
                              {{ $mk->id_matkul }} - {{ $mk->nama }} ({{ $mk->sks }} SKS)
                            </option>
                          @endforeach
                        </select>
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
    let rows = document.querySelectorAll("#ambilmatkulTable tbody tr");

    rows.forEach(row => {
      let text = row.textContent.toLowerCase();
      if (text.includes(filter)) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
</script>
@endsection
