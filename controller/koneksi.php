<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'uas';


try {
  $conn = new mysqli($host, $username, $password);
  if ($conn->connect_error) {
    die("Koneksi gagal: {$conn->connect_error}");
  }
} catch (mysqli_sql_exception $e) {
  die("Connection failed: " . $e->getMessage());
}
try {
  $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
  if ($conn->query($sql) === TRUE) {
    error_log('Database creation successful or already exists.');
  } else {
    die("Error creating database: {$conn->error}");
  }

  $conn->select_db($dbname);

  $sql_author = "CREATE TABLE IF NOT EXISTS author (
        id INT(2) PRIMARY KEY AUTO_INCREMENT,
        nama VARCHAR(30),
        password VARCHAR(30)
    )";

  if ($conn->query($sql_author) === TRUE) {
    error_log("Author table created successfully.");
  } else {
    die("Error creating 'author' table: {$conn->error}");
  }

  $sql_kategori = "CREATE TABLE IF NOT EXISTS kategori (
        id INT(2) PRIMARY KEY AUTO_INCREMENT,
        nama VARCHAR(50)
    )";

  if ($conn->query($sql_kategori) === TRUE) {
    error_log("Kategori table created successfully.");
  } else {
    die("Error creating 'kategori' table: {$conn->error}");
  }

  $sql_post = "CREATE TABLE IF NOT EXISTS post (
        id INT(2) PRIMARY KEY AUTO_INCREMENT,
        judul VARCHAR(50),
        deskripsi VARCHAR(150),
        image VARCHAR(50),
        read_count VARCHAR(50),
        author_id INT(2),
        kategori_id INT(2),
        date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (author_id) REFERENCES author(id),
        FOREIGN KEY (kategori_id) REFERENCES kategori(id)
    )";

  if ($conn->query($sql_post) === TRUE) {
    error_log("Post table created successfully.");
  } else {
    die("Error creating 'post' table: {$conn->error}");
  }

} catch (Exception $exception) {
  error_log("Error: " . $exception->getMessage());
}