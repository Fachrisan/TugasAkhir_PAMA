@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Data User')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Tables /</span> Mahasiswa Tables
</h4>

<!-- Button Tambah User -->
<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
  Tambah User
</button>

<!-- Input Pencarian -->
<input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari User..." onkeyup="searchTable()">


<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">Tabel Data Mahasiswa</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table class="table table-bordered" id="userTable">
        <thead>
          <tr>
            <th>Nim</th>
            <th>nama</th>
            <th>alamat</th>
            <th>telpon</th>
            <th>email</th>
            <th>Jenis Kelamin</th>
            <th>status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>152022001</td>
            <td>Boy</td>
            <td>Padasuka Bandung</span></td>
            <td>0896525433</td>
            <td>boy@gmail.com</td>
            <td>Laki Laki</td>
            <td>aktif</td>
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
            <td>152022002</td>
            <td>Veve</td>
            <td>Cibiru Bandung</span></td>
            <td>0895677889</td>
            <td>veve@gmail.com</td>
            <td>Perempuan</td>
            <td>aktif</td>
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
            <td>152022003</td>
            <td>Boy</td>
            <td>Padasuka Bandung</span></td>
            <td>0896525433</td>
            <td>boy@gmail.com</td>
            <td>Laki Laki</td>
            <td>aktif</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item edit-user" href="#" data-bs-toggle="modal" data-bs-target="#editUserModal" data-nim="012022001" data-role="Dosen"><i class="bx bx-edit-alt me-1"></i> Edit</a>
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
