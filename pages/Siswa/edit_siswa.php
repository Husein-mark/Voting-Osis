<?php

include "../Header/config.php";

$halaman = basename($_SERVER['PHP_SELF']);
$berhasil = false;

$id = $_GET['id'] ?? null;

if($id){
    $query = mysqli_query($koneksi, "SELECT * FROM tbl_siswa WHERE id_siswa = '$id'");
    $siswa = mysqli_fetch_assoc($query);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];
 
    $query = mysqli_query($koneksi, "Update tbl_siswa set nama='$nama', kelas='$kelas', jurusan='$jurusan', alamat='$alamat' where id_siswa = '$id'");

    if ($query){
    $berhasil = true;

    $ambil = mysqli_query($koneksi, "SELECT * FROM tbl_admin WHERE id_siswa = '$id'");
    $siswa = mysqli_fetch_assoc($ambil);
    }   
    
}

include "../Header/header.php";
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
                    <label class="mb-2 ms-3">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $siswa['nama'] ?>">
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $siswa['kelas'] ?>">
                </div>

                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Jurusan</label>
                    <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= $siswa['jurusan'] ?>">
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

<?php
 if($berhasil) { ?>
    <script>
    Swal.fire({
    icon: "success",
    text: "Data Berhasil Diganti!",
    showConfirmButton: false,
    timer: 2000
    }).then(() => {
    window.location.href = "siswa.php";
    })
    </script>
 <?php } ?>