<?php
include_once('./backend/connection.php');
session_start();

$verificationMessage = "";
$alertClass = "alert-danger"; // Default to error state

if (isset($_GET['code']) && !empty($_GET['code'])) {
    $code = $_GET['code'];
    $decodedCode = base64_decode($code);

    // Check if email is already verified
    $checkQuery = "SELECT emailVerified FROM registration WHERE email_address = ?";
    $stmt = $mysqli->prepare($checkQuery);
    $stmt->bind_param("s", $decodedCode);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if ($row['emailVerified'] == 1) {
            $verificationMessage = "✅ Your email is already verified!";
            $alertClass = "alert-info";
        } else {
            // Update email verification status
            $updateQuery = "UPDATE registration SET emailVerified = 1 WHERE email_address = ?";
            $stmt = $mysqli->prepare($updateQuery);
            $stmt->bind_param("s", $decodedCode);
            
            if ($stmt->execute()) {
                $verificationMessage = "🎉 Your email has been successfully verified!";
                $alertClass = "alert-success";
            } else {
                $verificationMessage = "❌ Verification failed. Please try again or contact support.";
            }
        }
    } else {
        $verificationMessage = "⚠️ Invalid verification code!";
    }

    $stmt->close();
} else {
    $verificationMessage = "⚠️ Missing verification code.";
}

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Email Verification | GameVerse</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .container { max-width: 500px; margin-top: 100px; }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="container bg-light p-4 rounded shadow text-center">
        <h2 class="mb-3">Email Verification</h2>

        <div class="alert <?= $alertClass ?>" role="alert">
            <?= $verificationMessage ?>
        </div>

        <a href="index.php" class="btn btn-primary mt-3">Go to Homepage</a>
    </div>
</body>
</html>
