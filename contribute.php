<?php

// include required files
require_once __DIR__.'/modules/includes.php';

session_start();

$_SESSION["nanoNodeMonDonationAccount"]=$nanoNodeMonDonationAccount;
$_SESSION["nanoDonationAccount"]=$nanoDonationAccount;

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


      <!-- donate to the maintainer -->      
      <p>
      Donate to the maintainer of this Nano node.
      </p>
      <a id ="bbPaymentUrlNode" href="https://brainblocks.io/checkout?payment.destination=<?php echo $_SESSION["nanoDonationAccount"]; ?>&payment.currency=rai&urls.return=<?php echo $verifyUrl; ?>&urls.cancel=<?php echo $cancelUrl; ?>&payment.amount=" target="_blank" class="donationButton">Donate</a>
      <input id="bbAmountNode" type="number" value="1"/> Nano

      <p/>

      <!-- donate to the maintainer -->      
      <p>
      Donate to the developers of <a href="https://github.com/dbachm123/nanoNodeMonitor" target="_blank">Nano Node Monitor</a>.
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
