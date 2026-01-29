<?php

include 'config.php';

$id = $_GET['id'] ?? null;

if($id){
    $query = mysqli_query($koneksi, "SELECT * FROM tbl_admin WHERE id_siswa = '$id'");
    $siswa = mysqli_fetch_assoc($query);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
 
    mysqli_query($koneksi, "Update tbl_admin set username='$username', password='$password', nama='$nama', alamat='$alamat' where id_siswa = '$id'");

    header("Location: admin.php");
    exit;
}

include 'header.php';
?>


<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
        <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Edit Siswa</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <form method="POST">
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $siswa['username'] ?>">
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Password</label>
                    <input type="text" class="form-control" id="password" name="password" value="<?= $siswa['password'] ?>">
                </div>

                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $siswa['nama'] ?>">
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $siswa['alamat'] ?>">
                </div>
                <button type="submit" class="btn btn-primary mx-3 my-3 ">Simpan</button>
            </form>
         </div>
        </div>
    </div>
</div>