<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Participant</title>

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
        .add-participant-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
        }
        .add-participant-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="add-participant-container">
        <h2>Add New Participant</h2>
        <form action="add_participant_process.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
                <label for="institution" class="form-label">Institution:</label>
                <input type="text" class="form-control" name="institution">
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Country:</label>
                <input type="text" class="form-control" name="country">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <textarea class="form-control" name="address"></textarea>
            </div>
            <button type="submit" class="btn btn-success w-100">Add Participant</button>
        </form>
        <a href="admin_dashboard.php" class="btn btn-secondary w-100 mt-3">Back to Dashboard</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
