<?php

if(isset($_GET['mid'])){
    $mid = $_GET['mid'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "flickmate";

    $connection = new mysqli($servername,$username,$password,$database);

    $sql = "DELETE FROM movies WHERE mid = $mid";
    $connection->query($sql);
}

header("location: /flickmate/adminMovies.php");
exit;

?>