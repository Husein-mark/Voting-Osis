<?php
include "../Header/config.php";

$id = $_GET['id'] ?? null;

if($id){
    $query = mysqli_query($koneksi, "DELETE FROM tbl_siswa WHERE id_siswa = '$id'");
}


    header("Location: siswa.php");
    exit;

?>