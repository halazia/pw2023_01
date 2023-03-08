<?php
// koneksi ke data base dan pilih database

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

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
            Photo = '$Photo'
            WHERE Name = '$id'";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function cari($keyword)
{
  $conn = koneksi();

  $query = "SELECT * FROM ateez
            WHERE Name LIKE '%$keyword%' OR
            Position LIKE '%$keyword%'";
  $result = mysqli_query($conn, $query);

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function login($data)
{
  $conn = koneksi();

  $username = htmlspecialchars($data['username']);
  $password = htmlspecialchars($data['password']);

  // cek dulu username 
  if ($user = query("SELECT * FROM user WHERE username = '$username'")) {
    // cek password
    if (password_verify($password, $user['password'])) {
      // set session
      $_SESSION['login'] = true;
      header("Location: index.php");
      exit;
    }
  }
  return [
    'error' => true,
    'pesan' => 'username / password salah!'
  ];
}

function registrasi($data)
{
  $conn = koneksi();

  $username = htmlspecialchars(strtolower($data['username']));
  $password1 = mysqli_real_escape_string($conn, $data['password1']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);

  // jika username atau password kosong
  if (empty($username) || empty($password1) || empty($password2)) {
    echo "<script>
          alert('username atau password tidak boleh kosong!');
          document.location.href= 'registrasi.php';
          </script>";
    return false;
  }

  // jika username sudah ada
  if (query("SELECT * FROM user WHERE username = '$username'")) {
    echo "<script>
          alert('username sudah terdaftar!');
          document.location.href= 'registrasi.php';
          </script>";
    return false;
  }

  // jika konsfirmasi password tidak sesuai
  if ($password1 !== $password2) {
    echo "<script>
          alert('konfirmasi password tidak sesuai');
          document.location.href= 'registrasi.php';
          </script>";
    return false;
  }

  // jika password < 5 digit
  if (strlen($password1) < 5) {
    echo "<script>
          alert('Password terlalu pendek!');
          document.location.href= 'registrasi.php';
          </script>";
    return false;
  }

  // jika username dan password sudah sesuai, lakukan enkripsi password
  $password_baru = password_hash($password1, PASSWORD_DEFAULT);

  // insert ke table databse user
  $query = "INSERT INTO user
            VALUES
            ('', '$username', '$password_baru')";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
