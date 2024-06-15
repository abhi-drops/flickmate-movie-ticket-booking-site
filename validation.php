<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "flickmate";

$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$con = mysqli_connect('localhost','root');

if($con){
    //echo"connection successful";
}else{
    echo"no connection";
}

mysqli_select_db($con,'flickmate');

$name = $_POST['user'];
$pass = $_POST['password'];

$q = " select * from signin where name = '$name' && password ='$pass' ";

$result = mysqli_query($con,$q);

$num = mysqli_num_rows($result);

if($num == 1)
{

        $sql2 = "SELECT * FROM signin WHERE name='$name'";
        $result2 = $connection->query($sql2);;
        $row2 = $result2->fetch_assoc();

        $uID = $row2["uID"];
        $_SESSION['uID'] = $uID;


        $_SESSION['username'] = $name;
        header('location:home.php');

    }elseif($name == "admin" && $pass == "admin"){

        //ADMIN LOGIN  

            $yourVariable = "adm";

            $sql = "SELECT * FROM signin WHERE name = '$yourVariable'";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                // ADMIN NORMAL LOGIN
                    $name = $yourVariable;
                    $sql2 = "SELECT * FROM signin WHERE name='$name'";
                    $result2 = $connection->query($sql2);;
                    $row2 = $result2->fetch_assoc();
            
                    $uID = $row2["uID"];
                    $_SESSION['uID'] = $uID;
                    $_SESSION['username'] = $name;

                    header('location:admin.php');

            } else {
                // ADMIN FIRST TIME LOGIN
                $insertSql = "INSERT INTO signin (name) VALUES ('$yourVariable')";
                if ($connection->query($insertSql) === TRUE) {
                    //"New record created successfully";
                    $name = $yourVariable;
                    $fpoints = 0;
                    $sql2 = "SELECT * FROM signin WHERE name='$name' AND fpoints = $fpoints";
                    $result2 = $connection->query($sql2);;
                    $row2 = $result2->fetch_assoc();

                    $sql = "UPDATE signin SET fpoints = 0";
                    if ($connection->query($sql) === TRUE) {
                        //Record updated successfully
                        header("location:postpayment.php?coin=$newfcoin");
                    } else {
                        echo "Error updating record: " . $connection->error;
                    }
            
                    $uID = $row2["uID"];
                    $_SESSION['uID'] = $uID;
                    $_SESSION['username'] = $name;

                    header('location:admin.php');


                } else {
                    echo "Error: " . $insertSql . "<br>" . $connection->error;
                }
            }


    

}
else{

    echo '<script>';
    echo 'alert("incorrect password or username !");';
    echo 'window.location.href = "login.php";'; // Replace "new_url.php" with your desired URL
    echo '</script>';


    //echo "<script>alert('incorrect password or username');</script>";
    //header('location:login.php');
}
?>