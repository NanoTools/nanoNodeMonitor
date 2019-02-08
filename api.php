<?php

// include required files
require_once __DIR__.'/modules/includes.php';

$cache = Cache::factory();

// set an API name so multiple monitors don't mix
$apiName = "api-$nanoNodeAccount";

// get cached response
$data = $cache->fetch($apiName, function () use (
  &$nanoNodeRPCIP, &$nanoNodeRPCPort, &$nanoNodeAccount, &$blockExplorer,
  &$nanoNodeName, &$nanoNumDecimalPlaces, &$uptimerobotApiKey, &$currency,
  &$nodeLocation
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
    $data->version = getVersion($ch);

    // Cache the github query for latest node version
    global $nodeVersionCache;
    $nodeVersionCache = new FileCache(['ttl' => 10 * 60]); // cache for 10 minutes

    // set a cache name so multiple monitors don't mix
    $cacheName = "nodeVersionCache-$nanoNodeAccount";

    // get cached response
    $nodeVersionData = $nodeVersionCache->fetch($cacheName, function () {
        $nodeVersionData = new stdClass();
        $nodeVersionData->latestNodeReleaseVersion = getLatestNodeReleaseVersion();

        return $nodeVersionData;
    });
    $latestVersion = $nodeVersionData->latestNodeReleaseVersion;
    $data->newNodeVersionAvailable = isNewNodeVersionAvailable(formatVersion($data->version), $latestVersion, $currency);
    $data->nodeMonitorVersion = PROJECT_VERSION;

    // -- Get get current block from nano_node
    $rpcBlockCount = getBlockCount($ch);
    $data->currentBlock = (int) $rpcBlockCount->{'count'};
    $data->uncheckedBlocks = (int) $rpcBlockCount->{'unchecked'};

    if ($currency == 'nano') {
        $data->blockSync = getSyncStatus($data->currentBlock);
    }

    // -- Get number of peers from nano_node
    $rpcPeers = getPeers($ch);
    $peers = (array) $rpcPeers->{'peers'};
    $data->numPeers = count($peers);

    // -- Get confirmation info from nano_node. Average time, blocks used, time span  and percentiles over last 5min or max 2048 blocks
    //$timeStampBefore = microtime(true);
    $rpcConfHistory = getConfirmationHistory($ch);
    $confirmations = $rpcConfHistory->{'confirmations'}; // a list of last X confirmations {hash,duration,time,tally}
    //$confAverage = $rpcConfHistory->{'confirmation_stats'}->{'average'}; // average time [ms] of all confirmations
    //$confCount = $rpcConfHistory->{'confirmation_stats'}->{'count'}; // number of confirmations retrieved from the node

    // remove data older than $timeLimit
    usort($confirmations, "cmpByTime"); // sort array by time value [ms unix time]
    $confCompact = array(); // new filtered array
    $durationTotal = 0; // for average calc
    $confAverage = 0; // average confirmation duration
    $timeSpan = 0; // full time span of the data [ms]
    foreach ($confirmations as $confirmation) {
        // only keep data which is later than X ms from latest (highest) value
        if ($confirmation->{'time'} >= $confirmations[0]->{'time'} - CONFIRMATION_TIME_LIMIT) {
            array_push($confCompact, $confirmation); // add new data
            $durationTotal += $confirmation->{'duration'};
        }
        else {
            break; // stop iterating once we pass that limit to save time
        }
    }
    $confCount = count($confCompact);

    // calculate duration average and time span, avoid dividing by zero
    if ($confCount > 0) {
        $confAverage = round($durationTotal / $confCount);
        $timeSpan = $confCompact[0]->{'time'} - $confCompact[$confCount-1]->{'time'}; // first minus last
    }

    // get percentiles directly from the filtered array
    usort($confCompact, "cmpByDuration"); // sort array by duration value
    $percentile50 = getConfirmationsDurationPercentile(50, $confCompact); // 50 percentile also called median
    $percentile75 = getConfirmationsDurationPercentile(75, $confCompact);
    $percentile90 = getConfirmationsDurationPercentile(90, $confCompact);
    $percentile95 = getConfirmationsDurationPercentile(95, $confCompact);
    $percentile99 = getConfirmationsDurationPercentile(99, $confCompact);

    // combine an array with all confirmation info
    $confSummary = array('count' => $confCount, 'timeSpan' => $timeSpan, 'average' => $confAverage, 'percentile50' => $percentile50,
    'percentile75' => $percentile75, 'percentile90' => $percentile90, 'percentile95' => $percentile95, 'percentile99' => $percentile99);
    $data->confirmationInfo = $confSummary;
    //$data->apiProcTimeConf = round((microtime(true) - $timeStampBefore) * 1000);

    // -- Get node account balance from nano_node
    $rpcNodeAccountBalance = getAccountBalance($ch, $nanoNodeAccount);
    $data->accBalanceMnano = rawToCurrency($rpcNodeAccountBalance->{'balance'}, $currency);
    $data->accBalanceRaw = (int) $rpcNodeAccountBalance->{'balance'};
    $data->accPendingMnano = rawToCurrency($rpcNodeAccountBalance->{'pending'}, $currency);
    $data->accPendingRaw = (int) $rpcNodeAccountBalance->{'pending'};

    // -- Get representative info for current node from nano_node
    $rpcNodeRepInfo = getRepresentativeInfo($ch, $nanoNodeAccount);
    $data->repAccount = $rpcNodeRepInfo->{'representative'} ?: '';
    $data->repAccountShort = truncateAddress($data->repAccount);
    $data->repAccountUrl = getAccountUrl($data->repAccount, $blockExplorer);

    // get the account weight
    $rpcNodeAccountWeight = getAccountWeight($ch, $nanoNodeAccount);
    $data->votingWeight = rawToCurrency($rpcNodeAccountWeight->{'weight'}, $currency);

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

    // get info from My Nano Ninja
    $data->nodeNinja = getNodeNinja($nanoNodeAccount);

    // get node location
    // 1) If location is set by user, we use it.
    // 2) If location not set by user, we try to get if from ninja.
    $data->nodeLocation = getNodeLocation($nodeLocation, $data->nodeNinja);

    // currency and currency symbol
    $data->currency = $currency;
    $data->currencySymbol = currencySymbol($currency);

    // node statistics
    // maybe we get more stats later
    // so this is seperate object
    $data->stats = new stdClass();

    // get the counters
    $data->stats->counters = getStats($ch, 'counters');

    // close curl handle
    curl_close($ch);

    // calculate total script execution time
    $data->apiProcTime = round((microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]) * 1000);

    return $data;
});

returnJson($data);
