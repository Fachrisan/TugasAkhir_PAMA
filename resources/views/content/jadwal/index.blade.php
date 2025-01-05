@extends('layouts/contentNavbarLayout')

@section('title', 'Daftar Jadwal Kuliah')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Daftar Jadwal Kuliah</span>
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
      <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Tambah Jadwal Kuliah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Mata Kuliah</label>
            <select name="id_matkul" class="form-control @error('id_matkul') is-invalid @enderror" required>
              <option value="">Pilih Mata Kuliah</option>
              @foreach($matkuls as $matkul)
                <option value="{{ $matkul->id_matkul }}">{{ $matkul->nama }} ({{ $matkul->sks }} SKS)</option>
              @endforeach
            </select>
            @error('id_matkul')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>Dosen</label>
            <select name="id_dosen" class="form-control @error('id_dosen') is-invalid @enderror" required>
              <option value="">Pilih Dosen</option>
              @foreach($dosens as $dosen)
                <option value="{{ $dosen->id_dosen }}">{{ $dosen->nama }}</option>
              @endforeach
            </select>
            @error('id_dosen')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>Hari</label>
            <select name="hari" class="form-control @error('hari') is-invalid @enderror" required>
              <option value="">Pilih Hari</option>
              <option value="Senin">Senin</option>
              <option value="Selasa">Selasa</option>
              <option value="Rabu">Rabu</option>
              <option value="Kamis">Kamis</option>
              <option value="Jumat">Jumat</option>
              <option value="Sabtu">Sabtu</option>
            </select>
            @error('hari')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>Jam</label>
            <input type="text" name="jam" class="form-control @error('jam') is-invalid @enderror" placeholder="08:00 - 10:00" required>
            @error('jam')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>Ruangan</label>
            <input type="text" name="ruangan" class="form-control @error('ruangan') is-invalid @enderror" required>
            @error('ruangan')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Tambah Jadwal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Tombol untuk memunculkan modal tambah -->
@if(Auth::user()->level === 'admin')
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
  Tambah Jadwal
</button>
@endif
<!-- Input Pencarian -->
<div class="mb-3 mt-3">
  <input type="text" id="searchInput" class="form-control" placeholder="Cari jadwal...">
</div>

<div class="card mt-3">
  <div class="card">
    <h5 class="card-header">Tabel Jadwal Kuliah</h5>
    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <table class="table table-bordered" id="jadwalTable">
          <thead>
            <tr>
              <th>ID Mata Kuliah</th>
              <th>Mata Kuliah</th>
              <th>SKS</th>
              <th>Dosen</th>
              <th>Hari</th>
              <th>Jam</th>
              <th>Ruangan</th>
              @if(Auth::user()->level === 'admin')
              <th>Aksi</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($jadwals as $jadwal)
            <tr>
              <td>{{$jadwal->matkul->id_matkul}}</td>
              <td>{{ $jadwal->matkul->nama }}</td>
              <td>{{ $jadwal->matkul->sks }}</td>
              <td>{{ $jadwal->dosen->nama }}</td>
              <td>{{ $jadwal->hari }}</td>
              <td>{{ $jadwal->jam }}</td>
              <td>{{ $jadwal->ruangan }}</td>
              @if(Auth::user()->level === 'admin')
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <!-- Modal Edit -->
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $jadwal->id_jadwal }}">
                      <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>

                    <!-- Form Delete -->
                    <form action="{{ route('jadwal.destroy', $jadwal->id_jadwal) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">
                        <i class="bx bx-trash me-1"></i> Delete
                      </button>
                    </form>
                  </div>
                </div>
              </td>
              @endif
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $jadwal->id_jadwal }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="{{ route('jadwal.update', $jadwal->id_jadwal) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel">Edit Jadwal</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label>Mata Kuliah</label>
                        <select name="id_matkul" class="form-control" required>
                          @foreach($matkuls as $matkul)
                            <option value="{{ $matkul->id_matkul }}" {{ $jadwal->id_matkul == $matkul->id_matkul ? 'selected' : '' }}>
                              {{ $matkul->nama }} ({{ $matkul->sks }} SKS)
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label>Dosen</label>
                        <select name="id_dosen" class="form-control" required>
                          @foreach($dosens as $dosen)
                            <option value="{{ $dosen->id_dosen }}" {{ $jadwal->id_dosen == $dosen->id_dosen ? 'selected' : '' }}>
                              {{ $dosen->nama }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label>Hari</label>
                        <select name="hari" class="form-control" required>
                          @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                            <option value="{{ $hari }}" {{ $jadwal->hari == $hari ? 'selected' : '' }}>
                              {{ $hari }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label>Jam</label>
                        <input type="text" name="jam" class="form-control" value="{{ $jadwal->jam }}" required>
                      </div>
                      <div class="mb-3">
                        <label>Ruangan</label>
                        <input type="text" name="ruangan" class="form-control" value="{{ $jadwal->ruangan }}" required>
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
    let rows = document.querySelectorAll("#jadwalTable tbody tr");

    rows.forEach(row => {
      let matkul = row.cells[0].textContent.toLowerCase();
      let dosen = row.cells[2].textContent.toLowerCase();
      let hari = row.cells[3].textContent.toLowerCase();
      if (matkul.includes(filter) || dosen.includes(filter) || hari.includes(filter)) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
</script>
@endsection
