<?php
include "../Header/header.php";
include "../Header/config.php";

$halaman = basename($_SERVER['PHP_SELF']);
$berhasil = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];

    // Folder Upload
    $folder = "../../assets/img/";

    //Ambil Data File
    $namaFile = $_FILES ['foto']['name'];
    $tmpFile = $_FILES ['foto']['tmp_name'];

    $namaBaru = time() . "_" . $namaFile;

    move_uploaded_file($tmpFile, $folder . $namaBaru);

    $query = mysqli_query($koneksi, "INSERT INTO tbl_siswa (nama, kelas, jurusan, alamat, foto, email)
              VALUES ('$nama', '$kelas', '$jurusan', '$alamat', '$namaBaru', '$email')");
    
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
            <h6>Tambah Siswa</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" required>
                </div>

                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Jurusan</label>
                    <input type="text" class="form-control" id="jurusan" name="jurusan" required>
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" required>
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
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
    window.location.href = "siswa.php";
    })
    </script>
 <?php } ?>
