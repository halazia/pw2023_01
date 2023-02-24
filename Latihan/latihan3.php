<?php
require('functions.php');
// tampung ke variable data
$ateez = query("SELECT *FROM ateez");; //variabel ini telah terisi dengan file database

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
  <h3>MY BIAS</h3>
  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Photo</th>
      <th>Name</th>
      <th>Aksi</th>
    </tr>

    <?php $i = 1;
    foreach ($ateez as $a) : ?>
      <tr>
        <td><?= $i++; ?></td>
        <td><img src="img/<?= $a['Photo']; ?>" width="100"></td>
        <td><?= $a['Name']; ?></td>
        <td>
          <a href="detail.php?id=<?= $a['No']; ?>">Lihat</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>