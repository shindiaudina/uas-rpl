<?php

include('../__fungsi.php');

if (!check_login()) header("Location: ../login.php");

if ($_GET) {
  $id = $_GET['id'];

  $total_admin = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM admin"));
  if ($total_admin == 1) {
    echo false;
  } else {
    mysqli_query($koneksi, "DELETE FROM admin WHERE id=$id");

    if (mysqli_affected_rows($koneksi) > 0) {
      echo true;
    } else {
      echo false;
    }
  }
} else {
  header("Location: index.php");
}
