@extends('layouts/contentNavbarLayout')

@section('title', 'Data Mahasiswa')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Data Mahasiswa</span>
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
      <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Tambah Mahasiswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="id_user">NIM</label>
            <select name="id_user" id="id_user" class="form-control @error('id_user') is-invalid @enderror" required>
              <option value="" disabled selected>Pilih NIM Untuk Login</option>
              @foreach($users as $user)
                @if($user->level === 'mahasiswa')
                  <option value="{{ $user->id_user }}" {{ old('id_user') == $user->id_user ? 'selected' : '' }}>
                    {{ $user->username }} - {{ $user->name }}
                  </option>
                @endif
              @endforeach
            </select>
            @error('id_user')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>NIM</label>
            <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim') }}" required>
            @error('nim')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
            @error('nama')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat') }}</textarea>
            @error('alamat')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="telpon" class="form-control @error('telpon') is-invalid @enderror" value="{{ old('telpon') }}" required>
            @error('telpon')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
              <option value="">Pilih Jenis Kelamin</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
            @error('jenis_kelamin')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" required>
            @error('tanggal_lahir')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>Semester</label>
            <input type="number" name="semester" class="form-control @error('semester') is-invalid @enderror" value="{{ old('semester') }}" required>
            @error('semester')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>Tahun Ajaran</label>
            <input type="text" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" value="{{ old('tahun_ajaran') }}" required>
            @error('tahun_ajaran')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>Jurusan</label>
            <input type="text" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" value="{{ old('jurusan') }}" required>
            @error('jurusan')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
              <option value="aktif">Aktif</option>
              <option value="tidakaktif">Tidak Aktif</option>
            </select>
            @error('status')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Tambah Mahasiswa</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Tombol untuk memunculkan modal tambah -->
@if(Auth::user()->level === 'admin' || Auth::user()->level === 'dosen')
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
  Tambah Mahasiswa
</button>
@endif
<!-- Input Pencarian -->
<div class="mb-3 mt-3">
  <input type="text" id="searchInput" class="form-control" placeholder="Cari mahasiswa...">
</div>

<div class="card mt-3">
  <div class="card">
    <h5 class="card-header">Data Mahasiswa</h5>
    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <table class="table table-bordered" id="mahasiswaTable">
          <thead>
            <tr>
              <th>NIM</th>
              <th>Nama</th>
              <th>Jurusan</th>
              <th>Semester</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($mahasiswa as $mahasiswa)
            <tr>
              <td>{{ $mahasiswa->nim }}</td>
              <td>{{ $mahasiswa->nama }}</td>
              <td>{{ $mahasiswa->jurusan }}</td>
              <td>{{ $mahasiswa->semester }}</td>
              <td>
                <span class="badge bg-{{ $mahasiswa->status == 'aktif' ? 'success' : 'danger' }}">
                  {{ $mahasiswa->status }}
                </span>
              </td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('mahasiswa.show', $mahasiswa->id_mahasiswa) }}">
                      <i class="bx bx-show me-1"></i> Detail
                    </a>
                    @if(Auth::user()->level === 'admin' || Auth::user()->level === 'dosen')
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $mahasiswa->id_mahasiswa }}">
                      <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>
                    <form action="{{ route('mahasiswa.destroy', $mahasiswa->id_mahasiswa) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item" onclick="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?');">
                        <i class="bx bx-trash me-1"></i> Delete
                      </button>
                    </form>
                    @endif
                  </div>
                </div>
              </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $mahasiswa->id_mahasiswa }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="{{ route('mahasiswa.update', $mahasiswa->id_mahasiswa) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel">Edit Mahasiswa</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label>ID User</label>
                        <input type="text" name="id_user" class="form-control" value="{{ $mahasiswa->id_user }}" readonly>
                      </div>
                      <div class="mb-3">
                        <label>NIM</label>
                        <input type="text" name="nim" class="form-control" value="{{ $mahasiswa->nim }}" required>
                      </div>
                      <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $mahasiswa->nama }}" required>
                      </div>
                      <div class="mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required>{{ $mahasiswa->alamat }}</textarea>
                      </div>
                      <div class="mb-3">
                        <label>Telepon</label>
                        <input type="text" name="telpon" class="form-control" value="{{ $mahasiswa->telpon }}" required>
                      </div>
                      <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $mahasiswa->email }}" required>
                      </div>
                      <div class="mb-3">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                          <option value="Laki-laki" {{ $mahasiswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                          <option value="Perempuan" {{ $mahasiswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ $mahasiswa->tanggal_lahir }}" required>
                      </div>
                      <div class="mb-3">
                        <label>Semester</label>
                        <input type="number" name="semester" class="form-control" value="{{ $mahasiswa->semester }}" required>
                      </div>
                      <div class="mb-3">
                        <label>Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" class="form-control" value="{{ $mahasiswa->tahun_ajaran }}" required>
                      </div>
                      <div class="mb-3">
                        <label>Jurusan</label>
                        <input type="text" name="jurusan" class="form-control" value="{{ $mahasiswa->jurusan }}" required>
                      </div>
                      <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                          <option value="aktif" {{ $mahasiswa->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                          <option value="tidakaktif" {{ $mahasiswa->status == 'tidakaktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label>Foto</label>
                        @if($mahasiswa->foto)
                          <div class="mb-2">
                            <img src="{{ asset('storage/'.$mahasiswa->foto) }}" alt="Foto Mahasiswa" style="max-width: 100px;">
                          </div>
                        @endif
                        <input type="file" name="foto" class="form-control">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
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
@endsection
