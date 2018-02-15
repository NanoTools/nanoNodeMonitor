<?php
// include config and functions
require_once($_SERVER["DOCUMENT_ROOT"] . '/modules/config.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/modules/functions.php');
?>

<!DOCTYPE html>

<head>
<link rel="stylesheet" type="text/css" href="modules/style.css">
<title>Nano Node Monitor - phpNodeXRai - <?php echo gethostname() ?></title>
<meta http-equiv="refresh" content="<?php echo $autoRefreshInSeconds; ?>">
<meta name="format-detection" content="telephone=no">
</head>

<body>
<?php


// check for curl package
if (!phpCurlAvailable())
{
  myError('Curl not available. Please install the php-curl package!');
}

// get curl handle
$ch = curl_init();

if (!$ch)
{
  myError('Could not initialize curl!');
}

// we have a valid curl handle here
// set some curl options
curl_setopt($ch, CURLOPT_URL, 'http://'.$nanoNodeRPCIP.':'.$nanoNodeRPCPort);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// -- Get Version String from nano_node ---------------
$rpcVersion = getVersion($ch);
$version = $rpcVersion->{'node_vendor'};

// -- Get get current block from nano_node 
$rpcBlockCount = getBlockCount($ch);
$currentBlock = $rpcBlockCount->{'count'};
$uncheckedBlocks = $rpcBlockCount->{'unchecked'};

// -- Get number of peers from nano_node 
$rpcPeers = getPeers($ch);
$peers = (array) $rpcPeers->{'peers'};
$numPeers = count($peers);

// -- Get node account balance from nano_node 
$rpcNodeAccountBalance = getAccountBalance($ch, $nanoNodeAccount);
$accBalanceMnano = rawToMnano($rpcNodeAccountBalance->{'balance'},4);
$accPendingMnano = rawToMnano($rpcNodeAccountBalance->{'pending'},4);

// -- Get representative info for current node from nano_node 
$rpcNodeRepInfo = getRepresentativeInfo($ch, $nanoNodeAccount);
$votingWeight = rawToMnano($rpcNodeRepInfo->{'weight'},4);
$repAccount = $rpcNodeRepInfo->{'representative'};


// close curl handle
curl_close($ch);
?>




<!-- Nano Market Data Section-->

<a href="https://nano.org/" target="_blank">
	<img src="modules/logo-mini.png" width="220" style="float:left; padding-right:25px" alt="Nano Logo"/>
</a>


<?php

// get nano data from coinmarketcap
$nanoCMCData = getNanoInfoFromCMCTicker($cmcTickerUrl);

// beautify market info to be displayed
$nanoMarketCapUSD = "$" . number_format( (float) $nanoCMCData->{'market_cap_usd'} / pow(10,9), 2 ) . "B";
$nanoMarketCapEUR = "€" . number_format( (float) $nanoCMCData->{'market_cap_eur'} / pow(10,9), 2 ) . "B";

$nanoVolumeUSD = "$" . number_format( (float) $nanoCMCData->{'24h_volume_usd'} / pow(10,6), 2 ) . "M";
$nanoVolumeEUR = "€" . number_format( (float) $nanoCMCData->{'24h_volume_eur'} / pow(10,6), 2 ) . "M";

$nanoPriceUSD = "$" . number_format( (float) $nanoCMCData->{'price_usd'} , 2 );
$nanoPriceEUR = "€" . number_format( (float) $nanoCMCData->{'price_eur'} , 2 );
$nanoPriceBTC =       number_format( (float) $nanoCMCData->{'price_btc'} * pow(10,5), 2 ) . "k sat";

$nanoChange24hPercent = number_format( (float) $nanoCMCData->{'percent_change_24h'}, 2 ) . "%";
$nanoChange7dPercent  = number_format( (float) $nanoCMCData->{'percent_change_7d'}, 2 ) . "%";

if (!empty($nanoCMCData))
{ // begin nano market data section
?>


 <table class="ticker" style="position:relative; padding-left:15px">
  <tr>
   <td><b>Price &nbsp; </b><?php print ($nanoPriceUSD . " | " . $nanoPriceEUR . " | " . $nanoPriceBTC); ?></td>
   <td><b>Change &nbsp;</b><?php print ($nanoChange24hPercent . " (24h) | " . $nanoChange24hPercent . " (7d)"); ?></td>
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

<!-- Node Info Table -->

<div class="float" style="margin-bottom:3em;">	
<p class="medium" style="margin-top:0.4em; margin-bottom:1em"><b>Node Info</b></p>
<table style="margin-left:1em">
  <tr>
  <td class="small">Version:</td>
  <td class="small"><?php print($version) ?></td>
 </tr>
 <tr>
  <td class="small">Current Block:</td>
  <td class="small"><?php print($currentBlock) ?></td>
 </tr>
 <tr>
  <td class="small">Number of Unchecked Blocks: </td>
  <td class="small"><?php print($uncheckedBlocks) ?></td>
 </tr>
 <tr>
  <td class="small">Number of Peers: </td>
  <td class="small"><?php print($numPeers) ?></td>
 </tr>
  <tr>
  <td class="small">Server Name:</td>
  <td class="small"><?php print(gethostname()) ?></td>
 </tr>
 <tr>
  <td class="small">System Load Average: </td>
  <td class="small"><?php print(getSystemLoadAvg()); ?></td>
 </tr>
</table>
</div>

<!-- Node Account Table -->

<hr>

<div class="float" style="margin-bottom:3em"> 
<p class="medium" style="margin-top:0.4em; margin-bottom:1em"><b>Node Account Info</b></p>
<table style="margin-left:1em;">
  <tr>
  <td class="small">Address:</td>
  <td class="small">
  	<a class="small" href="https://www.nanode.co/account/<?php print($nanoNodeAccount); ?>" target="_blank"><?php print($nanoNodeAccount); ?></a>
  </td> 
 </tr>
 <tr>
  <td class="small">Balance:</td>
  <td class="small">
  	<?php echo $accBalanceMnano; ?> Nano (<?php echo $accPendingMnano; ?> Nano pending)
  </td>
 </tr>
 <tr>
  <td class="small">Voting Weight:</td>
  <td class="small"><?php echo $votingWeight; ?> Nano</td>
 </tr>
  <tr>
  <td class="small">Representative:</td>
  <td class="small">
  	<a class="small" href="https://www.nanode.co/account/<?php print($repAccount); ?>" target="_blank"><?php print($repAccount); ?></a>
  </td>
 </tr>
 </table>
</div>

<!-- Footer -->

<hr>

<p class="tiny" style="text-align:center; color:#cbcdcf">
Get phpNodeXRai on <a class="tiny" href="https://github.com/dbachm123/phpNodeXRai" target="_blank" style="color:#cbcdcf">Github</a>
<br>
Donations:
<a class="tiny" href="https://www.nanode.co/account/<?php print($nanoDonationAccount); ?>" target=_blank style="color:#cbcdcf"><?php print($nanoDonationAccount); ?></a>
</p>

</body>
</html>
