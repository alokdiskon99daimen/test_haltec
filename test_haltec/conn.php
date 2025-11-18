<?php
$conn = mysqli_connect("localhost","root","","test_haltec"); //koneksi ke database

if (mysqli_connect_errno()) { //handling error koneksi database
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

?>
