<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "flickmate";




$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["mid"])) {
        header("location: /flickmate/home.php");
        exit;
    }

    
    $mid = $_GET["mid"];
    $bdate = $_GET["bdate"];
    $btime = $_GET["btime"];

    

    $tname = $bdate . $btime ;

    $tname = preg_replace('/[^a-zA-Z0-9_]/', '_', $tname);

    $sql = "SHOW TABLES LIKE '$tname'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {

      $sql = "SELECT sno FROM $tname";
      $result = $connection->query($sql);
      
      $occupiedSeats = array();
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $occupiedSeats[] = $row['sno'];
          }
      }

        


    } else {
      $sql = "CREATE TABLE `$tname` (
          sid INT(225) NOT NULL AUTO_INCREMENT,
          sno VARCHAR(20) NOT NULL,
          stype VARCHAR(1) NOT NULL,
          uID INT(225) NOT NULL,
          PRIMARY KEY (sid),
          FOREIGN KEY (uID) REFERENCES signin(uID)
      )";

      if ($connection->query($sql) === TRUE) {

        //if a new table is created sucessfully
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
          
      } else {
          echo "Error creating table: " . $connection->error;
      }
  }

  $sql2 = "SELECT * FROM movies WHERE mid='$mid'";
  $result2 = $connection->query($sql2);
  

  if (!$result2){
    die("invalid query (movie not found): ".$connection->error);
  }
  else
  {
    $row = $result2->fetch_assoc();

    if(!$row){
      //header("location:home.php");
      exit;
    }
    
    $mssp = $row["mssp"];
    $mgsp = $row["mgsp"];
    $mpsp = $row["mpsp"];

  }

}


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
        @import url("https://fonts.googleapis.com/css?family=Montserrat&display=swap");

@import url("https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css");

body {
	font-family: "Montserrat", sans-serif;
	min-height: 100vh;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
  background-color: #afafaf15;
  color: #0e0e0e;
  margin: 0;
}

* {
	font-family: "Montserrat", sans-serif !important;
  box-sizing: border-box;
}

.movie-container {
  margin: 20px 0px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column
}

.movie-container select {
  appearance: none;
  -moz-appearance: none;
  -webkit-appearance: none;
  border: 0;
  padding: 5px 15px;
  margin-bottom: 40px;
  font-size: 14px;
  border-radius: 5px;
}

.container {
  perspective: 1000px;
  margin: 40px 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.seat {
  background-color: #3d3d3d;
  height: 12px;
  width: 15px;
  margin: 5px;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}

.selected {
  background-color: #0cbbda;
}

.occupied {
  background-color: #d83c3c;
}

.seat:nth-of-type(8) {
  margin-right: 30px;
}

.seat:nth-last-of-type(8) {
  margin-left: 30px;
}

.seat:not(.occupied):hover {
  cursor: pointer;
  transform: scale(1.2);
}

.showcase .seat:not(.occupied):hover {
  cursor: default;
  transform: scale(1);
}

.showcase {
  display: flex;
  justify-content: space-between;
  list-style-type: none;
  background: rgba(0,0,0,0.1);
  padding: 5px 10px;
  border-radius: 5px;
  color: #777;
}

.showcase li {
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 10px;
}

.showcase li small {
  margin-left: 2px;
}

.row {
  display: flex;
  align-items: center;
  justify-content: center;
}

.screen {
  background: #f0f0f0;
  height: 70px;
  width: 70%;
  margin: 15px 0;
  transform: rotateX(-45deg);
  box-shadow: 0 3px 10px rgb(184, 184, 184);
}

p.text {
  margin: 40px 0;
}

p.text span {
  color: #0081cb;
  font-weight: 600;
  box-sizing: content-box;
}

.credits a {
  color: #fff;
}
.txt{
  padding-left: 17.5px;
  font-size: 10px;
}
.ltxt{
  font-size: 10px;
  padding-right:18px ;
  padding-top: 15px;
}

    </style>
</head>
<body>
    <div class="movie-container">

        
        
        <ul class="showcase">
          <li>
            <div class="seat"></div>
            <small>N/A</small>
          </li>
          <li>
            <div class="seat selected"></div>
            <small>Selected</small>
          </li>
          <li>
            <div class="seat occupied"></div>
            <small>Occupied</small>
          </li>    
        </ul>
        
        <div class="container">
                  <div class="screen"></div>
                  <p style="padding: 0;">platinum</p>
                  <div class="row">
                    
                    <P  class="txt" style="padding-left: 40px;">1</P>
                    <P  class="txt">2</P>
                    <P  class="txt">3</P>
                    <P  class="txt">4</P>
                    <P  class="txt">5</P>
                    <P  class="txt">6</P>
                    <P  class="txt">7</P>
                    <P  class="txt">8</P>
                    <P  class="txt" style="padding-left: 37px;">9</P>
                    <P  class="txt">10</P>
                    <P  class="txt">11</P>
                    <P class="txt">12</P>
                    <P class="txt">13</P>
                    <P  class="txt">14</P>
                    <P  class="txt">15</P>
                    <P  class="txt">16</P>
                    <P  class="txt" style="padding-left: 37px;">17</P>
                    <P  class="txt">18</P>
                    <P  class="txt">19</P>
                    <P  class="txt">20</P>
                    <P  class="txt">21</P>
                    <P  class="txt">22</P>
                    <P  class="txt">23</P>
                    <P class="txt">24</P>

                    </div>
                  <div class="row">
                      <P class="ltxt">A</P>
                      <div data-class="platinum" class="seat"  data-seat-number="A1"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A2"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A3"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A4"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A5"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A6"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A7"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A8"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A9"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A10"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A11"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A12"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A13"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A14"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A15"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A16"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A17"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A18"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A19"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A20"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A21"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A22"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A23"></div>
                      <div data-class="platinum" class="seat"  data-seat-number="A24"></div>
                      
                    </div>
                    <br>
                    <p style="padding: 0;">gold</p>
                    
                    <div class="row">
                    <P class="ltxt">B</P>
                        <div data-class="gold" class="seat  " data-seat-number="B1" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="B2"></div>
                        <div data-class="gold" class="seat  " data-seat-number="B3" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="B4"></div>
                        <div data-class="gold" class="seat  " data-seat-number="B5" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="B6"></div>
                        <div data-class="gold" class="seat  " data-seat-number="B7" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="B8"></div>
                        <div data-class="gold" class="seat  " data-seat-number="B9" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="B10"></div>
                        <div data-class="gold" class="seat  " data-seat-number="B11" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="B12"></div>
                        <div data-class="gold" class="seat  " data-seat-number="B13" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="B14"></div>
                        <div data-class="gold" class="seat  " data-seat-number="B15" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="B16"></div>
                        <div data-class="gold" class="seat  " data-seat-number="B17"></div>
                        <div data-class="gold" class="seat  " data-seat-number="B18" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="B19"></div>
                        <div data-class="gold" class="seat  " data-seat-number="B20" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="B21"></div>
                        <div data-class="gold" class="seat  " data-seat-number="B22" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="B23"></div>
                        <div data-class="gold" class="seat  " data-seat-number="B24"></div>
                    </div>
                    <div class="row">
                    <P class="ltxt">C</P>
                        <div data-class="gold" class="seat  " data-seat-number="C1" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="C2"></div>
                        <div data-class="gold" class="seat  " data-seat-number="C3" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="C4"></div>
                        <div data-class="gold" class="seat  " data-seat-number="C5" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="C6"></div>
                        <div data-class="gold" class="seat  " data-seat-number="C7" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="C8"></div>
                        <div data-class="gold" class="seat  " data-seat-number="C9" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="C10"></div>
                        <div data-class="gold" class="seat  " data-seat-number="C11" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="C12"></div>
                        <div data-class="gold" class="seat  " data-seat-number="C13" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="C14"></div>
                        <div data-class="gold" class="seat  " data-seat-number="C15" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="C16"></div>
                        <div data-class="gold" class="seat  " data-seat-number="C17"></div>
                        <div data-class="gold" class="seat  " data-seat-number="C18" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="C19"></div>
                        <div data-class="gold" class="seat  " data-seat-number="C20" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="C21"></div>
                        <div data-class="gold" class="seat  " data-seat-number="C22" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="C23"></div>
                        <div data-class="gold" class="seat  " data-seat-number="C24"></div>
                    </div>
                    <div class="row">
                    <P class="ltxt">D</P>
                    <div data-class="gold" class="seat  " data-seat-number="D1" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="D2"></div>
                        <div data-class="gold" class="seat  " data-seat-number="D3" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="D4"></div>
                        <div data-class="gold" class="seat  " data-seat-number="D5" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="D6"></div>
                        <div data-class="gold" class="seat  " data-seat-number="D7" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="D8"></div>
                        <div data-class="gold" class="seat  " data-seat-number="D9" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="D10"></div>
                        <div data-class="gold" class="seat  " data-seat-number="D11" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="D12"></div>
                        <div data-class="gold" class="seat  " data-seat-number="D13" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="D14"></div>
                        <div data-class="gold" class="seat  " data-seat-number="D15" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="D16"></div>
                        <div data-class="gold" class="seat  " data-seat-number="D17"></div>
                        <div data-class="gold" class="seat  " data-seat-number="D18" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="D19"></div>
                        <div data-class="gold" class="seat  " data-seat-number="D20" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="D21"></div>
                        <div data-class="gold" class="seat  " data-seat-number="D22" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="D23"></div>
                        <div data-class="gold" class="seat  " data-seat-number="D24"></div>
                    </div>
                    <div class="row">
                    <P class="ltxt">E</P>
                    <div data-class="gold" class="seat  " data-seat-number="E1" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="E2"></div>
                        <div data-class="gold" class="seat  " data-seat-number="E3" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="E4"></div>
                        <div data-class="gold" class="seat  " data-seat-number="E5" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="E6"></div>
                        <div data-class="gold" class="seat  " data-seat-number="E7" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="E8"></div>
                        <div data-class="gold" class="seat  " data-seat-number="E9" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="E10"></div>
                        <div data-class="gold" class="seat  " data-seat-number="E11" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="E12"></div>
                        <div data-class="gold" class="seat  " data-seat-number="E13" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="E14"></div>
                        <div data-class="gold" class="seat  " data-seat-number="E15" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="E16"></div>
                        <div data-class="gold" class="seat  " data-seat-number="E17"></div>
                        <div data-class="gold" class="seat  " data-seat-number="E18" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="E19"></div>
                        <div data-class="gold" class="seat  " data-seat-number="E20" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="E21"></div>
                        <div data-class="gold" class="seat  " data-seat-number="E22" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="E23"></div>
                        <div data-class="gold" class="seat  " data-seat-number="E24"></div>
                    </div>
                    <div class="row">
                    <P class="ltxt">F</P>
                    <div data-class="gold" class="seat  " data-seat-number="F1" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="F2"></div>
                        <div data-class="gold" class="seat  " data-seat-number="F3" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="F4"></div>
                        <div data-class="gold" class="seat  " data-seat-number="F5" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="F6"></div>
                        <div data-class="gold" class="seat  " data-seat-number="F7" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="F8"></div>
                        <div data-class="gold" class="seat  " data-seat-number="F9" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="F10"></div>
                        <div data-class="gold" class="seat  " data-seat-number="F11" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="F12"></div>
                        <div data-class="gold" class="seat  " data-seat-number="F13" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="F14"></div>
                        <div data-class="gold" class="seat  " data-seat-number="F15" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="F16"></div>
                        <div data-class="gold" class="seat  " data-seat-number="F17"></div>
                        <div data-class="gold" class="seat  " data-seat-number="F18" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="F19"></div>
                        <div data-class="gold" class="seat  " data-seat-number="F20" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="F21"></div>
                        <div data-class="gold" class="seat  " data-seat-number="F22" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="F23"></div>
                        <div data-class="gold" class="seat  " data-seat-number="F24"></div>
                    </div>
                    <div class="row">
                    <P class="ltxt">G</P>
                    <div data-class="gold" class="seat  " data-seat-number="G1" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="G2"></div>
                        <div data-class="gold" class="seat  " data-seat-number="G3" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="G4"></div>
                        <div data-class="gold" class="seat  " data-seat-number="G5" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="G6"></div>
                        <div data-class="gold" class="seat  " data-seat-number="G7" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="G8"></div>
                        <div data-class="gold" class="seat  " data-seat-number="G9" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="G10"></div>
                        <div data-class="gold" class="seat  " data-seat-number="G11" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="G12"></div>
                        <div data-class="gold" class="seat  " data-seat-number="G13" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="G14"></div>
                        <div data-class="gold" class="seat  " data-seat-number="G15" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="G16"></div>
                        <div data-class="gold" class="seat  " data-seat-number="G17"></div>
                        <div data-class="gold" class="seat  " data-seat-number="G18" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="G19"></div>
                        <div data-class="gold" class="seat  " data-seat-number="G20" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="G21"></div>
                        <div data-class="gold" class="seat  " data-seat-number="G22" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="G23"></div>
                        <div data-class="gold" class="seat  " data-seat-number="G24"></div>
                  </div>
                  <div class="row">
                  <P class="ltxt">H</P>
                  <div data-class="gold" class="seat  " data-seat-number="H1" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="H2"></div>
                        <div data-class="gold" class="seat  " data-seat-number="H3" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="H4"></div>
                        <div data-class="gold" class="seat  " data-seat-number="H5" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="H6"></div>
                        <div data-class="gold" class="seat  " data-seat-number="H7" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="H8"></div>
                        <div data-class="gold" class="seat  " data-seat-number="H9" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="H10"></div>
                        <div data-class="gold" class="seat  " data-seat-number="H11" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="H12"></div>
                        <div data-class="gold" class="seat  " data-seat-number="H13" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="H14"></div>
                        <div data-class="gold" class="seat  " data-seat-number="H15" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="H16"></div>
                        <div data-class="gold" class="seat  " data-seat-number="H17"></div>
                        <div data-class="gold" class="seat  " data-seat-number="H18" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="H19"></div>
                        <div data-class="gold" class="seat  " data-seat-number="H20" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="H21"></div>
                        <div data-class="gold" class="seat  " data-seat-number="H22" ></div>
                        <div data-class="gold" class="seat  " data-seat-number="H23"></div>
                        <div data-class="gold" class="seat  " data-seat-number="H24"></div>
                </div>
                <br>
                <p style="padding: 0;" >silver</p>
                
                <div class="row">
                <P class="ltxt">I</P>
                  <div data-class="silver"  class="seat"  data-seat-number="I1" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="I2"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="I3" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="I4"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="I5" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="I6"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="I7" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="I8"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="I9" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="I10"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="I11" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="I12"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="I13" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="I14"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="I15" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="I16"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="I17" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="I18"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="I19" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="I20"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="I21" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="I22"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="I23" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="I24"></div>
              </div>
              <div class="row">
              <P class="ltxt">J</P>
                  <div data-class="silver"  class="seat"  data-seat-number="J1" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="J2"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="J3" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="J4"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="J5" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="J6"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="J7" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="J8"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="J9" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="J10"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="J11" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="J12"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="J13" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="J14"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="J15" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="J16"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="J17" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="J18"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="J19" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="J20"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="J21" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="J22"></div>
                  <div data-class="silver"  class="seat"  data-seat-number="J23" ></div>
                  <div data-class="silver" class="seat  " data-seat-number="J24"></div>
            </div>
                  <p class="text">
                    You have selected <span id="count">0</span> seats 
                  </p>

                  <div class="selected-seats">
                    
                    <ul id="selected-seats-list"></ul>
                    <h2>Total Price: Rs. <span id="total-price">0</span></h2>
                    
                  </div>


                  <div class="form-group col-sm-12" >
                    <form action="POST">
                    <button type="submit" class="btn btn-outline-dark btn-block">BOOK</button>
                    </form>
                    

                    
                  </div>
                  
                  
        </div>
      </div>
      
      

      <script>
        
        const container = document.querySelector('.container');
          const seats = document.querySelectorAll('.row .seat:not(.occupied)');
          const count = document.getElementById('count');
          const total = document.getElementById('total');

          const selectedSeatNumbers = [];

          const selectedSeats = {};
          // Max number of seats allowed to be selected
          const maxSeats = 10;

          // Create an object to map seat classes to their respective prices.
          const seatPrices = {
              platinum: parseInt(<?php echo $mpsp; ?>, 10),
              gold: parseInt(<?php echo $mgsp; ?>, 10),
              silver: parseInt(<?php echo $mssp; ?>, 10),
          };

          // Initialize the selected seats object
          
          // Function to update total and count
          function updateSelectedCount() {
              const selectedSeatElements = document.querySelectorAll('.row .seat.selected');

              if (selectedSeatElements.length > maxSeats) {
                  alert(`You can select a maximum of ${maxSeats} seats.`);
                  // Unselect the last selected seat if the limit is exceeded
                  selectedSeatElements[selectedSeatElements.length - 1].classList.remove('selected');
                  const seatNumber = selectedSeatElements[selectedSeatElements.length - 1].getAttribute('data-seat-number');
                  selectedSeats[seatNumber] = false;
              }

              count.innerText = Object.values(selectedSeats).filter(Boolean).length;

              // Call the function to update the list of selected seats and total price
              updateSelectedSeatsList(selectedSeatElements);
          }

          // Function to update the list of selected seats and the total price
          function updateSelectedSeatsList(selectedSeatElements) {
              const selectedSeatsList = document.getElementById('selected-seats-list');
              const totalPriceElement = document.getElementById('total-price');
              selectedSeatsList.innerHTML = '';

              // Calculate the total price and update the list of selected seats
              let totalPrice = 0;
              selectedSeatElements.forEach((seatElement) => {
                  const seatClass = seatElement.getAttribute('data-class');
                  const seatNumber = seatElement.getAttribute('data-seat-number');
                  totalPrice += seatPrices[seatClass];

                  const listItem = document.createElement('li');
                  listItem.textContent = `Seat ${seatNumber} (${seatClass}) - Rs. ${seatPrices[seatClass]}`;
                  selectedSeatsList.appendChild(listItem);
              });

              totalPriceElement.textContent = totalPrice;
          }

          // This code updates the occupied seats
          const occupiedSeats = <?php echo json_encode($occupiedSeats); ?>;
          seats.forEach(seat => {
              const seatNumber = seat.getAttribute('data-seat-number');
              if (occupiedSeats.includes(seatNumber)) {
                  seat.classList.add('occupied');
              }
          });

          /// Seat click event
          container.addEventListener('click', (e) => {
              if (e.target.classList.contains('seat') && !e.target.classList.contains('occupied')) {
                  const seatNumber = e.target.getAttribute('data-seat-number');
                  const isSeatSelected = e.target.classList.contains('selected');

                  if (isSeatSelected) {
                      e.target.classList.remove('selected');
                      selectedSeats[seatNumber] = false;
                      const index = selectedSeatNumbers.indexOf(seatNumber);
                      if (index !== -1) {
                          selectedSeatNumbers.splice(index, 1);
                      }
                  } else if (selectedSeatNumbers.length < maxSeats) {
                      e.target.classList.add('selected');
                      selectedSeats[seatNumber] = true;
                      selectedSeatNumbers.push(seatNumber);
                  } else {
                      alert(`You can select a maximum of ${maxSeats} seats.`);
                  }

                  updateSelectedCount();
              }
          });

         // Get the form element
          const form = document.querySelector('form');

          // Add a form submission event listener
          form.addEventListener('submit', (e) => {
              e.preventDefault(); // Prevent the default form submission

              // Create a query string with the selected seat numbers
              const queryString = selectedSeatNumbers.map(seatNumber => `s${selectedSeatNumbers.indexOf(seatNumber) + 1}=${seatNumber}`).join('&');
              
              // Replace 'specificURL' with the URL you want to redirect to
              const specificURL = 'billing.php?mid=<?php echo $mid; ?>&bdate=<?php echo $bdate; ?>&btime=<?php echo $btime; ?>'; // Replace with your desired URL
              
              // Append the query string to the specific URL and redirect to that URL
              window.location.href = `${specificURL}&${queryString}`;
          });

          // Call the function to initialize the selected seats list
          updateSelectedCount();

          

    </script>
</body>
</html>