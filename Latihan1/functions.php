<?php
// koneksi ke data base dan pilih database
function koneksi()
{
  return mysqli_connect('localhost', 'root', '', 'pw2023_01');
}
// query isi tabel data
function query($query)
{
  $conn = koneksi();

  $result = mysqli_query($conn, $query);

  // jika hasilnya hanya 1 data
  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }
  // ubah data ke dalam array
  // $row = mysqli_fetch_row($result); // array numerik
  // $row = mysqli_fetch_assoc($result); // array associative
  // $row = mysqli_fetch_array($result); // keduanya
  $rows = []; // array kosong yang nantinya akan diisi data tabel
  while ($row = mysqli_fetch_assoc($result)) {   // perintah  WHILE untuk looping code
    $rows[] = $row; // untuk mengisi array $rows yg masih kosong/isi dari kurung sikunya
  }

  return $rows;
}
function tambah($data)
{
  $conn = koneksi();
  $Name = htmlspecialchars($data['Name']);
  $Birthday = htmlspecialchars($data['Birthday']);
  $Position = htmlspecialchars($data['Position']);
  $Photo = htmlspecialchars($data['Photo']);

  $query = "INSERT INTO
              ateez
            VALUES
            ('','$Name','$Birthday','$Position','$Photo')
            ";
  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);
}
function hapus($id)
{
  $conn = koneksi();
  mysqli_query($conn, "DELETE FROM ateez WHERE Name='$id'") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
function ubah($data)
{
  $conn = koneksi();

  $id = $data['id'];
  $Name = htmlspecialchars($data['Name']);
  $Birthday = htmlspecialchars($data['Birthday']);
  $Position = htmlspecialchars($data['Position']);
  $Photo = htmlspecialchars($data['Photo']);

  $query = "UPDATE ateez SET
            Name = '$Name',
            Birthday = '$Birthday',
            Position = '$Position',
            Photo = '$Photo',
            WHERE Name = '$id'";
  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);
}
