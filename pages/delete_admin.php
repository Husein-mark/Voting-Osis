<?php
include 'config.php';

$id = $_GET['id'] ?? null;

if($id){
    $query = mysqli_query($koneksi, "DELETE FROM tbl_admin WHERE id_siswa = '$id'");
}


    header("Location: admin.php");
    exit;

?>