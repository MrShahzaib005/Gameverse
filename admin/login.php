<?php
session_start();
include 'config.php';
    //$hashedPassword = password_hash("admin123", PASSWORD_BCRYPT);
    //$sql = "insert into admin_users (username,password) values ('admin','$hashedPassword')";
    //$mysqli->query($sql);

if (isset($_POST["login"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $mysqli->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    // Secure password check using password_verify()
    if (password_verify($password, $row['password'])) {
        // Authentication successful
        $_SESSION['admin'] = $row['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
} else {
    $error = "Invalid username or password!";
}
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .container { max-width: 400px; margin-top: 100px; }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="container bg-light p-4 rounded shadow">
        <h2 class="text-center mb-4">Admin Login</h2>

        <?php if(isset($error)): ?>
            <p class="text-danger text-center"><?= $error ?></p>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</body>
</html>
