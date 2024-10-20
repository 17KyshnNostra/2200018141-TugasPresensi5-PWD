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

$sql = "SELECT * FROM registration";
$result = $conn->query($sql);

if ($result === false) {
    die("Error: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .container {
            position: relative;
            z-index: 1;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px; 
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #333;
        }
        .table {
            margin-top: 20px; 
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center; 
        }
        .btn {
            transition: background-color 0.3s;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body class="bg-light">
    <div class="overlay"></div>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Admin Dashboard</h2>
        <a href="add_participant.php" class="btn btn-primary mb-3">Add Participant</a>
        
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Institution</th>
                    <th>Country</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) { ?>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['institution']); ?></td>
                            <td><?php echo htmlspecialchars($row['country']); ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td>
                                <a href="edit_participant.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            <div class="alert alert-warning" role="alert">
                                No participants found.
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
