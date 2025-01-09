@extends('layouts/contentNavbarLayout')

@section('title', 'Profil Mahasiswa')

@section('page-script')
<script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Account Settings /</span> Profil Mahasiswa
</h4>

<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a></li>
      <li class="nav-item"><a class="nav-link" href="#"><i class="bx bx-bell me-1"></i> Notifications</a></li>
    </ul>
    <div class="card mb-4">
      <h5 class="card-header">Profile Details</h5>
      <!-- Account -->
      <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <!-- Menampilkan foto profil -->
          <img src="{{ $mahasiswa->foto ? Storage::url($mahasiswa->foto) : asset('assets/img/avatars/1.png') }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Upload new photo</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
              <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
            </label>
            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
              <i class="bx bx-reset d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Reset</span>
            </button>

            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
          </div>
        </div>
      </div>
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" method="POST" action="{{ route('mahasiswa.update', $mahasiswa->id_mahasiswa) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="nim" class="form-label">NIM</label>
              <input class="form-control" type="text" id="nim" name="nim" value="{{ $mahasiswa->nim }}" autofocus />
            </div>
            <div class="mb-3 col-md-6">
              <label for="nama" class="form-label">Nama</label>
              <input class="form-control" type="text" name="nama" id="nama" value="{{ $mahasiswa->nama }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">E-mail</label>
              <input class="form-control" type="text" id="email" name="email" value="{{ $mahasiswa->email }}" placeholder="Email" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $mahasiswa->alamat }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="telpon" class="form-label">Phone Number</label>
              <input type="text" class="form-control" id="telpon" name="telpon" value="{{ $mahasiswa->telpon }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
              <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $mahasiswa->tanggal_lahir }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="semester" class="form-label">Semester</label>
              <input type="number" class="form-control" id="semester" name="semester" value="{{ $mahasiswa->semester }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
              <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" value="{{ $mahasiswa->tahun_ajaran }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="jurusan" class="form-label">Jurusan</label>
              <input type="text" class="form-control" id="jurusan" name="jurusan" value="{{ $mahasiswa->jurusan }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="status" class="form-label">Status</label>
              <select id="status" name="status" class="form-control">
                <option value="aktif" {{ $mahasiswa->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="tidakaktif" {{ $mahasiswa->status == 'tidakaktif' ? 'selected' : '' }}>Tidak Aktif</option>
              </select>
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
            <!-- Tombol Cancel kembali ke dashboard -->
            <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary">Cancel</a>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>
@endsection
