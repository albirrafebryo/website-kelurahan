<?php
session_start();
include "koneksi.php";
$id_umkm = $_POST["id_umkm"];
$nama_pemilik = $_POST["nama_pemilik"];
$nama_umkm = $_POST["nama_umkm"];
$alamat_umkm = $_POST["alamat_umkm"];
$no_hp = $_POST["no_hp"];
$no_izin = $_POST["no_izin"];



if ($id_umkm) {
    // Update data
    if ($_FILES["foto_produk"]['size'] != 0) {
        // Handle file upload
        $target_dir = "foto/";
        $target_file = $target_dir . basename($_FILES["foto_produk"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["foto_produk"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["foto_produk"]["size"] > 500000) {
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            $_SESSION['error'] = 'Ubah data gagal!';
        } else {

            move_uploaded_file($_FILES["foto_produk"]["tmp_name"], $target_file);
            $result = mysqli_query($kon, "SELECT foto_produk FROM umkm WHERE id_umkm='$id_umkm'");
            $data = mysqli_fetch_assoc($result);
            $img_path = $data['foto_produk'];

            // Delete the image file from the server
            if (file_exists($img_path)) {
                unlink($img_path);
            }

            $sql = "UPDATE umkm SET nama_pemilik='$nama_pemilik', nama_umkm='$nama_umkm', alamat_umkm='$alamat_umkm', no_hp='$no_hp', no_izin='$no_izin', foto_produk='$target_file' WHERE id_umkm=$id_umkm";
            // var_dump($sql);
            // die;
            mysqli_query($kon, $sql);

            $_SESSION['success'] = 'Ubah data berhasil';
        }
    } else {
        $sql = "UPDATE umkm SET nama_pemilik='$nama_pemilik', nama_umkm='$nama_umkm', alamat_umkm='$alamat_umkm', no_hp='$no_hp', no_izin='$no_izin' WHERE id_umkm=$id_umkm";
        mysqli_query($kon, $sql);
        $_SESSION['success'] = 'Ubah data berhasil';
    }
} else {
    if ($_FILES["foto_produk"]['size'] != 0) {
        // Handle file upload
        $target_dir = "foto/";
        $target_file = $target_dir . basename($_FILES["foto_produk"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["foto_produk"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["foto_produk"]["size"] > 500000) {
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
        }
    } else {
        $target_file = '';
        $uploadOk = 1;
    }
    if ($uploadOk == 0) {
        $_SESSION['error'] = 'Tambah data gagal!';
    } else {
        // Simpan data
        move_uploaded_file($_FILES["foto_produk"]["tmp_name"], $target_file);
        $sql = "INSERT INTO umkm (nama_pemilik, nama_umkm, alamat_umkm, no_hp, no_izin, foto_produk) VALUES ('$nama_pemilik', '$nama_umkm', '$alamat_umkm', '$no_hp', '$no_izin', '$target_file')";
        mysqli_query($kon, $sql);
        $_SESSION['success'] = 'Tambah data berhasil!';
    }
}
// var_dump($sql);

header('Location:index.php');
