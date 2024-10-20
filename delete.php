<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seminar_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM registration WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    $message = "Peserta berhasil dihapus.";
} else {
    $message = "Error deleting record: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Seminar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('backround.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            width: 400px;
            text-align: center;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
        }
        .btn-back {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h5 class="card-title">Status Penghapusan</h5>
        <p class="card-text"><?php echo $message; ?></p>
        <a href="admin_dashboard.php" class="btn btn-primary btn-back">Back to Dashboard</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
