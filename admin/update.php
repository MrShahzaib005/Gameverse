<?php
include 'config.php';
session_start();
if(!isset($_SESSION['admin'])) {
    
    header("Location: login.php");
}

// Read (Fetch Data)
$result = $mysqli->query("SELECT * FROM registration");

// Update (Edit)
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $cnic = $_POST['cnic'];
    $email = $_POST['email_address'];
    $emailVerified = isset($_POST['emailVerified'])? 1:0;
    $transactionVerified =  isset($_POST['transactionVerified'])? 1:0;
    
   $sql = "UPDATE registration SET cnic='$cnic', email_address='$email', transactionVerified='$transactionVerified',emailVerified = '$emailVerified' WHERE id=$id";
   $mysqli->query($sql);
    header("Location: dashboard.php");

}
?>
