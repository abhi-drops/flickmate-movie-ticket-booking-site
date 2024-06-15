<?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "flickmate";

            $connection = new mysqli($servername,$username,$password,$database);

            if($connection->connect_error)
            {
                die("connection failed: " . $connection->connect_error);

            }

            // Query to get the maximum 'msd' value from the 'movies' table
            $sql = "SELECT MAX(med) AS max_med FROM movies";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                // Fetch the result
                $row = $result->fetch_assoc();

                // Get the maximum 'msd' value
                $maxMed = $row['max_med'];

                // Add one day to the maximum 'msd' value
                $newMed = date('Y-m-d', strtotime($maxMed . ' + 1 day'));
                $newMedpluse = date('Y-m-d', strtotime($newMed . ' + 1 day'));
                // Display the results
                //echo "Maximum 'med' value: $maxMed<br>";
                //echo "New 'med' value (max + 1 day): $newMed<br>";
            } else {
                //echo "No records found in the 'movies' table.";
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

.thum{
  border-radius: 8px;
  object-fit: cover;
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
      <h2 class="py-4">Add Movie</h2>
      <form action="connect.php" method="POST">
        <div class="mb-3 mt-3">
          <label for="title">Title:</label>
          <input type="text" class="form-control"  placeholder="MOVIE TITLE" name="mname" required>
        </div>
        
        <div class="mb-3 mt-3">
          <label for="des">Description:</label>
          <textarea class="form-control"  rows="3" name="mdes" required></textarea>
        </div>
        
        <div class="mb-3 mt-3">
          <label for="rating">Rating:</label>
          <input type="number" class="form-control"  placeholder="10.00" name="mrating">
        </div>

        <div class="mb-3 mt-3">
          <label for="tLink">Trailer Link:</label>
          <input type="text" class="form-control"  placeholder="https://www.youtube.com/" name="mtlink" required>
        </div>
        
        <div class="mb-3 mt-3">
          <label for="dir">Director:</label>
          <input type="text" class="form-control"  placeholder="DIRECTOR'S NAME" name="mdir" required>
        </div>
        
        <div class="mb-3 mt-3">
          <label for="lan">Language:</label>
          <input type="text" class="form-control"  placeholder="ENGLISH" name="mlang" required>
        </div>
        
        <div class="mb-3 mt-3">
          <label for="lan">Start Date:</label>
          <input type="date" class="form-control"  min="<?php echo $newMed ; ?>" name="msd" required>
          </div>  

          <div class="mb-3 mt-3">
          <label for="lan">End Date:</label>
          <input type="date" class="form-control"  min="<?php echo $newMedpluse ;?>"  name="med" required>
          </div>  

          <div class="mb-3">
            <label for="poster" class="form-label">Poster</label>
            <input class="form-control" type="text"  name="mpos" required>
        </div>
          
        <div class="mb-3 mt-3">
          <label for="lan">Silver Seat Price:</label>
          <input type="number" class="form-control"  name="mssp" required>
        </div>
         
        <div class="mb-3 mt-3">
          <label for="lan">Gold Seat Price:</label>
          <input type="number" class="form-control"  name="mgsp" required>
        </div>

        <div class="mb-3 mt-3">
          <label for="lan">Platinum Seat Price:</label>
          <input type="number" class="form-control"  name="mpsp" required>
        </div>

        <button type="submit" class="btn btn-dark my-5 float-end" name="submit" style="color: black;">Submit</button>
      </form>
        </div>  
        </div>
    </div>

  </div>

  <div class="addMovie card m-5 p-2">
    
    <div class="container mt-3 col-12 col-lg-10">
      <h2 class="py-4">Movies</h2>
      
      <?php

            

            $sql = "SELECT * FROM movies";
            $result = $connection->query($sql);

            if (!$result){
                die("invalid query: ".$connection->error);
            }

            while($row = $result->fetch_assoc()){

                echo "
                
                <div class='card mb-5' >
                <div class='row g-0'>
                  <div class='col-md-4 '>
                    <img src='$row[mpos]' width= '300px' style='object-fit: cover;'>
                  </div>
                  <div class='col-md-8'>
                    <div class='card-body row '>
                      <h5 class='card-title col-md-12'>$row[mname]</h5>
                      <p class='card-text col-md-12'>$row[mdes]</p>
                      <p class='card-text col-md-6'><small class='text-muted'>Rating : $row[mrating] /10</small></p>
                      <p class='card-text col-md-6'><small class='text-muted'>director : $row[mdir] </small></p>
                      <p class='card-text col-md-6'><small class='text-muted'>Lan : $row[mlang] </small></p>
                      <p class='card-text col-md-6'><small class='text-muted'>From : $row[msd] </small></p>
                      <p class='card-text col-md-6'><small class='text-muted'>To :$row[med]</small></p>
                      <p class='card-text col-md-6'><small class='text-muted'>Silver : $row[mssp]</small></p>
                      <p class='card-text col-md-6'><small class='text-muted'>Gold : $row[mgsp]</small></p>
                      <p class='card-text col-md-6'><small class='text-muted'>Platinum : $row[mpsp]</small></p>
                   </div>
                    
                </div>
                          <iframe src='$row[mtlink]' width='100%' height='300px'></iframe> 
                </div>
                
        
                <div class='card'>
                    <div class=' card-body d-grid gap-2 d-md-flex justify-content-end'>
                    <a type='button' href='/flickmate/selecttime.php?mid=$row[mid].php' class='btn btn-dark col-md-3 mx-3 col-12' name='edit' style='color: black;'>BookNow</a>
                          <a type='button' href='/flickmate/editmovie.php?mid=$row[mid]' class='btn btn-dark col-md-3 mx-3 col-12' name='edit' style='color: black;'>Edit</a>
                          <a type='button' href='/flickmate/deletemovie.php?mid=$row[mid]' class='btn btn-dark col-md-3 mx-3 col-12'name='delete' style='color: black;'>Delete</a>
                    </div>
                </div>
                
              </div>
                
                ";

            }
      ?>
      
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
