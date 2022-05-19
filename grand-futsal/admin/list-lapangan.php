<?php

include("../__fungsi.php");

if (!check_login()) header("Location: ../login.php");

$list_lapangan = query("SELECT * FROM lapangan");

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
    <h1 class="text-center">Dashboard Admin Grand Futsal - List Lapangan</h1>
    <p class="text-center h5 lead">Berikut adalah menu List Lapangan yang tersedia di Grand Futsal.</p>
  </div>

  <main class="container mb-5">
    <a class="btn btn-outline-primary mb-3" href="index.php">Kembali</a>
    <a class="btn btn-primary mb-3 ms-2" href="tambah-lapangan.php">Tambah Lapangan Baru</a>
    <table class="table table-hover table-responsive">
      <thead>
        <tr>
          <th>Nomor</th>
          <th>Lapangan</th>
          <th>Harga</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $total_lapangan = 0; ?>
        <?php foreach ($list_lapangan as $lapangan) : ?>
          <?php $total_lapangan++; ?>
          <tr id='lapangan-<?= $lapangan['no_lapangan']; ?>' class="align-middle data-field">
            <td><?= $total_lapangan; ?></td>
            <td>LAP-<?= $lapangan['lapangan']; ?></td>
            <td>Rp<?= number_format($lapangan['harga']); ?></td>
            <td>
              <a class="btn btn-warning" href="ubah-lapangan.php?id=<?= $lapangan['no_lapangan']; ?>">Edit</a>
              <a class="btn btn-danger" href="hapus-lapangan.php?id=<?= $lapangan['no_lapangan']; ?>" data-id="<?= $lapangan['no_lapangan']; ?>">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
        <?php if ($total_lapangan == 0) : ?>
          <tr class="text-center">
            <td colspan="5">Lapangan masih kosong.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </main>

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function() {
      $(".btn.btn-danger").each(function(index) {
        $(this).on("click", function(e) {
          e.preventDefault();

          let href = e.currentTarget.getAttribute('href');
          let id = e.currentTarget.getAttribute('data-id');

          Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Kamu tidak dapat mengembalikan data ini apabila terhapus.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok, hapus',
            cancelButtonText: "Batal"
          }).then((result) => {
            if (result.isConfirmed) {
              jQuery.ajax({
                url: href,
                success: function(data) {
                  if (data == 1) {
                    $(`#admin-${id}`).fadeOut();
                    Swal.fire(
                      'Berhasil!',
                      'Admin berhasil dihapus.',
                      'success'
                    );
                  } else {
                    Swal.fire(
                      'Gagal!',
                      'Sepertinya ada kesalahan.',
                      'warning'
                    );
                  }
                }
              });
            }
          });
        });
      });
    });
  </script>
</body>

</html>