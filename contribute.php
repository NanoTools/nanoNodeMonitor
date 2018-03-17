<?php

// include required files
require_once __DIR__.'/modules/includes.php';

session_start();

$_SESSION["nanoNodeMonDonationAccount"]=NODEMON_DON_ACCOUNT;
$_SESSION["nanoDonationAccount"]=$nanoDonationAccount;
$_SESSION["verifyUrl"]=BB_VERIFY_URL;

?>

<!DOCTYPE html>
<html lang="en">

<script src="static/js/jquery-3.3.1.min.js"></script>

  <head>
    <meta charset="utf-8">

    <title>Nano Node Monitor - <?php echo $nanoNodeName; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="robots" content="noindex" />
    <link rel="stylesheet" href="static/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="static/css/custom.css" media="screen">
  </head>
  <body>

    <!--- add the navbar -->
    <?php include 'modules/navbar.php'; ?>
   
    
    <!--- logo  -->
    <div class="container">

      <div class="page-header mb-3" id="banner">
        <div class="row">
          <div class="col-lg-8 col-md-7 col-sm-6">
            <a href="https://nano.org" target="_blank">
              <img src="static/img/logo-white.svg" width="220" alt="Nano Logo"/>
            </a>
            <p class="lead">Nano Node Monitor</p>
          </div>          
        </div>
      </div>

      <div id="content"></div>

      <h2>Contribute</h2>
      <p>
        If you want to contribute to Nano Node Monitor and further improve it, your help is very welcome. Have a look at its <a href="https://github.com/dbachm123/nanoNodeMonitor" target="_blank">GitHub page</a>, browse through open issues, check out the source code, create a branch, develop features, fix some bugs, and open pull requests. Development follows the standard <a href="https://guides.github.com/introduction/flow/" target="_blank">GitHub Flow</a> method.  
      </p>

      <h2>Donate</h2>

      <?php
        $verifyUrl=$_SESSION["verifyUrl"];
        $cancelUrl=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      ?>

      Donations support the efforts of the Nano community to further decentralize the Nano network by running representative nodes. 


      <!-- donate to the maintainer -->      
      <p>
      Donate to the maintainer of this Nano node to help cover some of its costs. 
      </p>
      <a id ="bbPaymentUrlNode" href="https://brainblocks.io/checkout?payment.destination=<?php echo $_SESSION["nanoDonationAccount"]; ?>&payment.currency=rai&urls.return=<?php echo $verifyUrl; ?>&urls.cancel=<?php echo $cancelUrl; ?>&payment.amount=" target="_blank" class="donationButton">Donate</a>
      <input id="bbAmountNode" type="number" value="1"/> Nano

      <p>&nbsp;</p>


      <!-- donate to the maintainer -->      
      <p>
      Donate to the developers of <a href="https://github.com/dbachm123/nanoNodeMonitor" target="_blank">Nano Node Monitor</a> to support further development.
      </p>
      <a id ="bbPaymentUrlDev" href="https://brainblocks.io/checkout?payment.destination=<?php echo $_SESSION["nanoNodeMonDonationAccount"]; ?>&payment.currency=rai&urls.return=<?php echo $verifyUrl; ?>&urls.cancel=<?php echo $cancelUrl; ?>&payment.amount=" target="_blank" class="donationButton">Donate</a>
      <input id="bbAmountDev" type="number" value="1"/> Nano 

      <script>
      $(function() {
          $('#bbPaymentUrlNode').click( function() {
              window.open($(this).attr('href') + $('#bbAmountNode').val() * 1000000); // *1000000 --> "Nano" units
              return false;
          });
      });

      $(function() {
          $('#bbPaymentUrlDev').click( function() {
              window.open($(this).attr('href') + $('#bbAmountDev').val() * 1000000); // *1000000 --> "Nano" units
              return false;
          });
      });

      </script>


      </p>

     <!--- add the footer -->
     <?php include 'modules/footer.php'; ?>

    </div>

    <script src="static/js/bootstrap.min.js"></script>
    <script src="static/js/handlebars-v4.0.11.js"></script>
    <script src="https://files.coinmarketcap.com/static/widget/currency.js"></script>
    <script src="static/js/index.js"></script>
  </body>
</html>
