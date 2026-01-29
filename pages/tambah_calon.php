<?php
include 'header.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];
    $foto = $_POST['foto'];

    $query = "INSERT INTO tbl_calon_ketua_osis(nama_calon, visi, misi, foto) VALUES ('$nama','$visi','$misi','$foto')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data Calon Berhasil Ditambahkan');
              window.location.href='calon.php';</script>";
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
            <h6>Tambah Calon</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <form method="POST">
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Visi</label>
                    <input type="text" class="form-control" id="visi" name="visi">
                </div>

                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Misi</label>
                    <input type="text" class="form-control" id="misi" name="misi">
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Foto</label>
                    <input type="text" class="form-control" id="foto" name="foto">
                </div>
                <button type="submit" class="btn btn-primary mx-3 my-3 ">Simpan</button>
            </form>
         </div>
        </div>
    </div>
</div>