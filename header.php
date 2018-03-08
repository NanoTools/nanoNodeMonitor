<?php
// include config and functions
require_once($_SERVER["DOCUMENT_ROOT"] . '/modules/config.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/modules/functions.php');
?>

<!DOCTYPE html>

<head>
<link rel="stylesheet" type="text/css" href="modules/style.css">
<title>Nano Node Monitor - phpNodeXRai - <?php echo gethostname() ?></title>
<meta name="format-detection" content="telephone=no">
</head>

<body>


<!-- Nano Market Data Section-->

<a href=<?php print($homeURL); ?>>
     <img src="modules/logo-mini.png" id="logo" width="220" alt="Nano Logo"/>
</a>

<?php

// get nano data from coinmarketcap
$nanoCMCData = getNanoInfoFromCMCTicker($cmcTickerUrl);


if (!empty($nanoCMCData))
{ // begin nano market data section

  // beautify market info to be displayed
  $nanoMarketCapUSD = "$" . number_format( (float) $nanoCMCData->{'market_cap_usd'} / pow(10,9), 2 ) . "B";
  $nanoMarketCapEUR =       number_format( (float) $nanoCMCData->{'market_cap_eur'} / pow(10,9), 2 ) . "B€";

  $nanoVolumeUSD = "$" . number_format( (float) $nanoCMCData->{'24h_volume_usd'} / pow(10,6), 2 ) . "M";
  $nanoVolumeEUR =       number_format( (float) $nanoCMCData->{'24h_volume_eur'} / pow(10,6), 2 ) . "M€";

  $nanoPriceUSD = "$" . number_format( (float) $nanoCMCData->{'price_usd'} , 2 );
  $nanoPriceEUR =       number_format( (float) $nanoCMCData->{'price_eur'} , 2 ) . "€";
  $nanoPriceBTC =       number_format( (float) $nanoCMCData->{'price_btc'} * pow(10,5), 2 ) . "k sat";

  $nanoChange24hPercent = number_format( (float) $nanoCMCData->{'percent_change_24h'}, 2 );
  $nanoChange7dPercent  = number_format( (float) $nanoCMCData->{'percent_change_7d'}, 2 );


  // color values for positive and negative change
  $colorPos = "darkgreen";
  $colorNeg = "RGB(100,0,0)";

  $nanoChange24hPercentHTMLCol = $colorNeg;
  $nanoChange7dPercentHTMLCol  = $colorNeg;

  // prepend '+' sign and make it green (hopefully ...)
  if ( $nanoChange24hPercent > 0)
  {
    $nanoChange24hPercent  = "+" . $nanoChange24hPercent;
    $nanoChange24hPercentHTMLCol = $colorPos;
  }

  if ( $nanoChange7dPercent > 0)
  {
    $nanoChange7dPercent  = "+" . $nanoChange7dPercent;
    $nanoChange7dPercentHTMLCol = $colorPos;
  }

  // append '%''
  $nanoChange24hPercent = $nanoChange24hPercent . "%";
  $nanoChange7dPercent  = $nanoChange7dPercent . "%";
?>

<!-- Nano Market Data Table -->

 <table class="ticker">
  <tr>
   <td><b>Price &nbsp; </b><?php print ($nanoPriceUSD . " | " . $nanoPriceEUR . " | " . $nanoPriceBTC); ?></td>
   <td><b>Change &nbsp;</b><?php print ("<span style='color:" . $nanoChange24hPercentHTMLCol . "'>" . $nanoChange24hPercent . " (24h)</span> | "
                                      . "<span style='color:" . $nanoChange7dPercentHTMLCol  . "'>" . $nanoChange7dPercent .  " (7d)</span>"); ?></td>
  </tr>
  <tr>
   <td><b>Market Cap &nbsp;</b><?php print ($nanoMarketCapUSD . " | " . $nanoMarketCapEUR ); ?></td>
   <td><b>24h Volume &nbsp; </b><?php print ($nanoVolumeUSD    . " | " . $nanoVolumeEUR    ); ?></td>
  </tr>
 </table>


<?php
} // end nano market data section
?>

<hr>
