<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
    $conn= mysqli_connect('localhost','root','','flickmate') or die("connection failed:".mysqli_connect_error());
    if(isset($_POST['mname']) && isset($_POST['mdes']) && isset($_POST['mrating']) && isset($_POST['mtlink']) && isset($_POST['mdir'])&& isset($_POST['mlang'])&& isset($_POST['msd'])&& isset($_POST['med'])&& isset($_POST['mpos'])&& isset($_POST['mssp'])&& isset($_POST['mgsp'])&& isset($_POST['mpsp']))
    {
        $mname = $_POST['mname'];
        $mdes = $_POST['mdes'];
        $mrating = $_POST['mrating'];
        $mtlink = $_POST['mtlink'];
        $mdir = $_POST['mdir'];
        $mlang = $_POST['mlang'];
        $msd = $_POST['msd'];
        $med = $_POST['med'];
        $mpos = $_POST['mpos'];
        $mssp = $_POST['mssp'];
        $mgsp = $_POST['mgsp'];
        $mpsp = $_POST['mpsp'];
        $emb = '/embed/';
        $mtlink = str_replace("/watch?v=",$emb,$mtlink);

        $sql = "INSERT INTO `movies`(`mname`, `mdes`, `mrating`, `mtlink`, `mdir`, `mlang`,`msd`,`med`, `mpos`,`mssp`,`mgsp`,`mpsp`) VALUES('$mname','$mdes','$mrating','$mtlink','$mdir','$mlang','$msd','$med', '$mpos','$mssp','$mgsp','$mpsp')";

        $query = mysqli_query($conn,$sql);
        if($query){
            echo 'entry sucessfull';
            header("location: /flickmate/adminMovies.php");
            exit;
        }
        else{
            echo'error occurred';
        }
    }
?>