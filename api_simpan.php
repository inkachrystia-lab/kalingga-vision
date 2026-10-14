<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "kalingga_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_POST['status']) && isset($_POST['bahaya'])) {
    $status = $conn->real_escape_string($_POST['status']);
    $bahaya = $conn->real_escape_string($_POST['bahaya']);

    $sql = "INSERT INTO log_status (status_pesan, tingkat_bahaya) VALUES ('$status', '$bahaya')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dikirim ke database!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>