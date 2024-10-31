<?php session_start();
if (isset($_SESSION['login'])) {
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  </head>

  <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
      <!-- Navbar Brand-->
      <a class="navbar-brand ps-3" href="index.php">ERICK E</a>
      <!-- Sidebar Toggle-->
      <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
          class="fas fa-bars"></i></button>
      <!-- Navbar Search-->
      <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
          <input class="form-control" type="text" placeholder="Cari artikel" aria-label="Cari artikel"
            aria-describedby="btnNavbarSearch" />
          <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
      </form>
      <!-- Navbar-->
      <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#!"><?= $_SESSION['login']; ?></a></li>
            <li>
              <hr class="dropdown-divider" />
            </li>
            <li>
              <form action="" method="post">
                <button name="logout" type="submit" class="dropdown-item">Logout</button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
          <div class="sb-sidenav-menu">
            <div class="nav">
              <div class="sb-sidenav-menu-heading">menu</div>
              <a class="nav-link" href="index.php">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
              </a>
            </div>
          </div>
          <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?= $_SESSION['login']; ?>
          </div>
        </nav>
      </div>
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Artikel</h1>
            <ol class="breadcrumb mb-4">
              <a href="index.php" class="btn btn-primary ms-3">dashboard</a>
            </ol>
            <div class="card mb-4">
              <div class="card-header">
                <i class="fas fa-pen me-1"></i>
                tambah artikel
              </div>
              <div class="card-body">
                <?php

                require '../controller/koneksi.php';

                $id = $_GET['id'];

                $sql = "SELECT * FROM post WHERE id = '$id'";

                $result = $conn->query($sql);

                $data = $result->fetch_array();
                ?>

                <form action="../controller/update.php" method="POST" enctype="multipart/form-data">
                  <div class="input-group flex-nowrap mb-3">
                    <input type="text" disabled class="form-control" id="dropdownInput" name="kategori"
                      placeholder="Select a category" aria-label="Input with dropdown" readonly />
                    <button disabled class="btn btn-outline-secondary dropdown-toggle" type="button"
                      id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      Select
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <?php
                      require '../controller/koneksi.php';

                      $sql = "SELECT * FROM kategori";
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          ?>
                          <li><a class="dropdown-item" href="#"
                              onclick="setDropdownValue('<?= $row['id']; ?>')"><?= $row['nama']; ?></a></li>
                          <?php
                        }
                      } else {
                        echo "<li class='dropdown-item'>kategori tidak ada</li>";
                      }
                      $conn->close();
                      ?>
                    </ul>
                  </div>
                  <script>
                    function setDropdownValue(value) {
                      document.getElementById("dropdownInput").value = value;
                    }
                  </script>
                  <div class="input-group flex-nowrap mb-3">
                    <input type="text" hidden class="form-control" placeholder="Judul" aria-label="Judul" name="id"
                      aria-describedby="addon-wrapping" value="<?= $data['id']; ?>">
                    <input type="text" class="form-control" placeholder="Judul" aria-label="Judul" name="judul"
                      aria-describedby="addon-wrapping" value="<?= $data['judul']; ?>">
                  </div>
                  <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="isi artikel" id="floatingTextarea" name="deskripsi"
                      value="<?= $data['deskripsi']; ?>"></textarea>
                    <label for="floatingTextarea">Isi Artikel</label>
                  </div>
                  <div class="input-group flex-nowrap mb-3">
                    <input disabled type="file" class="form-control" placeholder="Gambar" aria-label="gambar" name="image"
                      aria-describedby="addon-wrapping">
                  </div>
                  <div class="input-group flex-nowrap mb">
                    <button type="submit" class="btn btn-primary ms-3">update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
          <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
              <div class="text-muted">Copyright &copy; Your Website 2023</div>
              <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
      crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
  </body>

  </html>
  <?php
} else {
  header("location:../admin/login.php");
}

if (isset($_POST['logout'])) {
  if (isset($_SESSION['login'])) {
    session_unset();
    session_destroy();
    header("location:../admin/login.php");
    exit();
  }
}