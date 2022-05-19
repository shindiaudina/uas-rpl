<?php

include("__fungsi.php");

if (check_login()) header("Location: admin/index.php");

if ($_POST) {
  $username = strtolower($_POST['username']);
  $password = $_POST['password'];

  $akun = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username'");
  if (mysqli_num_rows($akun) == 0) {
    $error = "Username atau Password salah.";
  } else {
    $akun = mysqli_fetch_assoc($akun);
    if (!password_verify($password, $akun['password'])) {
      $error = "Username atau Password salah.";
    } else {
      $_SESSION['id'] = $akun['id'];
      $_SESSION['username'] = $username;

      header("Location: admin/index.php");
    }
  }
}

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
            <a class="nav-link" href="index.php">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="jadwal.php">Jadwal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="login.php"><strong>Login</strong></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-5">
    <h1 class="text-center">Login Grand Futsal</h1>
    <p class="text-center h5 lead">Login Admin Grand Futsal</p>
  </div>

  <main class="container mb-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <?php if ($_POST) : ?>
              <?php if (isset($error)) : ?>
                <div class="alert alert-danger">
                  <?= $error; ?>
                </div>
              <?php endif; ?>
            <?php endif; ?>
            <form method="POST">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group mb-3">
                    <label class="form-label" for="username"><span class="text-danger">* </span>Username</label>
                    <input name="username" type="text" class="form-control" id="username" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-3">
                    <label class="form-label" for="password"><span class="text-danger">* </span>Password</label>
                    <input name="password" type="password" class="form-control" id="password" required>
                  </div>
                </div>
              </div>

              <button class="btn btn-primary px-5">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"></script>
</body>

</html>