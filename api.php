<?php

// include required files
require_once __DIR__.'/modules/includes.php';

$cache = Cache::factory();

// get cached response
$data = $cache->fetch('api', function () use (
  &$nanoNodeRPCIP, &$nanoNodeRPCPort, &$nanoNodeAccount, &$blockExplorer,
  &$nanoNodeName, &$nanoNumDecimalPlaces, &$uptimerobotApiKey, &$themeChoice
) {
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
    $data->nanoNodeAccountShort = truncateAddress($data->nanoNodeAccount);
    $data->nanoNodeAccountUrl = getAccountUrl($data->nanoNodeAccount, $blockExplorer);

    // -- Get Version String from nano node and node monitor
    $data->version = getVersionFormatted($ch);
    $data->newNodeVersionAvailable = isNewNodeVersionAvailable($data->version);
    $data->nodeMonitorVersion = PROJECT_VERSION;

    // -- Get get current block from nano_node
    $rpcBlockCount = getBlockCount($ch);
    $data->currentBlock = (int) $rpcBlockCount->{'count'};
    $data->uncheckedBlocks = (int) $rpcBlockCount->{'unchecked'};
    $data->blockSync = getSyncStatus($data->currentBlock);

    // -- Get number of peers from nano_node
    $rpcPeers = getPeers($ch);
    $peers = (array) $rpcPeers->{'peers'};
    $data->numPeers = count($peers);

    // -- Get node account balance from nano_node
    $rpcNodeAccountBalance = getAccountBalance($ch, $nanoNodeAccount);
    $data->accBalanceMnano = rawToMnano($rpcNodeAccountBalance->{'balance'});
    $data->accBalanceRaw = (int) $rpcNodeAccountBalance->{'balance'};
    $data->accPendingMnano = rawToMnano($rpcNodeAccountBalance->{'pending'});
    $data->accPendingRaw = (int) $rpcNodeAccountBalance->{'pending'};

    // -- Get representative info for current node from nano_node
    $rpcNodeRepInfo = getRepresentativeInfo($ch, $nanoNodeAccount);
    $data->repAccount = $rpcNodeRepInfo->{'representative'} ?: '';
    $data->repAccountShort = truncateAddress($data->repAccount);
    $data->repAccountUrl = getAccountUrl($data->repAccount, $blockExplorer);

    // get the account weight
    $rpcNodeAccountWeight = getAccountWeight($ch, $nanoNodeAccount);
    $data->votingWeight = rawToMnano($rpcNodeAccountWeight->{'weight'});

    // -- System uptime & memory info --
    $data->systemLoad = getSystemLoadAvg();
    $systemUptime = getSystemUptime();
    $systemUptimeStr = $systemUptime['days'].' days, '.$systemUptime['hours'].' hrs, '.$systemUptime['mins'].' mins';
    $data->systemUptime = $systemUptimeStr;
    $data->usedMem = getSystemUsedMem();
    $data->totalMem = getSystemTotalMem();
    //$data->uname = getUname();
    $data->nanoNodeName = $nanoNodeName;

    // get the node uptime (if we have a api key)
    if ($uptimerobotApiKey) {
        $data->nodeUptime = getNodeUptime($uptimerobotApiKey);
    }

    // get info from Nano Node Ninja
    $data->nodeNinja = getNodeNinja($nanoNodeAccount);

    // currency symbol
    $data->currencySymbol = currencySymbolFromTheme($themeChoice);

    // close curl handle
    curl_close($ch);

    return $data;
});

returnJson($data);
