<?php

include("../__fungsi.php");

if (!check_login()) header("Location: ../login.php");

if ($_POST) {
  $lapangan = $_POST['lapangan'];
  $harga = $_POST['harga'];

  $tambah_lapangan = "INSERT INTO lapangan (lapangan, harga) VALUES ('$lapangan', '$harga')";
}

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
            <a class="nav-link" href="index.php">Dashboard Admin</a>
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
    <h1 class="text-center">Dashboard Admin Grand Futsal - Tambah Lapangan</h1>
    <p class="text-center h5 lead">Berikut adalah menu Tambah Lapangan yang tersedia di Grand Futsal.</p>
  </div>

  <main class="container mb-5">
    <?php if ($_POST) : ?>
      <?php if (mysqli_query($koneksi, $tambah_lapangan)) : ?>
        <div class="alert alert-success">
          Tambah Lapangan Berhasil!
        </div>
      <?php else : ?>
        <div class="alert alert-warning">
          Tambah Lapangan Gagal! Kesalahan: <?= mysqli_errno($koneksi); ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>
    <form method="POST">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="lapangan"><span class="text-danger">* </span>Lapangan Ke-</label>
            <input name="lapangan" type="text" class="form-control" id="lapangan" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="harga"><span class="text-danger">* </span>Harga Lapangan per Jam (Rupiah)</label>
            <input name="harga" type="number" class="form-control" id="harga" required>
          </div>
        </div>
      </div>

      <a href="list-lapangan.php" class="btn btn-outline-primary">Kembali</a>
      <button class="btn btn-primary ms-3">Tambah Lapangan</button>
    </form>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"></script>
</body>

</html>