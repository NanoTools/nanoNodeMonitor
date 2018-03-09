<?php

// checks if the config file got edited
if(!file_exists(__DIR__ . '/config.php')){
    die('Please edit the config file first!');
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