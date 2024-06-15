<?php
session_start();
$con = mysqli_connect('localhost','root');
if($con){
    echo "Connection successful";
}else{
    echo "No connection";
}
mysqli_select_db($con,'flickmate');
$name = $_POST['user'];
$pass = $_POST['password'];
$pnumber = $_POST['pnumber'];

if (is_numeric($name)) {
    echo "Username cannot be just numbers";
    header('location:signup.php');
    exit;
}

$q = "SELECT * FROM signin WHERE name = '$name' && password ='$pass'";
$q2 = "SELECT * FROM signin WHERE name = '$name'";
$result = mysqli_query($con,$q);
$result2 = mysqli_query($con,$q2);
$num = mysqli_num_rows($result);
$num2 = mysqli_num_rows($result2);
if($num == 1 or $num2 == 1) {   
    echo "Duplicate data";
    header('location:signup.php');
} else {
    if($num == 1) {
       
    } else {
        $qy = "INSERT INTO signin (name, password, pnumber) VALUES ('$name','$pass','$pnumber')";
        mysqli_query($con,$qy);
        header('location:login.php');
    }
}
?>