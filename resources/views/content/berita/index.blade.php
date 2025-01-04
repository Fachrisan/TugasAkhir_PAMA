@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Data User')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Tables /</span> Mata Kuliah Tables
</h4>

<!-- Button Tambah User -->
<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
  Tambah User
</button>

<!-- Input Pencarian -->
<input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari User..." onkeyup="searchTable()">


<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">Tabel Data Mata Kuliah</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table class="table table-bordered" id="userTable">
        <thead>
          <tr>
            <th>judul</th>
            <th>Berita</th>
            <th>tanggal</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Pendaftaran Semester Baru</td>
            <td>Pendaftaran untuk semester baru dibukar</td>
            <td>2025-01-03</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item edit-user" href="#" data-bs-toggle="modal" data-bs-target="#editUserModal" data-nim="012022001" data-role="Mahasiswa"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <a class="dropdown-item" href="#"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>Pelaksanaan Ujian Akhir</td>
            <td>Jadwal ujian akhir semester telah diumumkan</td>
            <td>2025-01-10</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item edit-user" href="#" data-bs-toggle="modal" data-bs-target="#editUserModal" data-nim="012022001" data-role="Mahasiswa"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <a class="dropdown-item" href="#"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
            <td>Kuliah Tamu</td>
            <td>Kuliah tamu dengan pembicara dari industri.</td>
            <td>2025-02-01</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item edit-user" href="#" data-bs-toggle="modal" data-bs-target="#editUserModal" data-nim="012022001" data-role="Mahasiswa"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <a class="dropdown-item" href="#"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!--/ Bordered Table -->
@endsection
