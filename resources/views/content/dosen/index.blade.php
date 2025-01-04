@extends('layouts/contentNavbarLayout')

@section('title', 'Data Dosen')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Data Dosen</span>
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
      <form action="{{ route('dosen.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Tambah Dosen</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>ID User</label>
            <input type="text" name="id_user" class="form-control @error('id_user') is-invalid @enderror" value="{{ old('id_user') }}" required>
            @error('id_user')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label>NIDN</label>
            <input type="text" name="nidn" class="form-control @error('nidn') is-invalid @enderror" value="{{ old('nidn') }}" required>
            @error('nidn')
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
          <button type="submit" class="btn btn-primary">Tambah Dosen</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Tombol untuk memunculkan modal tambah -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
  Tambah Dosen
</button>

<!-- Input Pencarian -->
<div class="mb-3 mt-3">
  <input type="text" id="searchInput" class="form-control" placeholder="Cari dosen...">
</div>

<div class="card mt-3">
  <div class="card">
    <h5 class="card-header">Data Dosen</h5>
    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <table class="table table-bordered" id="dosenTable">
          <thead>
            <tr>
              <th>NIDN</th>
              <th>Nama</th>
              <th>email</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($dosen as $dosen)
            <tr>
              <td>{{ $dosen->nidn }}</td>
              <td>{{ $dosen->nama }}</td>
              <td>{{ $dosen->email }}</td>
              <td>
                <span class="badge bg-{{ $dosen->status == 'aktif' ? 'success' : 'danger' }}">
                  {{ $dosen->status }}
                </span>
              </td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('dosen.show', $dosen->id_dosen) }}">
                      <i class="bx bx-show me-1"></i> Detail
                    </a>
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $dosen->id_dosen }}">
                      <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>
                    <form action="{{ route('dosen.destroy', $dosen->id_dosen) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item" onclick="return confirm('Apakah Anda yakin ingin menghapus data dosen ini?');">
                        <i class="bx bx-trash me-1"></i> Delete
                      </button>
                    </form>
                  </div>
                </div>
              </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $dosen->id_dosen }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="{{ route('dosen.update', $dosen->id_dosen) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel">Edit Dosen</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label>ID User</label>
                        <input type="text" name="id_user" class="form-control" value="{{ $dosen->id_user }}" readonly>
                      </div>
                      <div class="mb-3">
                        <label>NIDN</label>
                        <input type="text" name="nidn" class="form-control" value="{{ $dosen->nidn }}" required>
                      </div>
                      <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $dosen->nama }}" required>
                      </div>
                      <div class="mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required>{{ $dosen->alamat }}</textarea>
                      </div>
                      <div class="mb-3">
                        <label>Telepon</label>
                        <input type="text" name="telpon" class="form-control" value="{{ $dosen->telpon }}" required>
                      </div>
                      <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $dosen->email }}" required>
                      </div>
                      <div class="mb-3">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                          <option value="Laki-laki" {{ $dosen->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                          <option value="Perempuan" {{ $dosen->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ $dosen->tanggal_lahir }}" required>
                      </div>
                      <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                          <option value="aktif" {{ $dosen->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                          <option value="tidakaktif" {{ $dosen->status == 'tidakaktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label>Foto</label>
                        @if($dosen->foto)
                          <div class="mb-2">
                            <img src="{{ asset('storage/'.$dosen->foto) }}" alt="Foto Dosen" style="max-width: 100px;">
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
