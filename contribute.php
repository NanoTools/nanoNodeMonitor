<?php

// include required files
require_once __DIR__.'/modules/includes.php';

session_start();

$_SESSION["addr"]=$nanoDonationAccount;
$_SESSION["amr"]=1000;

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
        Contribute by writing awesome code ....
      </p>

      <h2>Donate</h2>

      <?php
        $verifyUrl="http://138.197.179.164/bbVerify/paymentconfirmedUrl.php";

        $cancelUrl=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      ?>

      
      <p>
      Donate <input id="bbAmount" type="number" value="1"/> Nano
      </p>

      <a id ="bbPaymentUrl" href="https://brainblocks.io/checkout?payment.destination=<?php echo $_SESSION["addr"]; ?>&payment.currency=rai&urls.return=<?php echo $verifyUrl; ?>&urls.cancel=<?php echo $cancelUrl; ?>&payment.amount=" target="_blank"><img src="http://weclipart.com/gimg/FA3D4422FD5CF798/donate-button.png" width=100></a>

      <script>
      $(function() {
          $('#bbPaymentUrl').click( function() {
              window.open($(this).attr('href') + $('#bbAmount').val() * 1000000); // *1000000 --> "Nano" units
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
