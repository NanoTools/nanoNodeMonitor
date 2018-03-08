<?php

// version number
$versionString = '1.2';

// print error and die
function myError($errorMsg)
{
  header("HTTP/1.1 503 Service Unavailable");
  die('<h2>'.$errorMsg.'</h2>');
}

// check whether php-curl is installed
function phpCurlAvailable()
{
    return function_exists('curl_version');
}

// post curl data array
function postCurl($ch, $data)
{
  $data_string = json_encode($data);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
  );


  // Send the request and return response
  $resp = curl_exec($ch);

  if (!$resp)
  {
    myError("Nano node is not running");
  }

  // JSON decode and return
  return json_decode($resp);
}

// raw to Mnano
function rawToMnano($raw, $precision)
{
  return round(($raw / 1000000000000000000000000000000.0), $precision);
}


// get version string from nano_node
function getVersion($ch)
{
  // get version string
  $data = array("action" => "version");

  // post curl
  return postCurl($ch, $data);
}


// get block count from nano_node
function getBlockCount($ch) 
{
  // get block count
  $data = array("action" => "block_count");

  // post curl
  return postCurl($ch, $data);
}

// get number of peers
function getPeers($ch) 
{
  // get block count
  $data = array("action" => "peers");

  // post curl
  return postCurl($ch, $data);
}

// get account balance for nano_node account
function getAccountBalance($ch, $account) 
{
  // get block count
  $data = array("action" => "account_balance", "account" => $account);

  // post curl
  return postCurl($ch, $data);
}


// get representative info for nano_node account
function getRepresentativeInfo($ch, $account) 
{
  // get block count
  $data = array("action" => "account_info", 
                "account" => $account, 
                "representative" => "true", 
                "weight" => "true");

  // post curl
  return postCurl($ch, $data);
}

// get system load average
function getSystemLoadAvg()
{
  return sys_getloadavg ()[2];
}

// get current nano price, volume and market cap 
// from coinmarket cap

function getNanoInfoFromCMCTicker($cmcTickerUrl)
{
  if (empty($cmcTickerUrl))
  {
    return array();
  }

  // get nano info from coinmarketcap as JSON
  $tickerJson = file_get_contents($cmcTickerUrl);
  if (empty($tickerJson))
  {
    return array();
  }

  // decode and return the entries for nano
  $jsonDecoded = json_decode($tickerJson); 
  $keyNano = array_search('nano', array_column($jsonDecoded, 'id'));
  if (!$keyNano)
  {
    return array();
  }

  return ( $jsonDecoded[$keyNano] );
}

function returnJson($data)
{
  header('Content-Type: application/json; charset=utf-8');
  header('Access-Control-Allow-Origin: *');
  echo json_encode($data);
}