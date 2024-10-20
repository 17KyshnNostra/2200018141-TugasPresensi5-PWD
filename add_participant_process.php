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

$email = $_POST['email'];
$name = $_POST['name'];
$institution = $_POST['institution'];
$country = $_POST['country'];
$address = $_POST['address'];

$sql_check = "SELECT * FROM registration WHERE email='$email' AND is_deleted=FALSE";
$result = $conn->query($sql_check);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Participant Process</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('backround.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .response-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="response-container">
        <?php
        if ($result->num_rows > 0) {
            echo '<h2 class="text-danger">Email Already Exists</h2>';
            echo '<p>Please use a different email.</p>';
            echo '<a href="add_participant.php" class="btn btn-secondary">Back to Form</a>';
        } else {
            $sql = "INSERT INTO registration (email, name, institution, country, address) 
                    VALUES ('$email', '$name', '$institution', '$country', '$address')";

            if ($conn->query($sql) === TRUE) {
 
                echo '<h2 class="text-success">Participant Added Successfully!</h2>';
                echo '<a href="admin_dashboard.php" class="btn btn-primary">Back to Dashboard</a>';
            } else {

                echo '<h2 class="text-danger">Error Occurred</h2>';
                echo '<p>' . $conn->error . '</p>';
                echo '<a href="add_participant.php" class="btn btn-secondary">Back to Form</a>';
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
