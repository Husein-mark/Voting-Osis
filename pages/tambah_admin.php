<?php
include 'header.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO tbl_admin(username, password, nama, alamat) VALUES ('$username','$password','$nama','$alamat')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data Admin Berhasil Ditambahkan');
              window.location.href='admin.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>


<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
        <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Tambah Admin</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <form method="POST">
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat">
                </div>
                <button type="submit" class="btn btn-primary mx-3 my-3 ">Simpan</button>
            </form>
         </div>
        </div>
    </div>
</div>