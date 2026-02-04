<?php
include "../Header/config.php";

$id = $_GET['id'] ?? null;

if($id){
    $query = mysqli_query($koneksi, "DELETE FROM tbl_calon_ketua_osis WHERE id_calon = '$id'");
}


    header("Location: calon.php");
    exit;

?>