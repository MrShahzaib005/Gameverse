<?php include 'config.php'; 
session_start();
if(!isset($_SESSION['admin'])) {
    
    header("Location: login.php");
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $result = $mysqli->query("SELECT * FROM registration WHERE id=$id");
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Registration Update</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 500px;
            margin-top: 50px;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="container bg-light p-4 rounded shadow">
        <h2 class="text-center mb-4">Update Registration Details</h2>

        <form method="post" action="update.php">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">

            <div class="mb-3">
                <label for="name" class="form-label">CNIC:</label>
                <input type="text" id="cnic" name="cnic" value="<?= $row['cnic'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email_address" name="email_address" value="<?= $row['email_address'] ?>" class="form-control" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" id="transactionVerified" name="transactionVerified" class="form-check-input" <?= $row['transactionVerified'] ? 'checked' : '' ?>>
                <label for="transactionVerified" class="form-check-label">Transaction Verified</label>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" id="emailVerified" name="emailVerified" class="form-check-input" <?= $row['emailVerified'] ? 'checked' : '' ?>>
                <label for="emailVerified" class="form-check-label">Email Verified</label>
            </div>

            <button type="submit" name="update" class="btn btn-primary w-100">Update</button>
        </form>
    </div>

</body>
</html>


