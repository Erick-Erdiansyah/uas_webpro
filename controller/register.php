<?php
require 'koneksi.php';

$nama = $_POST['nama'];
$password = $_POST['password'];

$sql = "INSERT INTO author (nama,password) VALUES ('$nama','$password')";
if ($conn->query($sql) === TRUE) {
  header("location:../admin/login.php");
} else {
  echo "Error: {$sql} <br> {$conn->error}";
}


$conn->close();