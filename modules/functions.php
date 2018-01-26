<?php


// print error and die
function myError($errorMsg)
{
  die('<h3>'.$errorMsg.'</h3>');
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
    myError("RaiBlocks node is not running");
  }

  // JSON decode and return
  return json_decode($resp);
}

// raw to Mrai
function rawToMrai($raw, $precision)
{
  return round(($raw / 1000000000000000000000000000000.0), $precision);
}


// get version string from rai_node
function getVersion($ch)
{
  // get version string
  $data = array("action" => "version");

  // post curl
  return postCurl($ch, $data);
}


// get block count from rai_node
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

// get account balance for rai_node account
function getNodeAccountBalance($ch, $account) 
{
  // get block count
  $data = array("action" => "account_balance", "account" => $account);

  // post curl
  return postCurl($ch, $data);
}

?>


