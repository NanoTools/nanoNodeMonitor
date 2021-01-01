<?php

// the project version
define('PROJECT_VERSION', '1.5.6');

// project URL
define('PROJECT_URL', 'https://github.com/NanoTools/nanoNodeMonitor');

// URL to get version of latest release from github
define('GITHUB_LATEST_API_URL', 'https://api.github.com/repos/NanoTools/nanoNodeMonitor/releases/latest');

// nano rep account for Nano Node Monitor 
define ('NODEMON_REP_ACCOUNT', 'nano_1f56swb9qtpy3yoxiscq9799nerek153w43yjc9atoaeg3e91cc9zfr89ehj');

// banano rep account for Nano Node Monitor 
define ('NODEMON_BAN_REP_ACCOUNT', 'ban_1kxnxi5zurj6h7dfb87ik6hhu9yo63miyg6q1fjaxgnd1kknr5y5md4xwxoj');

// nano donation account for Nano Node Monitor development
define ('NODEMON_DON_ACCOUNT', 'nano_1ninja7rh37ehfp9utkor5ixmxyg8kme8fnzc4zty145ibch8kf5jwpnzr3r');

// baano donation account for Nano Node Monitor development
define ('NODEMON_BAN_DON_ACCOUNT', 'ban_1ninja7rh37ehfp9utkor5ixmxyg8kme8fnzc4zty145ibch8kf5jwpnzr3r');

// total number of characters for displaying Nano addresses including ellipsis
define ('NANO_ADDR_NUM_CHAR', 17);

// curl timeout in seconds to receive data from external services (max delay is EXTERNAL_TIMEOUT + EXTERNAL_CONECTTIMEOUT)
define ('EXTERNAL_TIMEOUT', 3);

// curl timeout in seconds to connect to external services (max delay is EXTERNAL_TIMEOUT + EXTERNAL_CONECTTIMEOUT)
define ('EXTERNAL_CONECTTIMEOUT', 2);

// maximum allowed age of data to be part of the block confirmation time percentiles calculation (milliseconds)
define ('CONFIRMATION_TIME_LIMIT', 600000);
