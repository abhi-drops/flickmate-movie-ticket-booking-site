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

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  
  $bdate=$_POST['bdate'];
  $btime=$_POST['btime'];
  

  do{

          header("location:/flickmate/adminreport.php?bdate=$bdate&btime=$btime");
          exit;


  } while(false);

  

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
          <div class="card m-3 p-3">
            
            <div>
                <h1 class="d-flex justify-content-center m-5">Select Date and Time</h1>
                
                    <div class="d-flex justify-content-center mx-5 mt-5 ">
                      <form action="" method="POST">
                          <div class="m-5">
                                <label for="date"  class="form-label d-flex justify-content-center">Date</label>
                                <input type="date" name="bdate" class="form-control" id="date" required>
                            </div>
    
                            <div class="m-5">
                                <label for="time" class="form-label d-flex justify-content-center">Time</label>
                                <select class="form-select" name="btime" id="time" required>
                                <option value="">Select a time</option>
                                <option value="10AM">10 AM</option>
                                <option value="2PM">2 PM</option>
                                <option value="6PM">6 PM</option>
                                <option value="10PM">10 PM</option>
                                </select>
                            </div>
    
                        </div>
                        <div class="d-flex justify-content-center m-5">
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button class="btn btn-outline-dark" style='color: black;' type="submit">Submit</button>
                                
                            </div>
                        </div>
                          
                            
                        <br>
                        <br>
                        </form>
            </div>
              
          </div>

        
        </div>
    </div>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>