<?php
include "../Header/header.php";
include "../Header/config.php";

$halaman = basename($_SERVER['PHP_SELF']);
$berhasil = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    // Folder Upload
    $folder = "../../assets/img/";

    //Ambil Data File
    $namaFile = $_FILES ['foto']['name'];
    $tmpFile = $_FILES ['foto']['tmp_name'];

    $namaBaru = time() . "_" . $namaFile;

    move_uploaded_file($tmpFile, $folder . $namaBaru);

    $query = mysqli_query($koneksi, "INSERT INTO tbl_admin(username, password, nama, alamat, foto) VALUES ('$username','$password','$nama','$alamat', '$namaBaru')");

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
            <h6>Tambah Admin</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" required>
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
    window.location.href = "admin.php";
    })
    </script>
 <?php } ?>