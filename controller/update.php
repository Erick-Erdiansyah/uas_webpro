<?php
require 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];

$sql = "UPDATE post SET nama='$nama', deskripsi='$deskripsi' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  header("location:../admin/index.php");
} else {
  echo "Error: {$sql} <br> {$conn->error}";
}


$conn->close();