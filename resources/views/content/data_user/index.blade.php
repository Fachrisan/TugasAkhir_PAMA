@extends('layouts/contentNavbarLayout')

@section('title', 'Daftar Pengguna')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Data Pengguna</span>
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
      <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Tambah User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="mb-3">
            <label>username</label>
            <input type="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
            @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Level</label>
            <select name="level" class="form-control @error('level') is-invalid @enderror">
                <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="dosen" {{ old('level') == 'dosen' ? 'selected' : '' }}>dosen</option>
                <option value="mahasiswa" {{ old('level') == 'mahasiswa' ? 'selected' : '' }}>mahasiswa</option>
            </select>
            @error('level')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Tombol untuk memunculkan modal tambah -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
  Tambah Pengguna
</button>
<!-- Input Pencarian -->
<div class="mb-3 mt-3">
  <input type="text" id="searchInput" class="form-control" placeholder="Cari pengguna...">
</div>
<div class="card mt-3">
  <div class="card">
    <h5 class="card-header">Tabel Data User</h5>
    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <table class="table table-bordered" id="userTable">
          <thead>
        <tr>
          <th>username</th>
          <th>password</th>
          <th>Level</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $key => $user)
        <tr>
            <td>{{ $user->username }}</td>
            <td>{{ $user->password }}</td>
            <td>{{ $user->level }}</td>
            <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <!-- Modal Edit -->
                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id_user }}">
                  <i class="bx bx-edit-alt me-1"></i> Edit
                </a>

                <!-- Form Delete -->
                <form action="{{ route('user.destroy', $user->id_user) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="dropdown-item" onclick="return confirm('Apakah Anda yakin ingin menghapus Pengguna ini?');">
                    <i class="bx bx-trash me-1"></i> Delete
                  </button>
                </form>
              </div>
            </div>
          </td>
        </tr>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal{{ $user->id_user }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="{{ route('user.update', $user->id_user) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label for="username{{ $user->id_user }}" class="form-label">username</label>
                    <input type="username" name="username" class="form-control" id="username{{ $user->id_user }}" value="{{ $user->username }}" required>
                  </div>
                  <div class="mb-3">
                    <label for="password{{ $user->id_user }}" class="form-label">password</label>
                    <input type="text" name="password" class="form-control" id="password{{ $user->id_user }}" value="{{ $user->password }}" required>
                  </div>
                  <div class="mb-3">
                    <label for="level{{ $user->id_user }}" class="form-label">level</label>
                    <select name="level" class="form-select" id="level{{ $user->id_user }}" required>
                      <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>admin</option>
                      <option value="dosen" {{ $user->level == 'kasir' ? 'selected' : '' }}>dosen</option>
                      <option value="mahasiswa" {{ $user->level == 'kasir' ? 'selected' : '' }}>mahasiswa</option>
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
    let rows = document.querySelectorAll("#userTable tbody tr");

    rows.forEach(row => {
      let username = row.cells[0].textContent.toLowerCase();
      let level = row.cells[2].textContent.toLowerCase();
      if (username.includes(filter) || level.includes(filter)) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
</script>
@endsection
