<?php
require 'koneksi.php';

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];


$sql = "UPDATE products SET name='$name', description='$description', price='$price' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  header("location:read.php");
} else {
  echo "Error: {$sql} <br> {$conn->error}";
}


$conn->close();