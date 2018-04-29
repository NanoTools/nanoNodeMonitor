<?php

// DO NOT MODIFY THIS FILE
// Please head to the config.sample.php
// and follow the instructions

// ----------- General Variables -----------

// Theme of your Node Monitor (dark or light)
$themeChoice = 'dark';

// autorefresh interval for the status webpage in seconds
$autoRefreshInSeconds = 5;

// Name of your node (default: your hostname)
$nanoNodeName = gethostname();

// a welcome message shown on top
$welcomeMsg = '';

// coinmarketcap widget
// market data base and second currency e.g. USD, EUR, BTC, ETH
$cmcBaseCurrency = 'USD';
$cmcSecondaryCurrency = 'BTC';

// other widget panels (TRUE / FALSE)
$cmcTicker = FALSE;
$cmcRank = FALSE;
$cmcMarketcap = FALSE;
$cmcVolume = FALSE;
$cmcStatsticker = FALSE;

// choice of Nano block explorer ('nanode', 'nanoexplorer', 'nano')
$blockExplorer = 'nanode';

// ----------- Cache Engine ----------- 

// The cache engine allows for caching of RPC calls to reduce load on your Nano node.

// Duration in seconds between cache invalidation, i.e. RPC calls to the node
$cacheTimeToLive = 30;

// Possible options for "engine" are:
//    - NULL (no caching)
//    - "files" (caches to file; kind of slow)
//    - "apc" (APC cache; requires extension; fast)
//      - Options: 'ttl' => cache time in seconds
//    - "apcu" (APCu cache; requires extension; fast)
//      - Options: 'ttl' => cache time in seconds

$cache = [
   "engine" => "files",
   "options" => ["ttl" => $cacheTimeToLive]
];

// ----------- Nano Node Variables -----------

// ip address for RPC (default: 127.0.0.1)
$nanoNodeRPCIP   = '[::1]';

// ip address for RPC (default: 7076)
$nanoNodeRPCPort = '7076';

// account of this node
$nanoNodeAccount = '';

// donation account for maintaining this node
$nanoDonationAccount = $nanoNodeAccount;

// number of decimal places to display Nano balances, i.e.
$nanoNumDecimalPlaces = 6;

// ----------- Monitoring -----------

// Uptimerobot.com API key for external monitoring
$uptimerobotApiKey = '';

// ----------- Social -----------
$socials = array();



