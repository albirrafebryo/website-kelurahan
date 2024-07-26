<?php
session_start();
include "koneksi.php";
$id = $_GET['id_umkm'];
// Get the image path
$result = mysqli_query($kon, "SELECT foto_produk FROM umkm WHERE id_umkm='$id'");
$data = mysqli_fetch_assoc($result);
$img_path = $data['foto_produk'];

// Delete the image file from the server
if (file_exists($img_path)) {
    unlink($img_path);
}

$query = "delete from umkm where id_umkm=$id";
mysqli_query($kon, $query);
$_SESSION['success'] = 'Hapus data berhasil!';
header('Location:index.php');
