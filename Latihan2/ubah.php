<?php
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

//jika tidak ada id di url
if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}

//ambil id dari url
$id = $_GET['id'];

//query data berdasarkan id
$a = query("SELECT * FROM ateez WHERE Name = '$id'");

// cek tombol apakah sudah bisa ditekan
if (isset($_POST['ubah'])) {
  if (ubah($_POST) > 0) {
    echo "<script>
    alert('Data Berhasil Diubah');
    document.location.href= 'index.php';
    </script>";
  } else {
    echo "Data Gagal Diubah!";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubah Data Bias</title>
</head>

<body>
  <h3> Form Ubah Data Bias</h3>
  <form action="" method="POST">
    <input type="hidden" name="id" value="<?= $a['Name']; ?>">
    <ul>
      <li>
        <label>
          Name :
          <input type="text" name="Name" required value="<?= $a['Name']; ?>">
        </label>
      </li>
      <li>
        <label>
          Birthday :
          <input type="text" name="Birthday" required value="<?= $a['Birthday']; ?>">
        </label>
      </li>
      <li>
        <label>
          Position :
          <input type="text" name="Position" required value="<?= $a['Position']; ?>">
        </label>
      </li>
      <li>
        <label>
          Photo :
          <input type="text" name="Photo" required value="<?= $a['Photo']; ?>">
        </label>
      </li>
      <li>
        <button type="submit" name="ubah">Ubah Data</button>
      </li>
      <br></br>
      <li><a href="index.php">Kembali</a></li>
    </ul>
  </form>
</body>

</html>