<?php
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

// cek tombol apakah sudah bisa ditekan
if (isset($_POST['tambah'])) {
  if (tambah($_POST) > 0) {
    echo "<script>
    alert('Data Berhasil Ditambahkan');
    document.location.href = 'index.php';
    </script>";
  } else {
    echo "Data Gagal Ditambahkan!";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data</title>
</head>

<body>
  <h3> Form Tambah Data Bias</h3>
  <form action="" method="POST">
    <input type="hidden" name="Name" value="<?= $a['Name']; ?>">
    <ul>
      <li>
        <label>
          Name :
          <input type="text" name="Name" required>
        </label>
      </li>
      <li>
        <label>
          Birthday :
          <input type="text" name="Birthday" required>
        </label>
      </li>
      <li>
        <label>
          Position :
          <input type="text" name="Position" required>
        </label>
      </li>
      <li>
        <label>
          Photo :
          <input type="text" name="Photo" required>
        </label>
      </li>
      <li>
        <button type="submit" name="tambah">Tambah Data</button>
      </li>
      <br></br>
      <li><a href="index.php">Kembali ke List</a></li>
    </ul>
  </form>
</body>

</html>