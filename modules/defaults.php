<?php

// DO NOT MODIFY THIS FILE
// Please head to the config.sample.php
// and follow the instructions

// ----------- General Variables -----------

// Currency 'nano' or 'banano'
$currency = 'nano';

// Theme of your Node Monitor
// Nano Themes:   'dark' or 'light'
// Banano Themes: 'banano'
$themeChoice = 'light';

// Choice of block explorer
// Nano Explorers:   'nanode', 'ninja', 'nanoexplorer', 'nanowatch', or 'meltingice'
// Banano Explorers: 'banano'
$blockExplorer = 'nanode';

// autorefresh interval for the status webpage in seconds
$autoRefreshInSeconds = 5;

// Name of your node (default: your hostname)
$nanoNodeName = gethostname();

// Location of your node
// If left empty, we try to get it from My Nano Ninja.
$nodeLocation = '';

// A welcome message shown on top
$welcomeMsg = '';

// Coinmarketcap widget
// market data base and second currency e.g. USD, EUR, BTC, ETH
$cmcBaseCurrency = 'USD';
$cmcSecondaryCurrency = 'BTC';

// Other widget panels (TRUE / FALSE)
$cmcTicker = FALSE;
$cmcRank = FALSE;
$cmcMarketcap = FALSE;
$cmcVolume = FALSE;
$cmcStatsticker = FALSE;


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

// IP address for RPC (default: 127.0.0.1)
$nanoNodeRPCIP   = '[::1]';

// IP address for RPC (default: 7076)
// Nano nodes typically use port 7076.
// Banano nodes typically use port 7072.
$nanoNodeRPCPort = '7076';

// Account of this node
$nanoNodeAccount = '';

// Donation account for maintaining this node
$nanoDonationAccount = $nanoNodeAccount;

// Number of decimal places to display Nano balances, i.e.
$nanoNumDecimalPlaces = 0;

// ----------- Monitoring -----------

// Uptimerobot.com API key for external monitoring
$uptimerobotApiKey = '';

// Google Analytics Tracking ID.
$googleAnalyticsId = '';

// ----------- Social -----------
$socials = array();
