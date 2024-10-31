<?php
$cookie_duration = 86400;
$post_id = $_GET['id'];

require '../controller/koneksi.php';

if (!isset($_COOKIE['has_visited'])) {
  // Check if the read count for the post exists
  $sql = "SELECT read_count FROM post WHERE id = $post_id";
  $result = $conn->query($sql);

  if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $read_count = (int) $row['read_count'];

    $read_count++;

    $sql_update = "UPDATE post SET read_count = $read_count WHERE id = $post_id";
    if ($conn->query($sql_update) === TRUE) {
      error_log("readcount updated");
    } else {
      error_log("err");
    }
  } else {
    echo "Post not found.";
  }

  setcookie("has_visited", "1", time() + $cookie_duration);
} else {
  error_log("no ╰（‵□′）╯");
}

$conn->close();
?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Web Programming - Final Semester Exam</title>

  <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style-starter.css">
</head>

<body>
  <!-- header -->
  <header class="w3l-header">
    <!--/nav-->
    <nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-3">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <span class="fa fa-pencil-square-o"></span> Web Programming Blog</a>

        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
          data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <!-- <span class="navbar-toggler-icon"></span> -->
          <span class="fa icon-expand fa-bars"></span>
          <span class="fa icon-close fa-times"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item dropdown @@category__active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Categories <span class="fa fa-angle-down"></span>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item @@cp__active" href="technology.php">Technology posts</a>
                <a class="dropdown-item @@ls__active" href="lifestyle.php">Lifestyle posts</a>
              </div>
            </li>
            <li class="nav-item @@contact__active">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>
            <li class="nav-item @@about__active">
              <a class="nav-link" href="about.php">About</a>
            </li>
          </ul>

          <!--/search-right-->
          <div class="search-right mt-lg-0 mt-2">
            <a href="#search" title="search"><span class="fa fa-search" aria-hidden="true"></span></a>
            <!-- search popup -->
            <div id="search" class="pop-overlay">
              <div class="popup">
                <h3 class="hny-title two">Search here</h3>
                <form action="#" method="Get" class="search-box">
                  <input type="search" placeholder="Search for blog posts" name="search" required="required"
                    autofocus="">
                  <button type="submit" class="btn">Search</button>
                </form>
                <a class="close" href="#close">×</a>
              </div>
            </div>
            <!-- /search popup -->
          </div>
          <!--//search-right-->
          <!-- toggle switch for light and dark theme -->
          <div class="mobile-position">
            <nav class="navigation">
              <div class="theme-switch-wrapper">
                <label class="theme-switch" for="checkbox">
                  <input type="checkbox" id="checkbox">
                  <div class="mode-container">
                    <i class="gg-sun"></i>
                    <i class="gg-moon"></i>
                  </div>
                </label>
              </div>
            </nav>
          </div>
          <!-- //toggle switch for light and dark theme -->
        </div>
    </nav>
    <!--//nav-->
  </header>
  <!-- //header -->

  <div class="w3l-homeblock1">
    <div class="container pt-lg-5 pt-md-4">
      <?php
      require '../controller/koneksi.php';

      $sql = "SELECT * FROM post WHERE id = $post_id";
      $result = $conn->query($sql);

      $row = $result->fetch_array();

      $dateCreated = new DateTime($row['date_created']);

      $formattedDate = $dateCreated->format('m/d/Y');
      ?>
      <div class="grids5-info img-block-mobile">
        <div class="blog-info align-self">
          <p class="blog-desc mt-0 fs-1"><?= $row['judul']; ?></p>
          <img src="../controller/uploads/<?= $row['image']; ?>" alt="" class="img-fluid radius-image news-image">
          <p><?= $row['deskripsi']; ?></p>
        </div>
        <!-- //block-->
      </div>
    </div>
    <!-- footer -->
    <footer class="w3l-footer-16">
      <div class="footer-content py-lg-5 py-4 text-center">
        <div class="container">
          <div class="copy-right">
            <h6>© 2024 Web Programming Blog . Made by <i>(your name)</i> with <span class="fa fa-heart"
                aria-hidden="true"></span><br>Designed by
              <a href="https://w3layouts.com">W3layouts</a>
            </h6>
          </div>
          <ul class="author-icons mt-4">
            <li><a class="facebook" href="#url"><span class="fa fa-facebook" aria-hidden="true"></span></a>
            </li>
            <li><a class="twitter" href="#url"><span class="fa fa-twitter" aria-hidden="true"></span></a></li>
            <li><a class="google" href="#url"><span class="fa fa-google-plus" aria-hidden="true"></span></a>
            </li>
            <li><a class="linkedin" href="#url"><span class="fa fa-linkedin" aria-hidden="true"></span></a></li>
            <li><a class="github" href="#url"><span class="fa fa-github" aria-hidden="true"></span></a></li>
            <li><a class="dribbble" href="#url"><span class="fa fa-dribbble" aria-hidden="true"></span></a></li>
          </ul>
          <button onclick="topFunction()" id="movetop" title="Go to top">
            <span class="fa fa-angle-up"></span>
          </button>
        </div>
      </div>

      <!-- move top -->
      <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
          scrollFunction()
        };

        function scrollFunction() {
          if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("movetop").style.display = "block";
          } else {
            document.getElementById("movetop").style.display = "none";
          }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
          document.body.scrollTop = 0;
          document.documentElement.scrollTop = 0;
        }
      </script>
      <!-- //move top -->
    </footer>
    <!-- //footer -->

    <!-- Template JavaScript -->
    <script src="assets/js/theme-change.js"></script>

    <script src="assets/js/jquery-3.3.1.min.js"></script>

    <!-- disable body scroll which navbar is in active -->
    <script>
      $(function () {
        $('.navbar-toggler').click(function () {
          $('body').toggleClass('noscroll');
        })
      });
    </script>
    <!-- disable body scroll which navbar is in active -->

    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>