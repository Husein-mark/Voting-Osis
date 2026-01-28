<?php
include 'header.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO tbl_siswa (nama, kelas, jurusan, alamat)
              VALUES ('$nama', '$kelas', '$jurusan', '$alamat')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data Siswa Berhasil Ditambahkan');
              window.location.href='siswa.php';</script>";
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
            <h6>Tambah Siswa</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <form method="POST">
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>
                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas">
                </div>

                <div class="form-group mx-3 my-3">
                    <label class="mb-2 ms-3">Jurusan</label>
                    <input type="text" class="form-control" id="jurusan" name="jurusan">
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