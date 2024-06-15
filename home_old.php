
<?php

session_start();
if(!isset($_SESSION['username']))
{
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
<style>
  #myVideo {
      object-fit: cover;
      width: 100vw;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
    }

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
    body {
     
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
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
.thum:hover{
     transform: scale(1.05);
     box-shadow: 0 15px 10px -10px rgba(31, 31, 31, 0.5);
  transition: all 0.3s ease;
}

a{
    text-decoration: none;
}
a:link, a:visited, a:hover, a:active{
    text-decoration: none;
}
.addMovie{
    overflow: auto;
    white-space: nowrap;
    overflow-y: hidden;
}
/* width */
::-webkit-scrollbar {
  width: 0px;
  height: 7px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 5px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: white; 
  border-radius: 5px;
  padding: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: grey; 
}

  </style>
</head>
<body>
<video autoplay muted loop id="myVideo">
  <source src="videos/v (18).mp4" type="video/mp4">
  Your browser does not support HTML5 video.
</video>

<div class="container-fluid">
      <nav  class="navbar navbar-expand-lg " >
        
        <div class="container-fluid" >
              <a class="navbar-brand " style="font-family: 'Warlow Sans', sans-serif;" href="#">flickmate.com</a>
              <div class="d-flex justify-content-start">
              <div class="mx-2 mt-2">
                <p><a href="#" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover mx-3"><?php echo $_SESSION['username']; ?></a></p>
                </div>
              <div class="btn-nav ">
                    <a class="btn  btn-small navbar-btn btn-outline-dark" style="color:black" href="logout.php" >Sign Out</a>
                </div>
                
                
              </div>
               
          </div> 
      </nav>
    <div>
        <div id="carouselExampleIndicators" class="carousel slide card" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner m-2 " style=" border-radius:16px; width:98.5%;"> 
                <div class="carousel-item " >
                <img  src="images/P1.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item active">
                <img src="images/P4.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="images/P3.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;" class=" addMovie card m-2 p-2 ">
        <div class="d-flex justify-content-start">
            <div>
                <div>
                    <h5 class="py-1 px-2">NOW SHOWING</h5>
                </div>
                    <a href="">
                        <img class="thum m-1" src="images/salar.jpg" height= "297 px" width="210 px" >
                        <p style="text-align: center;">SALAR</p>
                    </a>
                   
            </div>
            <div>
                 <h5 class="py-1 px-2">UPCOMMING</h5>
                
                <div class="d-flex justify-content-start ">
                    <div class="" >
                        <a href="">
                            <img class="thum m-1" src="https://m.media-amazon.com/images/M/MV5BZTg1ODA2YWQtODI4Ni00MDM5LTkzOWEtZGQzNjNmNjE0NGZhXkEyXkFqcGdeQXVyMTYyNDIyMTMz._V1_FMjpg_UX1095_.jpg" height= "297 px" width="210 px" >
                            <p style="text-align: center;">LEO</p>
                        </a>
                        
                        
                    </div>
                    <div>
                        <a href="">
                            <img class="thum m-1" src="https://m.media-amazon.com/images/M/MV5BMGMxYjczNjktMTZlYi00NWU0LWFmNGEtYTBhMDJkNmJmZjhlXkEyXkFqcGdeQXVyMjkxNzQ1NDI@._V1_FMjpg_UY1794_.jpg" height= "297 px" width="210 px" >
                            <p style="text-align: center;">MALAIKOTTAI VAALIBAN</p>
                        </a>
                       
                        
                    </div>

                    <div>
                        <a href="https://www.imdb.com/title/tt27431598/?ref_=nv_sr_srsg_0_tt_2_nm_1_q_BRAMAYUGAM">
                            <img class="thum m-1" src="https://m.media-amazon.com/images/M/MV5BZjQzZmM5OWEtNDdlZC00N2FiLWI3NzUtM2U3NzRhMDg0MzBlXkEyXkFqcGdeQXVyOTg5NzM3Nzk@._V1_FMjpg_UX768_.jpg" height= "297 px" width="210 px" >
                            <p style="text-align: center;">BRAMAYUGAM</p>
                        </a>
                    </div>

                    <div>
                        <a href="https://www.imdb.com/title/tt12735488/">
                            <img class="thum m-1" src="https://m.media-amazon.com/images/M/MV5BNzRlNTZmNDctZjJlZi00Mzc1LWIwMjItNzFjMWJlMWIzOTdiXkEyXkFqcGdeQXVyNjY1MTg4Mzc@._V1_FMjpg_UX1080_.jpg" height= "297 px" width="210 px" >
                            <p style="text-align: center;">KALKI 2898-AD</p>
                        </a>
                    </div>

                    <div>
                        <a href="https://www.imdb.com/title/tt27431598/?ref_=nv_sr_srsg_0_tt_2_nm_1_q_BRAMAYUGAM">
                            <img class="thum m-1" src="https://filmfare.wwmindia.com/content/2023/aug/dunki11692788545.jpg" height= "297 px" width="210 px" >
                            <p style="text-align: center;">DUNKI</p>
                        </a>
                    </div>

                    <div>
                        <a href="https://www.imdb.com/title/tt27431598/?ref_=nv_sr_srsg_0_tt_2_nm_1_q_BRAMAYUGAM">
                            <img class="thum m-1" src="https://m.media-amazon.com/images/M/MV5BODI0YjNhNjUtYjM0My00MTUwLWFlYTMtMWI2NGUzYjNjNGQzXkEyXkFqcGdeQXVyMDM2NDM2MQ@@._V1_FMjpg_UY4096_.jpg" height= "297 px" width="210 px" >
                            <p style="text-align: center;">DUNE: PART 2</p>
                        </a>
                    </div>

                    <div>
                        <a href="https://www.imdb.com/title/tt27431598/?ref_=nv_sr_srsg_0_tt_2_nm_1_q_BRAMAYUGAM">
                            <img class="thum m-1" src="https://m.media-amazon.com/images/M/MV5BMzA2ZTgxNzgtYjM3Ni00NTI1LWJiMjAtMWViNWUzNzIwYTgwXkEyXkFqcGdeQXVyMTMxODA4Njgx._V1_FMjpg_UY2048_.jpg" height= "297 px" width="210 px" >
                            <p style="text-align: center;">JIGARTHANDA DOUBLEX</p>
                        </a>
                    </div>

                </div>
                  
            </div>
            
        </div>
       

    </div>

    
     
    

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>