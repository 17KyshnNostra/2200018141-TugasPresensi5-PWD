<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        .register-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }
        .register-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .bg-logo {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100px;
            height: auto;
            transform: translate(-50%, -50%);
            animation: move 5s linear infinite;
            z-index: 0;
        }
        
    </style>
</head>
<body> 
    <div class="register-container">
        <h2>Seminar Registration</h2>
        <form id="registrationForm">
            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name :</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="institution" class="form-label">Institution :</label>
                <input type="text" class="form-control" id="institution" name="institution" required>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Country :</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address :</label>
                <textarea class="form-control" id="address" name="address" required></textarea>
            </div>
            <button type="submit" class="btn btn-success w-100">Register</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="responseModalLabel">Response</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalMessage"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#registrationForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: 'register_process.php',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        $('#modalMessage').text(response.message);
                        $('#responseModal').modal('show');
                        if (response.status === 'success') {
                            
                            setTimeout(function() {
                                window.location.href = 'register.php';
                            }, 2000);
                        }
                    },
                    error: function () {
                        $('#modalMessage').text('Terjadi kesalahan, coba lagi.');
                        $('#responseModal').modal('show');
                    }
                });
            });
        });
    </script>
</body>
</html>
