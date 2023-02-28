<?php
require 'functions.php';

// ambil id dari URL
$id = $_GET['id'];
// query berdasarkan id
$a = query("SELECT * FROM ateez WHERE Name = '$id'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail My Bias</title>
</head>

<body>
  <h3>Detail My Bias</h3>
  <ul>
    <li>Photo : <img src="img/<?= $a['Photo']; ?>" width="100"></li>
    <li>Nama : <?= $a['Name']; ?></li>
    <li>Birthday : <?= $a['Birthday']; ?></li>
    <li>Position : <?= $a['Position']; ?></li>
    <li><a href="">ubah</a> | <a href="">hapus</a></li>
    <li><a href="latihan3.php">kembali ke list</a></li>
  </ul>
</body>

</html>