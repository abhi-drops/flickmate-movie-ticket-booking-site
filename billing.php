<?php
    session_start();
    if (!isset($_SESSION['username']) || !isset($_SESSION['uID'])) {
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

    

    if (!isset($_GET['submit'])) {
      $midt = $_GET['mid'];
      $mid = substr($midt, 0, -4);
      $bdate = $_GET['bdate'];
      $btime = $_GET['btime'];

      //table name 
      $tname = $bdate . $btime ;
      $tname = preg_replace('/[^a-zA-Z0-9_]/', '_', $tname);


      // Accessing the selected seat numbers
      $seats = array(); // Create an array to store selected seat numbers
      
      // Loop through possible seat number keys (s1, s2, s3, ..., s10)
      for ($i = 1; $i <= 10; $i++) {
          $seatKey = 's' . $i;
          if (isset($_GET[$seatKey])) {
              $seats[$seatKey] = $_GET[$seatKey];
          }
      }
      
      // Calculate the number of selected seats
      $numSeats = count($seats);

      $seatsJSON = json_encode($seats);

      
      $sql = "SELECT * FROM movies WHERE mid='$mid'";

      $result = $connection->query($sql);;
      $row = $result->fetch_assoc();

      $mname = $row["mname"];
      $mssp = $row["mssp"];
      $mgsp = $row["mgsp"];
      $mpsp = $row["mpsp"];
      $uID = $_SESSION['uID'];
      
      $sql2 = "SELECT * FROM signin WHERE uID='$uID'";

      $result2 = $connection->query($sql2);;
      $row2 = $result2->fetch_assoc();

      

      
        $fpoints = $row2["fpoints"];
      
      
        
    
    }
    else
    {
     // Handle the case where these parameters are not set
    echo "";
    }
    
    //POST


    if (isset($_GET['submit'])) {
      
      $mid = $_GET['mid'];
      $bdate = $_GET['bdate'];
      $btime = $_GET['btime'];
      $tname = $_GET['tname'];
      
  
      // Access selected seats dynamically using a loop
      $seats = array();
      for ($i = 1; $i <= 10; $i++) {
          $seatKey = 's' . $i;
          if (isset($_GET[$seatKey])) {
              $seats[$seatKey] = $_GET[$seatKey];
          }
      }
      
      $numSeats = count($seats);

      $seatsJSON = json_encode($seats);

      
      $sql = "SELECT * FROM movies WHERE mid='$mid'";

      $result = $connection->query($sql);;
      $row = $result->fetch_assoc();

      $mname = $row["mname"];
      $mssp = $row["mssp"];
      $mgsp = $row["mgsp"];
      $mpsp = $row["mpsp"];
      $uID = $_SESSION['uID'];
      
      $sql2 = "SELECT * FROM signin WHERE uID='$uID'";

      $result2 = $connection->query($sql2);;
      $row2 = $result2->fetch_assoc();

      $fpoints = $row2["fpoints"];

      //FORM SUBMITTED

      
      $seatData = array();

      foreach ($seats as $seatKey => $value) {
          $sno = $value;

          if (substr($sno, 0, 1) == "A") {
              $stype = 'P';
          } elseif (isset($sno[0]) && $sno[0] >= 'B' && $sno[0] <= 'H') {
              $stype = 'G';
          } elseif (isset($sno[0]) && $sno[0] >= 'I' && $sno[0] <= 'J') {
              $stype = 'S';
          } else {
              $stype = 'Unknown';
          }

          $bookingData = array(
              'sno' => $sno,
              'stype' => $stype,
              'uID' => $uID,
          );

          $seatData[$seatKey] = $bookingData;
      }

      // Initialize a variable to keep track of success or failure

      $success = true;

      foreach ($seatData as $seatKey => $bookingData) {
          $sno = $bookingData['sno'];
          $stype = $bookingData['stype'];
          $uID = $bookingData['uID'];

          $insertQuery = "INSERT INTO $tname (sno, stype, uID) VALUES ('$sno', '$stype', '$uID')";

          // Execute the query
          if ($connection->query($insertQuery) !== TRUE) {
              // If an error occurred, set success to false
              $success = false;
              // You can also output the error message for debugging
              echo "Error: " . $connection->error;
          }
      }

      if ($success) {
          // All queries executed successfully
          
      } else {
          // There was an error in one or more queries
          echo "Booking failed. Please try again later.";
      }


      //PAYMENT
      
                $total = 0;

                foreach ($seats as $key => $value) {

                  if(substr($value, 0, 1) == "A"){
                    //$st = "P";
                    $pr = $mpsp;
                  }
                  elseif(isset($value[0]) && $value[0] >= 'B' && $value[0] <= 'H'){
                    //$st = 'G';
                    $pr = $mgsp;
                  }
                  elseif(isset($value[0]) && $value[0] >= 'I' && $value[0] <= 'J'){
                    //$st = 'S';
                    $pr = $mssp;
                  }

                  $total = $total + $pr ;
                }
                $total = $total - $fpoints;

      $seatFields = array();
      $seatkeyarr = array(); 
      for ($i = 1; $i <= 10; $i++) {
          $seatKey = 's' . $i;
          if (isset($seats[$seatKey])) {
              $seatFields[$seatKey] = $seats[$seatKey];
              $seatkeyarr[$i] = 's' . $i;
              
          }
      }
      
      // Build a comma-separated string of seat keys
  $seatKeys = implode(', ', array_keys($seatFields));

  // Build a comma-separated string of seat values and properly quote them
  $seatValues = "'" . implode("', '", $seatFields) . "'";

  // Insert payment data into the "payment" table
  $insertPaymentQuery = "INSERT INTO payment (ptprice, $seatKeys, uID, psdate, pstime,mid) VALUES ('$total', $seatValues, '$uID', '$bdate', '$btime','$mid')";

        if ($connection->query($insertPaymentQuery) === TRUE) {
            echo "";
        } else {
            echo "Booking and payment failed. Please try again later.";
            
            header("location:postpaymentfailure.php?coin=$newfcoin");

        }

        //flickcoin update
  $percent = 0.05; // 5% as a decimal
      

  
  echo $_SESSION['username'];
  
  if($_SESSION['username'] == 'adm'){
    $newfcoin = 0;  
    
    
    header("location:postpayment.php?coin=$newfcoin");

  }else{
    
    $uname = $_SESSION['username'];
    echo 'not admin';
        $newfcoin = $total * $percent;
        $sql = "UPDATE signin SET fpoints = $newfcoin WHERE name='$uname'";
      
      if ($connection->query($sql) === TRUE) {
          //Record updated successfully
          header("location:postpayment.php?coin=$newfcoin");
      } else {
          echo "Error updating record: " . $connection->error;
      }
  }
  

  }

  
  
?>

<!DOCTYPE html>
<html>
<head>
  <title>Payment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <style>
    .payment-form{
	padding-bottom: 50px;
	font-family: 'Montserrat', sans-serif;
}

.payment-form.dark{
	background-color: rgb(245, 247, 238);;
}

.payment-form .content{
	box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
	background-color: white;
}

.payment-form .block-heading{
    padding-top: 50px;
    margin-bottom: 40px;
    text-align: center;
}

.payment-form .block-heading p{
	text-align: center;
	max-width: 420px;
	margin: auto;
	opacity:0.7;
}

.payment-form.dark .block-heading p{
	opacity:0.8;
}

.payment-form .block-heading h1,
.payment-form .block-heading h2,
.payment-form .block-heading h3 {
	margin-bottom:1.2rem;
	color: #4b4b4b;
}

.payment-form form{
	border-top: 2px solid #2e2e2e;
	box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
	background-color:white;
	padding: 0;
	max-width: 600px;
	margin: auto;
}

.payment-form .title{
	font-size: 1em;
	border-bottom: 1px solid rgba(0,0,0,0.1);
	margin-bottom: 0.8em;
	font-weight: 600;
	padding-bottom: 8px;
}

.payment-form .products{
	background-color: #afafaf15;
    padding: 25px;
}

.payment-form .products .item{
	margin-bottom:1em;
}

.payment-form .products .item-name{
	font-weight:600;
	font-size: 0.9em;
}

.payment-form .products .item-description{
	font-size:0.8em;
	opacity:0.6;
}

.payment-form .products .item p{
	margin-bottom:0.2em;
}

.payment-form .products .price{
	float: right;
	font-weight: 600;
	font-size: 0.9em;
}

.payment-form .products .total{
	border-top: 1px solid rgba(70, 69, 69, 0.548);
	margin-top: 10px;
	padding-top: 19px;
	font-weight: 600;
	line-height: 1;
}

.payment-form .card-details{
	padding: 25px 25px 15px;
}

.payment-form .card-details label{
	font-size: 12px;
	font-weight: 600;
	margin-bottom: 15px;
	color: #0a0a0a;
	text-transform: uppercase;
}

.payment-form .card-details button{
	margin-top: 0.6em;
	padding:12px 0;
	font-weight: 600;
}

.payment-form .date-separator{
 	margin-left: 10px;
    margin-right: 10px;
    margin-top: 5px;
}

@media (min-width: 576px) {
	.payment-form .title {
		font-size: 1.2em; 
	}

	.payment-form .products {
		padding: 40px; 
  	}

	.payment-form .products .item-name {
		font-size: 1em; 
	}

	.payment-form .products .price {
    	font-size: 1em; 
	}

  	.payment-form .card-details {
    	padding: 40px 40px 30px; 
    }

  	.payment-form .card-details button {
    	margin-top: 2em; 
    } 
}
  </style>
</head>
<body>
  <main class="page payment-page">
    <section class="payment-form dark">
      <div class="container">
        <div class="block-heading">
          <h2>Almost There!</h2>
          <p><strong><?php echo $mname; ?></strong></p>
          <p><?php echo $bdate; ?> | <?php echo $btime; ?> </p>
          <p>flickmate cinemas </p>
          <p>kottayam</p>
        </div>
        <form>
          <div class="products">
            <h3 class="title">Checkout</h3>
            
            <?php

                $total = 0;

                foreach ($seats as $key => $value) {

                  if(substr($value, 0, 1) == "A"){
                    //$st = "P";
                    $pr = $mpsp;
                  }
                  elseif(isset($value[0]) && $value[0] >= 'B' && $value[0] <= 'H'){
                    //$st = 'G';
                    $pr = $mgsp;
                  }
                  elseif(isset($value[0]) && $value[0] >= 'I' && $value[0] <= 'J'){
                    //$st = 'S';
                    $pr = $mssp;
                  }

                  $total = $total + $pr ;

                    echo "<div class='item'>
                    <span class='price'>₹$pr</span>
                    <p class='item-name'>seat $value</p>
                  </div>";
                }

                $total = $total - $fpoints;

                echo "<div class='item'>
                <span class='price'>- ₹$fpoints</span>
                <p class='item-name'>discount</p>
                </div>
                
                
                <div class='total'>Total<span class='price'>₹$total</span></div>
                ";



            ?>

            

            
          </div>
          <div class="card-details">
            <?php
               $uname = $_SESSION['username'];

              if( $uname == 'adm')
              {
                
              }
              else{
                echo'
                
                <div>
                <h3 class="title">Credit Card Details</h3>
                <div class="row">
                  <div class="form-group col-sm-7">
                    <label for="card-holder">Card Holder</label>
                    <input required id="card-holder"  type="text" class="form-control" placeholder="Card Holder" aria-label="Card Holder" aria-describedby="basic-addon1">
                  </div>
                  <div class="form-group col-sm-5">
                    <label for="">Expiration Date</label>
                    <div class="input-group expiration-date">
                      <input required type="text"  class="form-control" placeholder="MM" aria-label="MM" aria-describedby="basic-addon1">
                      <span class="date-separator">/</span>
                      <input required type="text"  class="form-control" placeholder="YY" aria-label="YY" aria-describedby="basic-addon1">
                    </div>
                  </div>
                  
                    <div class="form-group col-sm-8">
                      <label for="card-number">Card Number</label>
                      <input required id="card-number"  type="text" class="form-control" placeholder="Card Number" aria-label="Card Holder" aria-describedby="basic-addon1">
                    </div>
                    <div class="form-group col-sm-4">
                      <label for="cvc">CVC</label>
                      <input required id="cvc" type="text"  class="form-control" placeholder="CVC" aria-label="Card Holder" aria-describedby="basic-addon1">
                    </div>
                </div>
                  
                ';
              }
              
            ?>
            
            

                <form action="" method="GET">
                  <input required type="hidden" name="mid" value="<?php echo $mid; ?>">
                  <input required type="hidden" name="bdate" value="<?php echo $bdate; ?>">
                  <input required type="hidden" name="btime" value="<?php echo $btime; ?>">
                  <input required type="hidden" name="tname" value="<?php echo $tname; ?>">

                  <?php
                  // Loop through the selected seats and create input fields for each one
                  foreach ($seats as $key => $value) {
                      echo "<input type='hidden' name='$key' value='$value'>";
                  }
                  ?>

                  <div class="form-group col-sm-12">
                      <button type="submit" class="btn btn-outline-dark btn-block" name="submit" value="submit">Proceed</button>
                  </div>
              </form>



              
            </div>
          </div>
        </form>
      </div>
    </section>
  </main>
</body>








<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
