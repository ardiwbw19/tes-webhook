<?php
$host = "localhost";
$user = "root";
$pass = "12345678";
$db   = "tes";

$conn = new mysqli($host, $user, $pass, $db,3307);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>