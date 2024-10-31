<?php session_start();

$target_dir = "uploads/";
$target_file = $target_dir .
  basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo(
  $target_file,
  PATHINFO_EXTENSION
));
// Cek apakah file benar-benar gambar 
if (isset($_POST["submit"])) {
  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if ($check !== false) {
    echo "File adalah gambar - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File bukan gambar.";
    $uploadOk = 0;
  }
}
// Cek apakah file sudah ada 
if (file_exists($target_file)) {
  echo "File sudah ada.";
  $uploadOk = 0;
}
// Cek ukuran file 
if ($_FILES["image"]["size"] > 500000) {
  echo "Ukuran file terlalu besar.";
  $uploadOk = 0;
}
// Hanya izinkan file gambar tertentu 
if (
  $imageFileType != "jpg" && $imageFileType != "png" &&
  $imageFileType != "jpeg"
  && $imageFileType != "gif"
) {
  echo "Hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  echo "File tidak berhasil diunggah.";
} else {
  // Attempt to move the uploaded file
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    error_log("File diupload: $target_file");
  }
}

require 'koneksi.php';

$user = $_SESSION['login'];

$sql = "SELECT * FROM author WHERE nama = ?";
$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $user);

$stmt->execute();

$result = $stmt->get_result();

$row = $result->fetch_array();

$author = $row['id'];
$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];
$kategori = $_POST['kategori'];
$image = basename($_FILES["image"]["name"]);



$sql = "INSERT INTO post (judul, deskripsi,image,author_id,kategori_id) VALUES ('$judul', '$deskripsi','$image','$author','$kategori')";
if ($conn->query($sql) === TRUE) {
  header("location:../admin/index.php");
} else {
  echo "Error: {$sql} <br> {$conn->error}";
}


$conn->close();