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
            <th>Kode</th>
            <th>nama</th>
            <th>sks</th>
            <th>Dosen</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Ruangan</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>IFB103</td>
            <td>Pemograman Dasar</td>
            <td>3</td>
            <td>Boy</td>
            <td>Senin</td>
            <td>08:00 - 10:00</td>
            <td>Ruang 101</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item edit-user" href="#" data-bs-toggle="modal" data-bs-target="#editUser Modal" data-nim="012022001" data-role="Mahasiswa"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <a class="dropdown-item" href="#"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>IFB104</td>
            <td>Pemograman Basis Data</td>
            <td>3</td>
            <td>Lisa</td>
            <td>Selasa</td>
            <td>10:00 - 12:00</td>
            <td>Ruang 102</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item edit-user" href="#" data-bs-toggle="modal" data-bs-target="#editUser Modal" data-nim="012022002" data-role="Mahasiswa"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <a class="dropdown-item" href="#"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>IFB105</td>
            <td>Pemograman Web</td>
            <td>3</td>
            <td>Rudi</td>
            <td>Rabu</td>
            <td>13:00 - 15:00</td>
            <td>Ruang 103</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item edit-user" href="#" data-bs-toggle="modal" data-bs-target="#editUser Modal" data-nim="012022003" data-role="Mahasiswa"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <a class="dropdown-item" href="#"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>IFB106</td>
            <td>Sistem Operasi</td>
            <td>3</td>
            <td>Andi</td>
            <td>Kamis</td>
            <td>15:00 - 17:00</td>
            <td>Ruang 104</td>
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
