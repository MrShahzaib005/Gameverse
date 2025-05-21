<?php 
include 'config.php';
session_start(); // Start session

if (!isset($_SESSION["admin"])) { // Check if admin session is NOT set
    header("Location: login.php"); // Redirect to login page
    exit(); // Stop further execution
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $result = $mysqli->query("Delete FROM registration WHERE id=$id");
}

// Fetch available provinces for dropdown
$provinceResult = $mysqli->query("SELECT DISTINCT province FROM registration");

// Get selected province
$selectedProvince = isset($_GET['province']) ? $_GET['province'] : '';

// Modify query based on filter
$sql = "SELECT * FROM registration";
if ($selectedProvince) {
    $sql .= " WHERE province = '$selectedProvince'";
}

$result = $mysqli->query($sql);

// Read (Fetch Data)
//$result = $mysqli->query("SELECT * FROM registration");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>GamesVerse :: Administration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h6><a href='logout.php'>Logout</a></h6>
    <h2>Registration List</h2>

     <!-- Province Filter -->
    <form method="GET">
        <label for="province">Filter by Province:</label>
        <select name="province" id="province" class="form-select" onchange="this.form.submit()">
            <option value="">All</option>
            <?php while ($provRow = $provinceResult->fetch_assoc()): ?>
                <option value="<?= $provRow['province'] ?>" <?= ($selectedProvince == $provRow['province']) ? 'selected' : '' ?>>
                    <?= $provRow['province'] ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>
    
    <table class="table table-bordered">
        <tr>
            <th>Email</th><th>CNIC</th><th>Province</th><th>Transaction ID</th><th>Email Verified</th><th>Transaction Verified</th><th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['email_address'] ?></td>
            <td><?= $row['cnic'] ?></td>
            <td><?= $row['province'] ?></td>
            <td><?= $row['transactionId'] ?></td>
            <td><?= $row['emailVerified']? 'YES':'NO' ?></td>
            <td><?= $row['transactionVerified']? 'YES':'NO' ?></td>
            <td>
                <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
