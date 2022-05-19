<?php

include("../__fungsi.php");

if (!check_login()) header("Location: ../login.php");

$total_penyewaan = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM penyewaan"));
$total_lapangan = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM lapangan"));
$total_member = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM member"));
$total_admin = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM admin"));

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Grand Futsal Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet" />
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container py-2">
      <a class="navbar-brand" href="../index.php"><strong>Grand Futsal Admin</strong></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="index.php"><strong>Dashboard Admin</strong></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="jadwal.php">Jadwal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-5">
    <h1 class="text-center">Dashboard Admin Grand Futsal</h1>
    <p class="text-center h5 lead">Berikut adalah menu yang tersedia di Dashboard Admin Grand Futsal.</p>
  </div>

  <main class="container mb-5">
    <div class="row">
      <div class="col-md-4 col-lg-3 mt-3">
        <div class="card h-100">
          <div class="card-body p-5">
            <h1 class="d-inline-block"><?= $total_penyewaan ?></h1>
            <p class="h4 lg-ms-3 d-inline-block">Penyewaan</p>
            <a class="btn d-block btn-outline-primary" href="list-penyewaan.php">Lihat Semua Penyewaan</a>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-lg-3 mt-3">
        <div class="card h-100">
          <div class="card-body p-5">
            <h1 class="d-inline-block"><?= $total_member; ?></h1>
            <p class="h4 lg-ms-3 d-inline-block">Member&nbsp;&nbsp;</p>
            <a class="btn d-block btn-outline-primary" href="list-member.php">Lihat Semua Member</a>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-lg-3 mt-3">
        <div class="card h-100">
          <div class="card-body p-5">
            <h1 class="d-inline-block"><?= $total_lapangan; ?></h1>
            <p class="h4 lg-ms-3 d-inline-block">Lapangan</p>
            <a class="btn d-block btn-outline-primary" href="list-lapangan.php">Lihat Semua Lapangan</a>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-lg-3 mt-3">
        <div class="card h-100">
          <div class="card-body p-5">
            <h1 class="d-inline-block"><?= $total_admin; ?></h1>
            <p class="h4 lg-ms-3 d-inline-block">Admin&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <a class="btn d-block btn-outline-primary" href="list-admin.php">Lihat Semua Admin</a>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"></script>
</body>

</html>