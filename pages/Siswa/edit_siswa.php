<?php
include "../Header/config.php";

$halaman  = basename($_SERVER['PHP_SELF']);
$berhasil = false;

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: siswa.php");
    exit;
}

/* =========================
   AMBIL DATA SISWA
========================= */
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM tbl_siswa WHERE id_siswa = '$id'"
);
$siswa = mysqli_fetch_assoc($query);

if (!$siswa) {
    header("Location: siswa.php");
    exit;
}

/* =========================
   PROSES UPDATE
========================= */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama    = $_POST['nama'];
    $kelas   = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $alamat  = $_POST['alamat'];

    // Jika upload foto baru
    if (!empty($_FILES['foto']['name'])) {

        $fotoLama = $siswa['foto'];
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $izin = ['jpg', 'jpeg', 'png'];

        if (!in_array($ext, $izin)) {
            die("Format foto tidak didukung");
        }

        $fotoBaru = time() . "_" . uniqid() . "." . $ext;
        $tmp      = $_FILES['foto']['tmp_name'];
        $folder   = "../../assets/img/";

        move_uploaded_file($tmp, $folder . $fotoBaru);

        // Hapus foto lama
        if ($fotoLama && file_exists($folder . $fotoLama)) {
            unlink($folder . $fotoLama);
        }

        $sql = "UPDATE tbl_siswa SET
                nama='$nama',
                kelas='$kelas',
                jurusan='$jurusan',
                alamat='$alamat',
                foto='$fotoBaru'
                WHERE id_siswa='$id'";

    } else {

        // Tanpa ganti foto
        $sql = "UPDATE tbl_siswa SET
                nama='$nama',
                kelas='$kelas',
                jurusan='$jurusan',
                alamat='$alamat'
                WHERE id_siswa='$id'";
    }

    $update = mysqli_query($koneksi, $sql);

    if ($update) {
        $berhasil = true;

        // refresh data
        $query = mysqli_query(
            $koneksi,
            "SELECT * FROM tbl_siswa WHERE id_siswa = '$id'"
        );
        $siswa = mysqli_fetch_assoc($query);
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
                    <form method="POST" enctype="multipart/form-data">

                        <div class="form-group mx-3 my-3">
                            <label class="mb-2 ms-3">Nama</label>
                            <input type="text"
                                   class="form-control"
                                   name="nama"
                                   value="<?= $siswa['nama']; ?>"
                                   required>
                        </div>

                        <div class="form-group mx-3 my-3">
                            <label class="mb-2 ms-3">Kelas</label>
                            <input type="text"
                                   class="form-control"
                                   name="kelas"
                                   value="<?= $siswa['kelas']; ?>"
                                   required>
                        </div>

                        <div class="form-group mx-3 my-3">
                            <label class="mb-2 ms-3">Jurusan</label>
                            <input type="text"
                                   class="form-control"
                                   name="jurusan"
                                   value="<?= $siswa['jurusan']; ?>"
                                   required>
                        </div>

                        <div class="form-group mx-3 my-3">
                            <label class="mb-2 ms-3">Alamat</label>
                            <input type="text"
                                   class="form-control"
                                   name="alamat"
                                   value="<?= $siswa['alamat']; ?>"
                                   required>
                        </div>

                        <!-- FOTO -->
                        <div class="form-group mx-3 my-3">
                            <label class="mb-2 ms-3">Foto</label>
                            <input type="file" class="form-control" name="foto">

                            <?php if (!empty($siswa['foto'])): ?>
                                <div class="mt-3">
                                    <img src="../../assets/img/<?= $siswa['foto']; ?>"
                                         width="130"
                                         class="avatar avatar-md"
                                         alt="Foto Siswa">
                                </div>
                            <?php endif; ?>
                        </div>

                        <button type="submit"
                                class="btn btn-primary mx-3 my-3">
                            Simpan
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($berhasil): ?>
<script>
Swal.fire({
    icon: "success",
    text: "Data berhasil diperbarui!",
    showConfirmButton: false,
    timer: 2000
}).then(() => {
    window.location.href = "siswa.php";
});
</script>
<?php endif; ?>
