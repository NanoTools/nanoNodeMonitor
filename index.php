<html>
<head>
<link rel="stylesheet" type="text/css" href="modules/style.css">
<title>phpNodeXRai - <?php echo gethostname() ?></title>
</head>
<body>
<?php
// include config and functions
require_once($_SERVER["DOCUMENT_ROOT"] . '/modules/config.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/modules/functions.php');

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

// close curl handle
curl_close($ch);
?>


<a href="https://raiblocks.net/" target="_blank"><img align="left" style="margin-right:20px;" src="modules/logo-mini.png" width="100" /></a>

<h2>Node <?php print($version) ?> is running on <?php print(gethostname()); ?></h2>

<div class=float>
<p>Current block: <?php print($currentBlock) ?></p>
<p># of unchecked blocks: <?php print($uncheckedBlocks) ?></p>
</div>

<p>&nbsp;</p>

<div class=float>
<p>Donate: <?php print($raiDonationAccount); ?></p>
</div>

<hr>
<p align="center">Get phpNodeXRai on <a href="https://github.com/dbachm123/phpNodeXRai" target="_blank">Github</a></p> 

</body>
</html>
