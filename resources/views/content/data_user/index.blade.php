@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Data User')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Tables /</span> Data User Tables
</h4>

<!-- Button Tambah User -->
<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
  Tambah User
</button>

<!-- Input Pencarian -->
<input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari User..." onkeyup="searchTable()">


<!-- Bordered Table -->
<div class="card">
  <h5 class="card-header">Tabel Data User</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table class="table table-bordered" id="userTable">
        <thead>
          <tr>
            <th>Nim/Nidn</th>
            <th>Password</th>
            <th>Role</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>admin</td>
            <td>admin</td>
            <td><span class="badge bg-label-success me-1">Admin</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item edit-user" href="#" data-bs-toggle="modal" data-bs-target="#editUserModal" data-nim="admin" data-role="Admin"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <a class="dropdown-item" href="#"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>012022001</td>
            <td>-----</td>
            <td><span class="badge bg-label-info me-1">Dosen</span></td>
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
          <tr>
            <td>152023111</td>
            <td>----</td>
            <td><span class="badge bg-label-primary me-1">Mahasiswa</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item edit-user" href="#" data-bs-toggle="modal" data-bs-target="#editUserModal" data-nim="152023111" data-role="Mahasiswa"><i class="bx bx-edit-alt me-1"></i> Edit</a>
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

<!-- Modal Tambah User -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Tambah User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="nim" class="form-label">Nim/Nidn</label>
            <input type="text" class="form-control" id="nim" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" required>
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role">
              <option value="Admin">Admin</option>
              <option value="Dosen">Dosen</option>
              <option value="Mahasiswa">Mahasiswa</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="edit-nim" class="form-label">Nim/Nidn</label>
            <input type="text" class="form-control" id="edit-nim" readonly>
          </div>
          <div class="mb-3">
            <label for="edit-role" class="form-label">Role</label>
            <select class="form-control" id="edit-role">
              <option value="Admin">Admin</option>
              <option value="Dosen">Dosen</option>
              <option value="Mahasiswa">Mahasiswa</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Script untuk mengisi modal edit dengan data yang dipilih -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    let editUserButtons = document.querySelectorAll(".edit-user");
    editUserButtons.forEach(button => {
      button.addEventListener("click", function() {
        let nim = this.getAttribute("data-nim");
        let role = this.getAttribute("data-role");
        document.getElementById("edit-nim").value = nim;
        document.getElementById("edit-role").value = role;
      });
    });
  });

  function searchTable() {
    let input = document.getElementById("searchInput");
    let filter = input.value.toLowerCase();
    let table = document.getElementById("userTable");
    let tr = table.getElementsByTagName("tr");

    for (let i = 1; i < tr.length; i++) {
      let td = tr[i].getElementsByTagName("td");
      let rowText = "";
      for (let j = 0; j < td.length; j++) {
        if (td[j]) {
          rowText += td[j].textContent.toLowerCase() + " ";
        }
      }
      tr[i].style.display = rowText.includes(filter) ? "" : "none";
    }
  }
</script>
@endsection
