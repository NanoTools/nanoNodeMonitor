<?php

// include required files
require_once __DIR__.'/modules/includes.php';

// check for curl package
if (!phpCurlAvailable()) {
    myError('Curl not available. Please install the php-curl package!');
}

?>

<!DOCTYPE html>
<html lang="en">
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
    <script>var GLOBAL_REFRESH = <?php echo $autoRefreshInSeconds; ?></script>


    <!--- add the navbar -->
    <?php include 'modules/navbar.php'; ?>

    <!-- logo and ticker -->
    <div class="container">

      <div class="page-header mb-3" id="banner">
        <div class="row">
          <div class="col-lg-8 col-md-6 col-sm-6">
            <a href="https://nano.org" target="_blank">
              <img src="static/img/logo-white.svg" width="220" alt="Nano Logo"/>
            </a>
           <p></p>
            <p class="lead">Nano Node Monitor</p>

            <p><?php echo getVersionInformation(); ?><br>
            Contributors: <a href="https://github.com/dbachm123">dbachm123</a>, <a href="https://github.com/BitDesert">BitDesert</a>, <a href="https://github.com/NiFNi">NiFNi</a></p>
    
            <p><?php echo $welcomeMsg; ?></p>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="coinmarketcap-currency-widget" 
            data-currencyid="1567" 
            data-base="<?php echo $cmcBaseCurrency; ?>" 
            data-secondary="<?php echo $cmcSecondaryCurrency; ?>" 
            data-ticker="<?php echo bool2string($cmcTicker); ?>" 
            data-rank="<?php echo bool2string($cmcRank); ?>" 
            data-marketcap="<?php echo bool2string($cmcMarketcap); ?>" 
            data-volume="<?php echo bool2string($cmcVolume); ?>" 
            data-stats="<?php echo $cmcBaseCurrency; ?>" 
            data-statsticker="<?php echo bool2string($cmcStatsticker); ?>"></div>
          </div>
        </div>
      </div>

      <!-- main content -->
      <div id="content"></div>

      <!--- add the footer -->
     <?php include 'modules/footer.php'; ?>

    </div>

    <script src="static/js/jquery-3.3.1.min.js"></script>
    <script src="static/js/bootstrap.min.js"></script>
    <script src="static/js/handlebars-v4.0.11.js"></script>
    <script src="https://files.coinmarketcap.com/static/widget/currency.js"></script>
    <script src="static/js/index.js"></script>

  </body>
</html>
