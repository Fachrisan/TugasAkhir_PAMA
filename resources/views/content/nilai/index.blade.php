@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Data User')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Tables /</span> Nilai Tables
</h4>

<!-- Button Tambah User -->
<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
  Tambah User
</button>

<!-- Input Pencarian -->
<input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari User..." onkeyup="searchTable()">


<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">Tabel Data Nilai</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table class="table table-bordered" id="userTable">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Matkul</th>
            <th>sks</th>
            <th>Nilai 1</th>
            <th>Nilai 2</th>
            <th>Nilai 3</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>IFB103</td>
            <td>Pemograman Dasar</td>
            <td>3</td>
            <td>100</td>
            <td>80</td>
            <td>99</td>
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
            <td>IFB201</td>
            <td>Pemrograman Lanjut</td>
            <td>4</td>
            <td>20</td>
            <td>90</td>
            <td>95</td>
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
            <td>IFB202</td>
            <td>Analisis Algoritma</td>
            <td>3</td>
            <td>10</td>
            <td>85</td>
            <td>92</td>
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
            <td>IFB203</td>
            <td>Jaringan Komputer</td>
            <td>3</td>
            <td>70</td>
            <td>88</td>
            <td>94</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item edit-user" href="#" data-bs-toggle="modal" data-bs-target="#editUser Modal" data-nim="012022004" data-role="Mahasiswa"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <a class="dropdown-item" href="#"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>IFB204</td>
            <td>Keamanan Jaringan</td>
            <td>3</td>
            <td>30</td>
            <td>87</td>
            <td>91</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item edit-user" href="#" data-bs-toggle="modal" data-bs-target="#editUser Modal" data-nim="012022005" data-role="Mahasiswa"><i class="bx bx-edit-alt me-1"></i> Edit</a>
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
