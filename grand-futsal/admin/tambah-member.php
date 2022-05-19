<?php

include("../__fungsi.php");

if (!check_login()) header("Location: ../login.php");

if ($_POST) {
  $nomor_identitas = $_POST['nomor_identitas'];
  $nama = $_POST['nama'];
  $tempat_lahir = $_POST['tempat_lahir'];
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $alamat = $_POST['alamat'];
  $no_telp = $_POST['no_telp'];

  $tambah_member = "INSERT INTO member (no_member, no_identitas, nama, tmp_lahir, tgl_lahir, alamat, no_telp) VALUES (null, '$nomor_identitas', '$nama', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$no_telp')";
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
    <h1 class="text-center">Dashboard Admin Grand Futsal - Tambah Member</h1>
    <p class="text-center h5 lead">Berikut adalah menu Tambah Member yang tersedia di Grand Futsal.</p>
  </div>

  <main class="container mb-5">
    <?php if ($_POST) : ?>
      <?php if (mysqli_query($koneksi, $tambah_member)) : ?>
        <div class="alert alert-success">
          Tambah Member Berhasil!
        </div>
      <?php else : ?>
        <div class="alert alert-warning">
          Tambah Member Gagal! Kesalahan: <?= mysqli_errno($koneksi); ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>
    <form method="POST">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="nomor_identitas"><span class="text-danger">* </span>Nomor Identitas</label>
            <input name="nomor_identitas" type="text" class="form-control" id="nomor_identitas" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="nama"><span class="text-danger">* </span>Nama</label>
            <input name="nama" type="text" class="form-control" id="nama" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="tempat_lahir"><span class="text-danger">* </span>Tempat Lahir</label>
            <input name="tempat_lahir" type="text" class="form-control" id="tempat_lahir" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="tanggal_lahir"><span class="text-danger">* </span>Tanggal Lahir</label>
            <input name="tanggal_lahir" type="date" class="form-control" id="tanggal_lahir" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="alamat"><span class="text-danger">* </span>Alamat</label>
            <input name="alamat" type="text" class="form-control" id="alamat" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="no_telp"><span class="text-danger">* </span>Nomor Telpon</label>
            <input name="no_telp" type="text" class="form-control" id="no_telp" required>
          </div>
        </div>
      </div>

      <a href="list-member.php" class="btn btn-outline-primary">Kembali</a>
      <button class="btn btn-primary ms-3">Tambah Member</button>
    </form>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"></script>
</body>

</html>