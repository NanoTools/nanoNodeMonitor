<?php

// checks if the config file got edited
if(!file_exists(__DIR__ . '/config.php')) {
	require_once(__DIR__ . '/functions.php');
    myError('Please edit the config file first! Go to the <i>modules</i> folder, ' . 
    	    ' execute <i>cp config.sample.php config.php</i> and modify <i>config.php</i> ' .
    	    ' according to your needs.');
}

// load the config
require_once(__DIR__ . '/constants.php');

// load the defaults
require_once(__DIR__ . '/defaults.php');

// load the config
require_once(__DIR__ . '/config.php');

// load all RPC function
require_once(__DIR__ . '/functions_rpc.php');

// load all other required functions
require_once(__DIR__ . '/functions.php');

// check for curl package (needs functions)
if (!phpCurlAvailable()) {
    myError('Curl not available. Please install the php-curl package!');
}

// check for curl package (needs functions)
if (empty($nanoNodeAccount)) {
    myError('Node Account not set up. Please edit your config!');
}