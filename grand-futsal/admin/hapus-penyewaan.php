<?php

include('../__fungsi.php');

if (!check_login()) header("Location: ../login.php");

if ($_GET) {
  $id = $_GET['id'];

  $time = time();
  mysqli_query($koneksi, "DELETE FROM penyewaan WHERE no_penyewaan=$id");

  if (mysqli_affected_rows($koneksi) > 0) {
    echo true;
  } else {
    echo false;
  }
} else {
  header("Location: index.php");
}
