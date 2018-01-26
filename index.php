<?php
// include config and functions
require_once($_SERVER["DOCUMENT_ROOT"] . '/modules/config.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/modules/functions.php');
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="modules/style.css">
<title>phpNodeXRai - <?php echo gethostname() ?></title>
<meta http-equiv="refresh" content="<?php echo $autoRefreshInSeconds; ?>">
</head>
<body>
<?php

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
curl_setopt($ch, CURLOPT_URL, 'http://'.$raiNodeRPCIP.':'.$raiNodeRPCPort);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// -- Get Version String from rai_node ---------------
$rpcVersion = getVersion($ch);
$version = $rpcVersion->{'node_vendor'};

// -- Get get current block from rai_node 
$rpcBlockCount = getBlockCount($ch);
$currentBlock = $rpcBlockCount->{'count'};
$uncheckedBlocks = $rpcBlockCount->{'unchecked'};

// -- Get number of peers from rai_node 
$rpcPeers = getPeers($ch);
$peers = (array) $rpcPeers->{'peers'};
$numPeers = count($peers);

// -- Get node account balance from rai_node 
$rpcNodeAccountBalance = getNodeAccountBalance($ch, $raiNodeAccount);
$accBalanceMrai = rawToMrai($rpcNodeAccountBalance->{'balance'},4);
$accPendingMrai = rawToMrai($rpcNodeAccountBalance->{'pending'},4);

// close curl handle
curl_close($ch);
?>


<a href="https://raiblocks.net/" target="_blank"><img align="left" style="margin-right:20px;" src="modules/logo-mini.png" width="100" /></a>

<h2>Node <?php print($version) ?> is running on <?php print(gethostname()); ?></h2>

<div class=float>
<table border="0" width="500px">
 <tr>
  <td width="80%">Current block:</td>
  <td width="20%"><?php print($currentBlock) ?> </td>
 </tr>
 <tr>
  <td width="80%">Number of unchecked blocks: </td>
  <td width="20%"><?php print($uncheckedBlocks) ?></td>
 </tr>
 <tr>
  <td width="80%">Number of peers: </td>
  <td width="20%"><?php print($numPeers) ?></td>
 </tr>
</table>
</div>
<p></p>
<div class=float>
<p class="medium">Node account:</p>
<p class="medium">
<a class="medium" href="https://raiblocks.net/account/index.php?acc=<?php print($raiNodeAccount); ?>" target=_blank><?php print($raiNodeAccount); ?></a>
</p>
<p class="medium">
with a balance of <?php echo $accBalanceMrai; ?> XRB (<?php echo $accPendingMrai; ?> XRB pending)
</p>
</div>

<p>&nbsp;</p>

<hr>
<p align="center" class="small" style="color:#cbcdcf">
Get phpNodeXRai on <a class="small" href="https://github.com/dbachm123/phpNodeXRai" target="_blank" style="color:#cbcdcf">Github</a>
</p>
<p align="center" class="small" style="color:#cbcdcf">
Donations:
<a class="small" href="https://raiblocks.net/account/index.php?acc=<?php print($raiDonationAccount); ?>" target=_blank style="color:#cbcdcf"><?php print($raiDonationAccount); ?></a>
</p>

</body>
</html>
