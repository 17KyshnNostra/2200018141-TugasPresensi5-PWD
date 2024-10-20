<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seminar_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM registration WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $participant = $result->fetch_assoc(); 
    } else {
        echo "Participant not found.";
        exit;
    }

    $stmt->close();
} else {
    echo "No participant ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Participant</title>
    
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
        <h2 class="text-center mb-4">Edit Participant</h2>
        
        <form action="edit_participant_process.php" method="POST" class="border p-4 bg-white rounded shadow">
            
            <input type="hidden" name="id" value="<?php echo $participant['id']; ?>">

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" value="<?php echo $participant['email']; ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" value="<?php echo $participant['name']; ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="institution" class="form-label">Institution:</label>
                <input type="text" name="institution" value="<?php echo $participant['institution']; ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country:</label>
                <input type="text" name="country" value="<?php echo $participant['country']; ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <textarea name="address" class="form-control"><?php echo $participant['address']; ?></textarea>
            </div>

            <button type="submit" class="btn btn-success">Save Changes</button>
            <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
