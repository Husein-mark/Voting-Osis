<?php

include 'config.php';

$id = $_GET['id'] ?? null;

if($id){
    $query = mysqli_query($koneksi, "SELECT * FROM tbl_calon_ketua_osis WHERE id_calon = '$id'");
    $siswa = mysqli_fetch_assoc($query);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];
    $foto = $_POST['foto'];
 
    mysqli_query($koneksi, "Update tbl_calon_ketua_osis set nama_calon='$nama', visi='$visi', misi='$misi', foto='$foto' where id_calon = '$id'");

    header("Location: calon.php");
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
                    <label class="mb-2 ms-3">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $siswa['nama_calon'] ?>">
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Visi</label>
                    <input type="text" class="form-control" id="visi" name="visi" value="<?= $siswa['visi'] ?>">
                </div>

                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Misi</label>
                    <input type="text" class="form-control" id="misi" name="misi" value="<?= $siswa['misi'] ?>">
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Foto</label>
                    <input type="text" class="form-control" id="foto" name="foto" value="<?= $siswa['foto'] ?>">
                </div>
                <button type="submit" class="btn btn-primary mx-3 my-3 ">Simpan</button>
            </form>
         </div>
        </div>
    </div>
</div>