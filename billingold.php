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

    

    if (isset($_GET['mid']) && isset($_GET['bdate']) && isset($_GET['btime'])) {
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

      // Now, you have the selected seat numbers in the $seats array.
      // The number of selected seats is in the $numSeats variable.
      
      
     
      //foreach ($seats as $key => $value) {
      //    echo "Seat $key: $value<br>";
      //}
      
      
      
    
    }
    else
    {
     // Handle the case where these parameters are not set
    echo "Some parameters are missing from the URL.";
    }

    
    
     

      
     if (isset($_GET['rt'])) {
      $mid = $_GET['mid'];
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

      // Now, you have the selected seat numbers in the $seats array.
      // The number of selected seats is in the $numSeats variable.
      
      
     
      //foreach ($seats as $key => $value) {
      //    echo "Seat $key: $value<br>";
      //}
      
      
      
    
    }
    else
    {
     // Handle the case where these parameters are not set
    echo "Some parameters are missing from the URL.";
    }

    
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
    


    function submitform()
    {
      

      //
      echo "Form submitted"; 
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
          echo "Booking was successful!";
      } else {
          // There was an error in one or more queries
          echo "Booking failed. Please try again later.";
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
            <h3 class="title">Credit Card Details</h3>
            <div class="row">
              <div class="form-group col-sm-7">
                <label for="card-holder">Card Holder</label>
                <input id="card-holder"  type="text" class="form-control" placeholder="Card Holder" aria-label="Card Holder" aria-describedby="basic-addon1">
              </div>
              <div class="form-group col-sm-5">
                <label for="">Expiration Date</label>
                <div class="input-group expiration-date">
                  <input type="text"  class="form-control" placeholder="MM" aria-label="MM" aria-describedby="basic-addon1">
                  <span class="date-separator">/</span>
                  <input type="text"  class="form-control" placeholder="YY" aria-label="YY" aria-describedby="basic-addon1">
                </div>
              </div>
              
                <div class="form-group col-sm-8">
                  <label for="card-number">Card Number</label>
                  <input id="card-number"  type="text" class="form-control" placeholder="Card Number" aria-label="Card Holder" aria-describedby="basic-addon1">
                </div>
                <div class="form-group col-sm-4">
                  <label for="cvc">CVC</label>
                  <input id="cvc" type="text"  class="form-control" placeholder="CVC" aria-label="Card Holder" aria-describedby="basic-addon1">
                </div>
                <form action="" method="POST" >
                  <!--
                  <input type="hidden" name="mid" value="<?php echo $mid; ?>">
                  <input type="hidden" name="bdate" value="<?php echo $bdate; ?>">
                  <input type="hidden" name="btime" value="<?php echo $btime; ?>">
                  <input type="hidden" name="tname" value="<?php echo $tname; ?>">
              -->
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

<script>
  // Parse the JSON string into an array
  const selectedSeatNumbers = <?php echo $seatsJSON; ?>;

  // Function to update the selected seat count and array
  function updateSelectedCount() {
    // Your logic to update the selectedSeatNumbers array here
  }

  // Get the form element
  const form = document.querySelector('form');

  // Add a form submission event listener
  form.addEventListener('submit', (e) => {
    e.preventDefault(); // Prevent the default form submission

    // Create a query string with the selected seat numbers
    const queryString = Object.keys(selectedSeatNumbers).map(key => `${key}=${selectedSeatNumbers[key]}`).join('&');

    // Replace 'specificURL' with the URL you want to redirect to (billing.php)
    const specificURL = 'billing.php?mid=<?php echo $mid; ?>&bdate=<?php echo $bdate; ?>&btime=<?php echo $btime; ?>&rt=1'; // Replace with your desired URL

    // Append the query string to the specific URL and redirect to that URL
    window.location.href = `${specificURL}&${queryString}`;

    
  });

  // Call the function to initialize the selected seats list
  updateSelectedCount();
</script>






<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>