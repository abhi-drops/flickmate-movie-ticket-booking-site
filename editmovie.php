<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "flickmate";

//server connection

$connection = new mysqli($servername,$username,$password,$database);

        $mid = "";
        $mname =  "";
        $mdes =  "";
        $mrating = "";
        $mtlink =  "";
        $mdir =  "";
        $mlang =  "";
        $msd =  "";
        $med = "";
        $mpos =  "";
        $mssp =  "";
        $mgsp =  "";
        $mpsp =  "";

        $successMessage ="";    
        $errorMessage = "";

        if ($_SERVER['REQUEST_METHOD'] == 'GET'){

            if (!isset($_GET["mid"])) {
                header("location: /flickmate/adminMovies.php");
                exit;
            }
        
            $mid = $_GET["mid"];
        
            $sql = "SELECT * FROM movies WHERE  mid=$mid";
            $result = $connection->query($sql);
            $row = $result->fetch_assoc();
        
            if(!$row){
                header("location: /flickmate/adminMovies.php");
                exit;
            }
  
            $mname =  $row["mname"];
            $mdes =   $row["mdes"];
            $mrating = $row["mrating"];
            $mtlink =  $row["mtlink"];
            $mdir =  $row["mdir"];
            $mlang =  $row["mlang"];
            $msd =  $row["msd"];
            $med = $row["med"];
            $mpos =  $row["mpos"];
            $mssp =  $row["mssp"];
            $mgsp =  $row["mgsp"];
            $mpsp =  $row["mpsp"];
        
        }else{

            $mid = $_POST["mid"];
            $mname =  $_POST["mname"];
            $mdes =    $_POST["mdes"];
            $mrating =  $_POST["mrating"];
            $mtlink =   $_POST["mtlink"];
            $mdir =   $_POST["mdir"];
            $mlang =   $_POST["mlang"];
            $msd =   $_POST["msd"];
            $med =  $_POST["med"];
            $mpos =   $_POST["mpos"];
            $mssp =   $_POST["mssp"];
            $mgsp =   $_POST["mgsp"];
            $mpsp =   $_POST["mpsp"];
        
            do{
        
                if (false){
                    $errorMessage = "All the fields are required";
                    break;
                }
                
                $sql = "UPDATE movies" . 
                       " SET `mid`='$mid',`mname`='$mname',`mdes`='$mdes',`mrating`='$mrating',`mtlink`='$mtlink',`mdir`='$mdir',`mlang`='$mlang',`msd`='$msd',`med`='$med',`mpos`='$mpos',`mssp`='$mssp',`mgsp`='$mgsp',`mpsp`='$mpsp' " .
                       "WHERE mid = $mid ";
        
                $result = $connection->query($sql);
        
                if(!$result){
                    $errorMessage = "Invalid query:" . $connection->error;
                    break;
                }
        
                $successMessage = "client updated correctly";
        
                    header("location: /flickmate/adminMovies.php");
                    exit;
        
        
            } while(false);
        
        }
        
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
</head>
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

.thum{
  border-radius: 8px;
  object-fit: cover;
}
  </style>
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
                  <a class="nav-link " aria-current="page" href="./admin.php">Home</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link active" href="./adminMovies.php">Shedule Movies</a>
                  </li>
              </ul>

              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                      <div class="btn-nav"><a class="btn  btn-small navbar-btn btn-outline-dark" style="color:black" href="logout.php">Sign Out</a>
                      </div>
                  </li>
              </ul>  
          </div>
      </div>
      
  </nav>

  <div class="addMovie card m-5 p-3">
    
    <div class="container mt-3 col-12 col-lg-7">
      <h2 class="py-4">Edit Movie</h2>
      <form  method="POST">
        <input type="hidden" value="<?php echo $mid ?> " name="mid">
        <div class="mb-3 mt-3">
          <label for="mname">Title:</label>
          <input type="text" class="form-control" id="mname" placeholder="MOVIE TITLE" name="mname" required value="<?php echo $mname ?>" >
        </div>
        
        <div class="mb-3 mt-3">
          <label for="mdes">Description:</label>
          <textarea class="form-control"  rows="3" id="mdes" name="mdes" required ><?php echo $mdes ?></textarea>
        </div>
        
        <div class="mb-3 mt-3">
          <label for="mrating">Rating:</label>
          <input type="number" class="form-control" id="mrating"  placeholder="10.00" name="mrating" value="<?php echo $mrating ?>" >
        </div>

        <div class="mb-3 mt-3">
          <label for="mtLink">Trailer Link:</label>
          <input type="text" class="form-control" id="mtlink" placeholder="https://www.youtube.com/" name="mtlink" required value="<?php echo $mtlink ?>">
        </div>
        
        <div class="mb-3 mt-3">
          <label for="mdir">Director:</label>
          <input type="text" class="form-control" id="mdir" placeholder="DIRECTOR'S NAME" name="mdir" required value="<?php echo $mdir ?>">
        </div>
        
        <div class="mb-3 mt-3">
          <label for="mlang">Language:</label>
          <input type="text" class="form-control" id="mlang" placeholder="ENGLISH" name="mlang" required value="<?php echo $mlang ?>">
        </div>
        
        <div class="mb-3 mt-3">
          <label for="msd">Start Date:</label>
          <input type="date" class="form-control"   name="msd" required value="<?php echo $msd ?>">
          </div>  

          <div class="mb-3 mt-3">
          <label for="med">End Date:</label>
          <input type="date" class="form-control"   name="med" required value="<?php echo $med ?>">
          </div>  

          <div class="mb-3">
            <label for="mpos" class="form-label">Poster</label>
            <input class="form-control" type="text"  name="mpos" required value="<?php echo $mpos ?>">
        </div>
          
        <div class="mb-3 mt-3">
          <label for="mssp">Silver Seat Price:</label>
          <input type="number" class="form-control"  name="mssp" required value="<?php echo $mssp ?>">
        </div>
         
        <div class="mb-3 mt-3">
          <label for="mgsp">Gold Seat Price:</label>
          <input type="number" class="form-control"  name="mgsp" required value="<?php echo $mgsp ?>">
        </div>

        <div class="mb-3 mt-3">
          <label for="mpsp">Platinum Seat Price:</label>
          <input type="number" class="form-control"  name="mpsp" required value="<?php echo $mpsp ?>">
        </div>

        <button type="submit" class="btn btn-dark my-5 float-end" name="submit" style="color: black;">Submit</button>
        <a href="/flickmate/adminMovies.php" type="button" class="btn btn-dark my-5 float-end mx-3" role="button" style="color: black;">cancel</a>
      </form>
        </div>  
        </div>
    </div>

  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>