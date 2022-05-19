<?php

include("__fungsi.php");

$from = date("d-M-Y", time());
$from_default = date("d-M-Y", time());

$to = date("d-M-Y", strtotime("+2 day", strtotime($from)));
$data_lapangan = query("SELECT * FROM lapangan");

$data_akun = check_login();

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Grand Futsal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet" />
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
            <a class="nav-link" href="index.php">Beranda</a>
          </li>
          <?php if (!empty($data_akun)) : ?>
            <li class="nav-item">
              <a class="nav-link active" href="admin/jadwal.php"><strong>Jadwal</strong></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link active" href="jadwal.php"><strong>Jadwal</strong></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-5">
    <h1 class="text-center">Jadwal Lapangan Grand Futsal</h1>
    <div class="text-center">
      <p class="badge bg-white shadow text-dark"><i class="text-success bi bi-check-circle-fill"></i> Tersedia</p>
      <p class="badge bg-white shadow text-dark"><i class="text-danger bi bi-x-circle-fill"></i> Tidak Tersedia</p>
    </div>
  </div>

  <main class="container mb-5">
    <table class="table table-hover table-responsive">
      <thead>
        <tr>
          <th>Hari, Tanggal</th>
          <th>Lapangan Ke-</th>
          <th>Jam</th>
          <th>Harga Per Jam</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data_lapangan as $lapangan) : ?>
          <?php $durasi_tidak_tersedia = 0; ?>
          <?php while (strtotime($from) <= strtotime($to)) : ?>
            <?php if (date("H", strtotime($from)) < "21" && date("H", strtotime($from)) > "08") : ?>
              <tr>
                <td><?= echo_hari(explode(",", $from)[0]); ?>, <?= explode(",", $from)[1]; ?></td>
                <td>LAP-<?= $lapangan['lapangan']; ?></td>
                <td><?= date("H:i", strtotime($from)); ?> s/d <?= date("H:i", strtotime("+59 minute", strtotime($from))); ?></td>
                <td>Rp<?= number_format($lapangan['harga']); ?></td>

                <?php $tgl_sewa = date('Y-m-d', strtotime(trim(explode(",", $from)[1]))); ?>
                <?php $jam = date("H:i", strtotime($from)); ?>
                <?php $no_lapangan = $lapangan['no_lapangan']; ?>
                <?php $tersedia = query("SELECT * FROM penyewaan WHERE tgl_sewa='$tgl_sewa' AND jam='$jam' AND no_lapangan='$no_lapangan'"); ?>

                <?php if (!isset($tersedia[0]) && $durasi_tidak_tersedia == 0) : ?>
                  <td>
                    <i class="text-success bi bi-check-circle-fill"></i>
                    <div class="badge bg-success">Tersedia</div>
                  </td>
                <?php elseif ($durasi_tidak_tersedia != 0) : ?>
                  <?php if ($durasi_tidak_tersedia > 0) $durasi_tidak_tersedia--;
                  else $durasi_tidak_tersedia = $tersedia[0]['durasi'] - 1; ?>
                  <td>
                    <i class="text-danger bi bi-x-circle-fill"></i>
                    <div class="badge bg-danger">Booked</div>
                  </td>
                <?php else : ?>
                  <?php $durasi_tidak_tersedia = $tersedia[0]['durasi'] - 1; ?>
                  <td>
                    <i class="text-danger bi bi-x-circle-fill"></i>
                    <div class="badge bg-danger">Booked</div>
                  </td>
                <?php endif; ?>
              </tr>
            <?php endif; ?>
            <?php $from = date("D, d M Y, H:i", strtotime("+1 hour", strtotime($from))); ?>
          <?php endwhile; ?>
          <tr>
            <td colspan="5">
              <hr>
            </td>
          </tr>
          <?php $from = $from_default; ?>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"></script>
</body>

</html>