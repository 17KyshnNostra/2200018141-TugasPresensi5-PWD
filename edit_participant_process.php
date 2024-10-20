<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seminar_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$email = $_POST['email'];
$name = $_POST['name'];
$institution = $_POST['institution'];
$country = $_POST['country'];
$address = $_POST['address'];

$sql = "UPDATE registration 
        SET email='$email', name='$name', institution='$institution', country='$country', address='$address'
        WHERE id=$id";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Participant Process</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('backround.jpg');
            background-size: cover;
            background-position: center;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Participant Process</h2>

        <div class="card">
            <div class="card-body">
                <?php
                if ($conn->query($sql) === TRUE) {
                    echo '<div class="alert alert-success" role="alert">';
                    echo "Participant updated successfully!";
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo "Error updating record: " . $conn->error;
                    echo '</div>';
                }
                ?>
                <div class="text-center mt-4">
                    <a href="admin_dashboard.php" class="btn btn-primary">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
