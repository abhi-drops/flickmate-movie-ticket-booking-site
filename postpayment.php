<?php

if (isset($_GET['coin'])) {
  $coin = $_GET['coin'];
  
} else {
  
}

$rcoin = round($coin);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body style="background:#afafaf15;">

    <div class="container mt-5 p-0" style="
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);">
      <div class="card text-center">
        <div class="card-header">
         BOOKING STATUS
        </div>
        <div class="card-body">
          <h5 class="card-title">Payment successfull</h5>
          <h6 class="card-title">Order Confirmed</h6>
          <h6 class="card-title">₹<?php echo $rcoin ?> FLICKCOINS Added </h6>
            <a href="home.php" class="btn btn-outline-dark">Home</a>
        </div>
        <div class="card-footer text-muted">
          if you have faced any technical issues , contact us on our flickmateonsupport@flickmate.io
        </div>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>