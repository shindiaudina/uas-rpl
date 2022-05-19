<?php

session_start();
date_default_timezone_set('Asia/Jakarta');
$koneksi = mysqli_connect("localhost", "root", "", "grand-futsal");

function check_login()
{
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
  $id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

  if (!$username || !$id) return false;

  $data_akun = query("SELECT * FROM admin WHERE id='$id'");

  if (!$data_akun) return false;
  else return $data_akun[0];
}

function echo_hari($hari)
{
  switch ($hari) {
    case 'Sun':
      $hari_ini = "Minggu";
      break;

    case 'Mon':
      $hari_ini = "Senin";
      break;

    case 'Tue':
      $hari_ini = "Selasa";
      break;

    case 'Wed':
      $hari_ini = "Rabu";
      break;

    case 'Thu':
      $hari_ini = "Kamis";
      break;

    case 'Fri':
      $hari_ini = "Jumat";
      break;

    case 'Sat':
      $hari_ini = "Sabtu";
      break;

    default:
      $hari_ini = "Tidak diketahui";
      break;
  }

  return "$hari_ini";
}

function query($kueri)
{
  global $koneksi;
  $hasil = mysqli_query($koneksi, $kueri);
  $total_baris = [];

  while ($baris = mysqli_fetch_assoc($hasil)) {
    $total_baris[] = $baris;
  }

  return $total_baris;
}
