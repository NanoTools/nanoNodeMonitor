<?php

// the project version
define('PROJECT_VERSION', '1.4.8');

// project URL
define('PROJECT_URL', 'https://github.com/NanoTools/nanoNodeMonitor');

// URL to get version of latest release from github
define('GITHUB_LATEST_API_URL', 'https://api.github.com/repos/NanoTools/nanoNodeMonitor/releases/latest');

// nano rep account for Nano Node Monitor 
define ('NODEMON_REP_ACCOUNT', 'xrb_1f56swb9qtpy3yoxiscq9799nerek153w43yjc9atoaeg3e91cc9zfr89ehj');

// banano rep account for Nano Node Monitor 
define ('NODEMON_BAN_REP_ACCOUNT', 'ban_1kxnxi5zurj6h7dfb87ik6hhu9yo63miyg6q1fjaxgnd1kknr5y5md4xwxoj');

// nano donation account for Nano Node Monitor development
define ('NODEMON_DON_ACCOUNT', 'xrb_1nanomon9uycemhgonue4twmcqmsu7oxw43maro8amj751ozpus8r8gsic48');

// baano donation account for Nano Node Monitor development
define ('NODEMON_BAN_DON_ACCOUNT', 'ban_1kxnxi5zurj6h7dfb87ik6hhu9yo63miyg6q1fjaxgnd1kknr5y5md4xwxoj');

// total number of characters for displaying Nano addresses including ellipsis
define ('NANO_ADDR_NUM_CHAR', 17);

// curl timeout in seconds to receive data from ninja (max delay is NINJA_TIMEOUT + NINJA_CONECTTIMEOUT)
define ('NINJA_TIMEOUT', 3);

// curl timeout in seconds to connect to ninja (max delay is NINJA_TIMEOUT + NINJA_CONECTTIMEOUT)
define ('NINJA_CONECTTIMEOUT', 2);
