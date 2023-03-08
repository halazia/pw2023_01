<?php
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}
require('functions.php');
// tampung ke variable data
$ateez = query("SELECT *FROM ateez");  //variabel ini telah terisi dengan file database

// ketika tombol cari diclick
if (isset($_POST['cari'])) {
  $ateez = cari($_POST['keyword']);
}

// setelah var terisi dengan file db, lakukan looping pada kode <tr><td> dengan memasukannya ke tag <php> terlebuh dahulu 
// dengan kode <?php foreach() : ? dalam tanda kurung diisi var data / $my_bias as $m ditutup dengan <?php endforeach; ?
// lalu datanya di edit dengan masukan tag php $m yg tadi dimasukan ke foreach
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ATEEZ</title>
</head>

<body>
  <a href="logout.php">Logout</a>
  <h3>MY BIAS</h3>

  <button><a href="Tambah.php">Tambah Data</a></button>
  <br></br>

  <form action="" method="POST">
    <input type="text" name="keyword" size="40" placeholder="masukan keyword pencarian...." autocomplete="off" autofocus>
    <button type="submit" name="cari">Cari!</button>
  </form>
  <br></br>
  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Photo</th>
      <th>Name</th>
      <th>Aksi</th>
    </tr>

    <?php if (empty($ateez)) : ?>
      <tr>
        <td colspan="4">
          <p style="color: red; font-style: italic;">Data Tidak Ditemukan!</p>
        </td>
      </tr>
    <?php endif; ?>

    <?php $No = 1;
    foreach ($ateez as $a) : ?>
      <tr>
        <td><?= $No++; ?></td>
        <td><img src="img/<?= $a['Photo']; ?>" width="100"></td>
        <td><?= $a['Name']; ?></td>
        <td>
          <a href="detail.php?id=<?= $a['Name']; ?>">Lihat</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>