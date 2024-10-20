<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seminar_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form
$email = $_POST['email'];
$name = $_POST['name'];
$institution = $_POST['institution'];
$country = $_POST['country'];
$address = $_POST['address'];

// Cek apakah email sudah ada
$sql_check = "SELECT * FROM registration WHERE email='$email' AND is_deleted=FALSE";
$result = $conn->query($sql_check);

$response = [];

if ($result->num_rows > 0) {
    $response['status'] = 'error';
    $response['message'] = 'Email sudah terdaftar, gunakan email lain.';
} else {
    // Insert data ke tabel
    $sql = "INSERT INTO registration (email, name, institution, country, address) 
            VALUES ('$email', '$name', '$institution', '$country', '$address')";

    if ($conn->query($sql) === TRUE) {
        $response['status'] = 'success';
        $response['message'] = 'Pendaftaran berhasil!';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $conn->error;
    }
}

$conn->close();
echo json_encode($response);
?>
