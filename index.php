<?php
// include config and functions
require_once($_SERVER["DOCUMENT_ROOT"] . '/modules/config.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/modules/functions.php');
?>

<!DOCTYPE html>

<head>
<link rel="stylesheet" type="text/css" href="modules/style.css">
<title>Nano Node Monitor - <?php echo gethostname() ?></title>
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


<a href="https://nano.org/" target="_blank">
	<img src="modules/logo-mini.png" width="150" alt="Nano Logo"/>
</a>


<h1>Node version <i><?php print($version) ?></i> is running on server <i><?php print(gethostname()); ?></i></h1>


<!-- Node Info Table -->

<div class="float" style="margin-bottom:3em">	
<p class="medium" style="margin-top:0.4em; margin-bottom:1em"><b>Node Info</b></p>
<table style="margin-left:1em">
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
  <td class="small">System Load Average: </td>
  <td class="small"><?php print(getSystemLoadAvg()); ?></td>
 </tr>
</table>
</div>

<!-- Node Account Table -->

<div class="float">
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
