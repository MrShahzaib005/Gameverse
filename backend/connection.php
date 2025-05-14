<?php
 $mysqli = "";

try {

$user = 'root';

$password = 'root';

$database = 'game-verse';

$servername='https://gameverse-theta.vercel.app/';

$mysqli = new mysqli($servername, $user,

                $password, $database);

 

// Checking for connections

if ($mysqli->connect_error) {

    die('Connect Error (' .

    $mysqli->connect_errno . ') '.

    $mysqli->connect_error);

}



}

catch(Exception $e) {

    echo "<b style='color:red;padding-left:80px;'>Connection failed: " . $e->getMessage()."</b>";

}

 

?>