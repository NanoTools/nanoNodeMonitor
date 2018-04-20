<?php

// FIRST USE
// Please copy this file as config.php

// To edit a config uncomment the line, otherwise
// defaults will be used for each variable.

// ----------- General Variables -----------

// autorefresh interval for the status webpage in seconds
// $autoRefreshInSeconds = 5;

// Name of your node (default: your hostname)
// $nanoNodeName = '';

// a welcome message shown on top
// $welcomeMsg = 'Nano rocks!';

// coinmarketcap widget
// market data base and second currency e.g. USD, EUR, BTC, ETH
// $cmcBaseCurrency = 'USD';
// $cmcSecondaryCurrency = 'BTC';

// other widget panels (TRUE / FALSE)
// $cmcTicker = FALSE;
// $cmcRank = FALSE;
// $cmcMarketcap = FALSE;
// $cmcVolume = FALSE;
// $cmcStatsticker = FALSE;

// choice of Nano block explorer ('nanode', 'ninja', 'nanoexplorer', 'nano', 'nanowatch')
// $blockExplorer = 'nanode';

// ----------- Cache Engine ----------- 

// The cache engine allows for caching of RPC calls to reduce load on your Nano node.

// Duration in seconds between cache invalidation, i.e. RPC calls to the node
// $cacheTimeToLive = 30;

// Possible options for "engine" are:
//    - NULL (no caching)
//    - "files" (caches to file; kind of slow)
//    - "apc" (APC cache; requires extension; fast)
//      - Options: 'ttl' => cache time in seconds
//    - "apcu" (APCu cache; requires extension; fast)
//      - Options: 'ttl' => cache time in seconds

// $cache = [
//   "engine" => "files",
//   "options" => ["ttl" => $cacheTimeToLive]
// ];

// ----------- Nano Node Variables -----------

// ip address for RPC (default: [::1])
// $nanoNodeRPCIP   = '[::1]';

// ip address for RPC (default: 7076)
// $nanoNodeRPCPort = '7076';

// account of this node
// $nanoNodeAccount = 'xrb_1f56swb9qtpy3yoxiscq9799nerek153w43yjc9atoaeg3e91cc9zfr89ehj';

// donation account for maintaining this node
// $nanoDonationAccount = 'xrb_1f56swb9qtpy3yoxiscq9799nerek153w43yjc9atoaeg3e91cc9zfr89ehj';

// number of decimal places to display Nano balances, i.e.
// $nanoNumDecimalPlaces = 2;

// ----------- Monitoring -----------

// Uptimerobot.com API key for external monitoring
// Tutorial: https://github.com/NanoTools/nanoNodeMonitor/wiki/Uptimerobot-Node-Monitoring
// If $uptimerobotApiKey is not set, monitoring via https://nanonode.ninja/ is used
// $uptimerobotApiKey = '';

// ----------- Social -----------

// Add your social accounts
// Tutorial: https://github.com/NanoTools/nanoNodeMonitor/wiki/Social-Accounts
// $socials['reddit'] = 'https://www.reddit.com/user/NANOFAN1337/';
