<?php
include "../Header/config.php";

$halaman = basename($_SERVER['PHP_SELF']);
$berhasil = false;

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: admin.php");
    exit;
}

/* =========================
   AMBIL DATA ADMIN
========================= */
$query = mysqli_query($koneksi, "SELECT * FROM tbl_admin WHERE id_siswa = '$id'");
$siswa = mysqli_fetch_assoc($query);

if (!$siswa) {
    header("Location: admin.php");
    exit;
}

/* =========================
   PROSES UPDATE
========================= */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];

    // Jika upload foto baru
    if (!empty($_FILES['foto']['name'])) {

        $fotoLama = $siswa['foto'] ?? '';
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $izin = ['jpg', 'jpeg', 'png'];

        if (!in_array($ext, $izin)) {
            die("Format foto tidak didukung");
        }

        $fotoBaru = time() . "_" . uniqid() . "." . $ext;
        $tmp      = $_FILES['foto']['tmp_name'];
        $folder   = "../../assets/img/";

        move_uploaded_file($tmp, $folder . $fotoBaru);

        // Hapus foto lama jika ada
        if ($fotoLama && file_exists($folder . $fotoLama)) {
            unlink($folder . $fotoLama);
        }

        $sql = "UPDATE tbl_admin SET
                username='$username',
                password='$password',
                nama='$nama',
                alamat='$alamat',
                foto='$fotoBaru'
                WHERE id_siswa='$id'";

    } else {

        // Tanpa ganti foto
        $sql = "UPDATE tbl_admin SET
                username='$username',
                password='$password',
                nama='$nama',
                alamat='$alamat'
                WHERE id_siswa='$id'";
    }

    $update = mysqli_query($koneksi, $sql);

    if ($update) {
        $berhasil = true;

        // refresh data
        $query = mysqli_query($koneksi, "SELECT * FROM tbl_admin WHERE id_siswa = '$id'");
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
                    <h6>Edit Admin</h6>
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <form method="POST" enctype="multipart/form-data">

                        <div class="form-group mx-3 my-3">
                            <label class="mb-2 ms-3">Username</label>
                            <input type="text" class="form-control" name="username" value="<?= $siswa['username'] ?>" required>
                        </div>

                        <div class="form-group mx-3 my-3">
                            <label class="mb-2 ms-3">Password</label>
                            <input type="password" class="form-control" name="password" value="<?= $siswa['password'] ?>" required>
                        </div>

                        <div class="form-group mx-3 my-3">
                            <label class="mb-2 ms-3">Nama</label>
                            <input type="text" class="form-control" name="nama" value="<?= $siswa['nama'] ?>" required>
                        </div>

                        <div class="form-group mx-3 my-3">
                            <label class="mb-2 ms-3">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="<?= $siswa['alamat'] ?>" required>
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
                                         alt="Foto Admin">
                                </div>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-primary mx-3 my-3">Simpan</button>

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
    window.location.href = "admin.php";
});
</script>
<?php endif; ?>
