<?php

// include required files
require_once __DIR__.'/modules/includes.php';

// check for curl package
if (!phpCurlAvailable()) {
    myError('Curl not available. Please install the php-curl package!');
}

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
$data->accBalanceMnano = rawToMnano($rpcNodeAccountBalance->{'balance'}, 4);
$data->accBalanceRaw = (int) $rpcNodeAccountBalance->{'balance'};
$data->accPendingMnano = rawToMnano($rpcNodeAccountBalance->{'pending'}, 4);
$data->accPendingRaw = (int) $rpcNodeAccountBalance->{'pending'};

// -- Get representative info for current node from nano_node
$rpcNodeRepInfo = getRepresentativeInfo($ch, $nanoNodeAccount);
$data->votingWeight = rawToMnano($rpcNodeRepInfo->{'weight'}, 4);
$data->repAccount = $rpcNodeRepInfo->{'representative'} ?: '';

// -- System uptime & memory info --
$data->systemLoad = getSystemLoadAvg();
$systemUptime = getSystemUptime();
$systemUptimeStr = $systemUptime['days'].' days, '.$systemUptime['hours'].' hours, '.$systemUptime['mins'].' minutes';
$data->systemUptime = $systemUptimeStr;
$data->usedMem = getSystemUsedMem();
$data->totalMem = getSystemTotalMem();

// close curl handle
curl_close($ch);

returnJson($data);
