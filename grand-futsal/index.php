<?php

include("__fungsi.php");

$data_akun = check_login();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Grand Futsal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container py-2">
      <a class="navbar-brand" href="index.php"><strong>Grand Futsal</strong></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <?php if (!empty($data_akun)) : ?>
            <li class="nav-item">
              <a class="nav-link" href="admin/index.php">Dashboard Admin</a>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link active" href="index.php"><strong>Beranda</strong></a>
          </li>
          <?php if (!empty($data_akun)) : ?>
            <li class="nav-item">
              <a class="nav-link active" href="admin/jadwal.php">Jadwal</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link active" href="jadwal.php">Jadwal</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container text-center my-3">
    <img src="./images/field.jpg" class="img-fluid" alt="Grand Futsal" style="height: 400px;">
    <h1 class="py-3">Your Favorite Futsal Field</h1>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"></script>
</body>

</html>