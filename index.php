<?php
include('header.php');

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

$nodeUrl = 'http://'.$nanoNodeRPCIP.':'.$nanoNodeRPCPort;
// -- Get Version String from nano_node ---------------
$rpcVersion = getVersion($ch, $nodeUrl);
$version = $rpcVersion->{'node_vendor'};

// -- Get get current block from nano_node 
$rpcBlockCount = getBlockCount($ch, $nodeUrl);
$currentBlock = $rpcBlockCount->{'count'};
$uncheckedBlocks = $rpcBlockCount->{'unchecked'};

// -- Get number of peers from nano_node 
$rpcPeers = getPeers($ch, $nodeUrl);
$peers = (array) $rpcPeers->{'peers'};
$numPeers = count($peers);

// -- Get node account balance from nano_node 
$rpcNodeAccountBalance = getAccountBalance($ch, $nanoNodeAccount, $nodeUrl);
$accBalanceMnano = rawToMnano($rpcNodeAccountBalance->{'balance'},4);
$accPendingMnano = rawToMnano($rpcNodeAccountBalance->{'pending'},4);

// -- Get representative info for current node from nano_node 
$rpcNodeRepInfo = getRepresentativeInfo($ch, $nanoNodeAccount, $nodeUrl);
$votingWeight = rawToMnano($rpcNodeRepInfo->{'weight'},4);
$repAccount = $rpcNodeRepInfo->{'representative'};

// -- Get nanode.co block count if possible
$nanodeBlockCount = getNanodeBlockCount($nanodeKey, "https://api.nanode.co/", $ch);
if (!$nanodeBlockCount) {
    $blockDiff = "Could not reach nanode.co API!";
} else {
    $blockDiff = $nanodeBlockCount->count - $currentBlock;
}


// close curl handle
curl_close($ch);
?>
<script language="JavaScript" type="text/javascript">
setTimeout("location.href = 'index.php'", <?php print( $autoRefreshInSeconds * 1000); ?>); // milliseconds, so 10 seconds = 10000ms
</script>


<!-- Node Info Table -->
<?php $uptime = getSystemUptime(); ?>
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
<?php if ($blockDiff) : ?>
 <tr>
  <td class="small">Difference to <a class="small" href="https://www.nanode.co/">nanode.co</a>:</td>
  <td class="small"><?php print($blockDiff) ?> (If negative this node has more validated blocks.)</td>
 </tr>
<?php endif; ?>
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
 <tr>
  <td class="small">System Memory Usage: </td>
  <td class="small"><?php print(getSystemAvailMem() . "MB / " . getSystemTotalMem() . "MB"); ?></td>
 </tr>
 <tr>
  <td class="small">System Uptime: </td>
  <td class="small"><?php print($uptime["days"] . " days, " . $uptime["hours"] . " hours, " . $uptime["mins"] . " minutes and " . $uptime["secs"] . " seconds"); ?></td>
 </tr>
</table>
</div>

<hr>

<!-- Node Account Table -->

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



<?php
include('footer.php');
?>
