<?php

session_start();
if(!isset($_SESSION['username']))
{
    header('location:login.php');
}

$servername = "localhost";
 $username = "root";
 $password = "";
 $database = "flickmate";
                     
$tdate = date("Y-m-d");

$connection = new mysqli($servername,$username,$password,$database);
if($connection->connect_error)
{
     die("connection failed: " . $connection->connect_error);

}

$mid ="";

if ($_SERVER['REQUEST_METHOD'] == 'GET'){

  
  $bdate=$_GET['bdate'];
  $btime=$_GET['btime'];

  $tname = $bdate . $btime ;

  $tname = preg_replace('/[^a-zA-Z0-9_]/', '_', $tname);

 
  
    // Initialize variables
    $bookedSeats = 0;
    $totalCollection = 0;
    $bookedSeatPer = 0;
    $bookedSeatsCount = 0;

    // Perform the query
    $sql = "SELECT * FROM payment WHERE psdate = '$bdate' AND pstime = '$btime'";
    $result = $connection->query($sql);


    while ($row = mysqli_fetch_assoc($result)) {
      // Check each seat (s1 to s10) for not null
      for ($i = 1; $i <= 10; $i++) {
          $seatColumnName = "s" . $i;
          if ($row[$seatColumnName] !== null) {
              $bookedSeatsCount++;
              $bookedSeats++;
              
          }
      }
      $totalCollection += $row['ptprice'];
  }

  $bookedSeatPer = round(($bookedSeats/240)*100,2);

  $sid = "";
  $sno = "";
  $stype = "";
  $uID = "";


}


?>
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
<style>
    body {
      background-image: url('images/login3.png');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      font-family: 'Poppins', sans-serif;
    }
    .card {
      background: rgba(255, 255, 255, 0.2);
      border-radius: 16px;
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(5px);
      -webkit-backdrop-filter: blur(5px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      color: black;
      
      
    }
    .card:before {
      content: "";
      position: absolute;
      top: -10px;
      left: -10px;
      right: -10px;
      bottom: -10px;
      background: rgba(255, 255, 255, 0.1);
      z-index: -1;
      filter: blur(20px);
      
    }
    .btn {
 
      color: white;
      font-size: 16px;
      
      text-align: center;
      text-decoration: none;
      display: inline-block;
      transition: background-color 0.3s ease;
      cursor: pointer;

      background: rgba(255, 255, 255, 0);
      border-radius: 5px;
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(5px);
      -webkit-backdrop-filter: blur(5px);
      border: 1px solid rgba(255, 255, 255, 0.3);
}

.btn:hover {
 background-color: rgba(255, 255, 255, 0.3);
}


  </style>
</head>
<body>
<div class="container-fluid">
      <nav  class="navbar navbar-expand-lg " >
        
        <div class="container-fluid" >
              <a class="navbar-brand " href="#">Admin Panel</a>
              
              <button class="navbar-toggler justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse " id="navbarNav">

                  <ul class="navbar-nav">
                      <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="./admin.php">Home</a>
                      </li>
                      <li class="nav-item">
                      <a class="nav-link " href="./adminMovies.php">Shedule Movies</a>
                      </li>
                  </ul>

                  <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                          <div class="btn-nav"><a class="btn  btn-small navbar-btn btn-outline-dark" style="color:black"  href="logout.php" >Sign Out</a>
                          </div>
                      </li>
                  </ul>  
              </div>
          </div>
          
      </nav>


    <div class="addMovie card m-5 p-3">
      
        
    <div class="container mt-3 col-12 col-lg-12">
      <h2 class="py-4">Booking Details</h2>
          <div class="card m-3 p-3 ">
            
            <div>
                <div class="row row-cols-1">
                  <h1></h1>
                    <h1 class="col"><?php echo $bookedSeatPer; ?> % Booked</h1>
                    <h6 class="col">(<?php echo $bookedSeats; ?> seats)</h6>
                    <br>
                    <br>
                    <h6 class="col d-flex justify-content-end p-1"><?php echo $bdate; ?> || <?php echo $btime; ?></h6>
                </div>
            
            </div>
              
          </div>
          
          <div class="card m-3 p-3">
            
            <div>
                <div class="row row-cols-2">
                    <h1 class="col">Total Revenue :</h1>
                    <h1 class="col d-flex justify-content-end">₹<?php echo $totalCollection; ?></h1>
                </div>
            
            </div>
              
          </div>



          <div class='card col m-3 p-3'>

                <div class='row row-cols-3'>
                    <h6 class='col'><strong>Seat.no</strong></h6>
                    
                    <h6 class='col'><strong>Seat Type</strong></h6>
                    <h6 class='col'><strong>User</strong></h6>
                </div>

                <?php

                  if (!$bookedSeats == 0)
                  {
                    $sql = "SELECT * FROM $tname";
                    $result = $connection->query($sql);

                    if (!$result){
                      die("invalid query: ".$connection->error);
                  }

                  while($row = $result->fetch_assoc()){

                    $sid = $row['sid'];
                    $sno = $row['sno'];
                    $stype = $row['stype'];
                    $uID = $row['uID'];

                    $sql2 = "SELECT * FROM signin WHERE uID='$uID'";
                    $result2 = $connection->query($sql2);
                    $row2 = $result2->fetch_assoc();

                    $name = $row2['name'];




                    echo "

                        <div class='row row-cols-3'>
                          <h6 class='col'>$sno</h6>
                          
                          <h6 class='col'>$stype</h6>
                          <h6 class='col'>$name</h6>
                        </div>
                    ";

                  }
                  }
                     
                ?>


          </div>

          



          

    </div>

    </div>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>