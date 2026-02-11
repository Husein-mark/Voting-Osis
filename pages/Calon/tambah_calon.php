<?php
include "../Header/header.php";
include "../Header/config.php";

$halaman = basename($_SERVER['PHP_SELF']);
$berhasil = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];

    // Folder Upload
    $folder = "../../assets/img/";

    //Ambil Data File
    $namaFile = $_FILES ['foto']['name'];
    $tmpFile = $_FILES ['foto']['tmp_name'];

    $namaBaru = time() . "_" . $namaFile;

    move_uploaded_file($tmpFile, $folder . $namaBaru);


    $query = mysqli_query($koneksi, "INSERT INTO tbl_calon_ketua_osis(nama_calon, visi, misi, foto) VALUES ('$nama','$visi','$misi','$namaBaru')");

    if ($query){
    $berhasil = true;
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
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Visi</label>
                    <input type="text" class="form-control" id="visi" name="visi" required>
                </div>

                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Misi</label>
                    <input type="text" class="form-control" id="misi" name="misi" required>
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" required>
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
    text: "Data Berhasil Ditambahkan!",
    showConfirmButton: false,
    timer: 2000
    }).then(() => {
    window.location.href = "calon.php";
    })
    </script>
 <?php } ?>