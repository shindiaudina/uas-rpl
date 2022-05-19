<?php

include("../__fungsi.php");

if (!check_login()) header("Location: ../login.php");

$list_member = query("SELECT * FROM member");

if (!$_GET['id']) {
  header("Location: list-lapangan.php");
} else {
  $id = $_GET['id'];
  $tanggal = $_GET['tanggal'];
  $jam = $_GET['jam'];
  $lapangan = query("SELECT * FROM lapangan WHERE no_lapangan='$id'")[0];
}


if ($_POST) {
  $tgl_sewa = explode(", ", $_POST['hari_tanggal'])[1];
  $tgl_sewa = date('Y-m-d', strtotime($tgl_sewa));

  $hari = explode(", ", $_POST['hari_tanggal'])[0];
  $jam = explode(" s/d ", $_POST['jam'])[0];

  $nama_member = $_POST['member'];
  $id_member = query("SELECT * FROM member WHERE nama='$nama_member'")[0]['no_member'];

  $durasi_sewa = $_POST['durasi_sewa'];
  $detail = $_POST['harga_per_jam'];
  $metode_pembayaran = $_POST['metode_pembayaran'];
  $harga_total = $_POST['harga_total'];

  $no_lapangan = $_POST['no_lapangan'];
  $jam_penyewaan = time();

  $tambah_penyewaan = "INSERT INTO penyewaan (no_penyewaan, tgl_sewa, hari, jam, harga, durasi, detail, metode_pembayaran, no_member, no_lapangan, jam_penyewaan) VALUES (null, '$tgl_sewa', '$hari', '$jam', '$harga_total', '$durasi_sewa', '$detail', '$metode_pembayaran', '$id_member', '$no_lapangan', '$jam_penyewaan')";

  if (mysqli_query($koneksi, $tambah_penyewaan)) :
    echo true;
  else :
    echo false;
  endif;
  die();
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
    <h1 class="text-center">Dashboard Admin Grand Futsal - Sewa Lapangan</h1>
    <p class="text-center h5 lead">Berikut adalah menu Sewa Lapangan yang tersedia di Grand Futsal.</p>
  </div>

  <main class="container mb-5">
    <form id="form-sewa-lapangan" method="POST">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="no_lapangan"><span class="text-danger">* </span>Lapangan-</label>
            <input type="hidden" name="no_lapangan" value="<?= $lapangan['no_lapangan']; ?>" readonly required>
            <input type="text" class="form-control" id="no_lapangan" value="LAP-<?= $lapangan['lapangan']; ?>" readonly required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="hari_tanggal"><span class="text-danger">* </span>Hari, Tanggal</label>
            <input name="hari_tanggal" type="text" class="form-control" id="hari_tanggal" value="<?= echo_hari(explode(",", date('D', strtotime($tanggal)))[0]); ?>, <?= $tanggal; ?>" readonly required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="jam"><span class="text-danger">* </span>Jam Sewa</label>
            <input name="jam" type="text" class="form-control" id="jam" value="<?= $jam; ?> s/d <?= date("H:i", strtotime("+59 minute", strtotime($jam))); ?>" readonly required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="member"><span class="text-danger">* </span>Member</label>
            <input class="form-control" list="datalist_member" id="member" name="member" placeholder="Ketik untuk mencari ..." required>
            <datalist id="datalist_member">
              <?php foreach ($list_member as $member) : ?>
                <option value="<?= trim($member['nama']); ?>"><?= trim($member['nama']); ?></option>
              <?php endforeach; ?>
            </datalist>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="durasi_sewa"><span class="text-danger">* </span>Durasi Sewa (Jam)</label>
            <?php $jam_split = explode(":", $jam)[0]; ?>
            <select class="form-select" id="durasi_sewa" name="durasi_sewa" required>
              <option value="1" selected>1 (Satu Jam)</option>
              <?php if ($jam_split != 20) : ?>
                <option value="2">2 (Dua Jam)</option>
                <option value="3">3 (Tiga Jam)</option>
              <?php endif; ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="metode_pembayaran"><span class="text-danger">* </span>Konfirmasi Metode Pembayaran</label>
            <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" required>
              <option value="Tunai" selected>Tunai (Cash)</option>
              <option value="BCA">Bank BCA</option>
              <option value="QRIS">QRIS</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="harga_per_jam"><span class="text-danger">* </span>Harga Per Jam</label>
            <input name="harga_per_jam" type="text" class="form-control" id="harga_per_jam" data-harga="<?= $lapangan['harga']; ?>" value="Rp<?= number_format($lapangan['harga']); ?> x <?= 1 ?> Jam" readonly required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label class="form-label" for="harga_total_formated"><span class="text-danger">* </span>Harga Total</label>
            <input name="harga_total" type="hidden" id="harga_total" value="<?= $lapangan['harga']; ?>" readonly required>
            <input type="text" class="form-control text-danger fw-bold" id="harga_total_formated" value="Rp<?= number_format($lapangan['harga']); ?>" readonly required>
          </div>
        </div>
      </div>

      <a href="jadwal.php" class="btn btn-outline-primary">Kembali</a>
      <button type="submit" class="btn btn-primary ms-3">Konfirmasi Sewa Lapangan</button>
    </form>
  </main>

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"></script>

  <script>
    number_format = (number) => {
      var filtered_number = number.replace(/[^0-9]/gi, '');
      var length = filtered_number.length;
      var breakpoint = 1;
      var formated_number = '';

      for (i = 1; i <= length; i++) {
        if (breakpoint > 3) {
          breakpoint = 1;
          formated_number = ',' + formated_number;
        }
        var next_letter = i + 1;
        formated_number = filtered_number.substring(length - i, length - (i - 1)) + formated_number;

        breakpoint++;
      }

      return formated_number;
    }

    $(document).ready(function() {
      $(document).on('submit', "#form-sewa-lapangan", function(e) {
        e.preventDefault();

        $.ajax({
          url: $(this).attr('action'),
          type: "post",
          data: $(this).serialize(),
          error: function() {
            alert("ERROR : CANNOT CONNECT TO SERVER");
          },
          success: function(data) {
            if (data) {
              alert('Penyewaan Berhasil diubah!');
              document.location = 'list-penyewaan.php';
            } else {
              alert('Penyewaan Gagal diubah!');
            }
          }
        });
      });

      $('#durasi_sewa').change(function() {
        let lama_sewa = $('#durasi_sewa').val();
        let jam = $('#jam').val();
        jam = jam.split('s/d ');

        $('#jam').val(`${jam[0]}s/d ${Number(jam[0].split(':')[0]) + Number(lama_sewa)}:59`);

        let harga_lapangan = $('#harga_per_jam').attr('data-harga');
        let format_harga_lapangan = ($('#harga_per_jam').val()).split(" x ")[0];

        $('#harga_per_jam').val(`${format_harga_lapangan} x ${lama_sewa} Jam`);
        $('#harga_total_formated').val(`Rp${number_format(String(harga_lapangan * lama_sewa))}`);
        $('#harga_total').val(String(harga_lapangan * lama_sewa));
      });
    });
  </script>
</body>

</html>