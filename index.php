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
    <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
      <div class="container">
        <a href="../" class="navbar-brand">Nano Node Monitor</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

          <ul class="nav navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="https://www.nanode.co/account/<?php echo $nanoDonationAccount; ?>" target="_blank">Donate</a>
            </li>
            <li class="nav-item">

              <a class="nav-link" href="https://github.com/dbachm123/nanoNodeMonitor" target="_blank">Source on GitHub</a>

            </li>
          </ul>

        </div>
      </div>
    </div>


    <div class="container">

      <div class="page-header mb-3" id="banner">
        <div class="row">
          <div class="col-lg-8 col-md-7 col-sm-6">
            <a href="https://nano.org" target="_blank">
              <img src="static/img/logo-white.svg" width="220" alt="Nano Logo"/>
            </a>
            <p class="lead">Nano Node Monitor</p>

            <p><?php echo $welcomeMsg; ?></p>
          </div>
          <div class="col-lg-4 col-md-5 col-sm-6">
            <div class="coinmarketcap-currency-widget" data-currencyid="1567" data-base="<?php echo $cmcBaseCurrency; ?>" data-secondary="<?php echo $cmcSecondaryCurrency; ?>" data-ticker="true" data-rank="false" data-marketcap="true" data-volume="true" data-stats="<?php echo $cmcBaseCurrency; ?>" data-statsticker="false"></div>

          </div>
        </div>
      </div>

      <div id="content"></div>

      <footer id="footer">
        <div class="row">
          <div class="col-lg-12">

            <p>Version: <?php echo PROJECT_VERSION; ?></p>

            <p>Contributors: <a href="https://github.com/dbachm123">dbachm123</a>, <a href="https://github.com/BitDesert">BitDesert</a>, <a href="https://github.com/NiFNi">NiFNi</a></p>
          </div>
        </div>
      </footer>

    </div>

    <script src="static/js/jquery-3.3.1.min.js"></script>
    <script src="static/js/bootstrap.min.js"></script>
    <script src="static/js/handlebars-v4.0.11.js"></script>
    <script src="https://files.coinmarketcap.com/static/widget/currency.js"></script>
    <script src="static/js/index.js"></script>
  </body>
</html>
