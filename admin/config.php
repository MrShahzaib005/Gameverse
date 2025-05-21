<?php
 $mysqli = "";

try {

$user = 'dkddyzmy_game_verse';

$password = '_1*A_Q_3_ab_786';

$database = 'dkddyzmy_game_verse';

$servername='localhost:3306';

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