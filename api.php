<?php

// include required files
require_once __DIR__.'/modules/includes.php';

// get curl handle
$ch = curl_init();

if (!$ch) {
    myError('Could not initialize curl!');
}

// we have a valid curl handle here
// set some curl options
curl_setopt($ch, CURLOPT_URL, 'http://'.$nanoNodeRPCIP.':'.$nanoNodeRPCPort);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$data = new stdClass();
$data->nanoNodeAccount = $nanoNodeAccount;

// -- Get Version String from nano_node ---------------
$rpcVersion = getVersion($ch);
$data->version = $rpcVersion->{'node_vendor'};

// -- Get get current block from nano_node
$rpcBlockCount = getBlockCount($ch);
$data->currentBlock = $rpcBlockCount->{'count'};
$data->uncheckedBlocks = $rpcBlockCount->{'unchecked'};

// -- Get number of peers from nano_node
$rpcPeers = getPeers($ch);
$peers = (array) $rpcPeers->{'peers'};
$data->numPeers = count($peers);

// -- Get node account balance from nano_node
$rpcNodeAccountBalance = getAccountBalance($ch, $nanoNodeAccount);
$data->accBalanceMnano = rawToMnano($rpcNodeAccountBalance->{'balance'}, $nanoNumDecimalPlaces);
$data->accBalanceRaw = (int) $rpcNodeAccountBalance->{'balance'};
$data->accPendingMnano = rawToMnano($rpcNodeAccountBalance->{'pending'}, $nanoNumDecimalPlaces);
$data->accPendingRaw = (int) $rpcNodeAccountBalance->{'pending'};

// -- Get representative info for current node from nano_node
$rpcNodeRepInfo = getRepresentativeInfo($ch, $nanoNodeAccount);
$data->votingWeight = rawToMnano($rpcNodeRepInfo->{'weight'}, $nanoNumDecimalPlaces);
$data->repAccount = $rpcNodeRepInfo->{'representative'} ?: '';

// -- System uptime & memory info --
$data->systemLoad = getSystemLoadAvg();
$systemUptime = getSystemUptime();
$systemUptimeStr = $systemUptime['days'].' days, '.$systemUptime['hours'].' hrs, '.$systemUptime['mins'].' mins';
$data->systemUptime = $systemUptimeStr;
$data->usedMem = getSystemUsedMem();
$data->totalMem = getSystemTotalMem();
$data->uname = getUname();
$data->nanoNodeName = $nanoNodeName;

// get the node uptime
$data->nodeUptime = getNodeUptime($uptimerobotApiKey);

// close curl handle
curl_close($ch);

returnJson($data);
