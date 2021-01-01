<?php

// post curl data array
function postCurl($ch, $data)
{
  $data_string = json_encode($data);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
  curl_setopt($ch, CURLOPT_TIMEOUT, 5);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
  );


  // Send the request and return response
  $resp = curl_exec($ch);

  if (!$resp)
  {
    myError("Node is not running");
  }

  // JSON decode and return
  return json_decode($resp);
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
  $data = array("action" => "block_count", "include_cemented" => "true");

  // post curl
  return postCurl($ch, $data);
}

// get number of peers
function getPeers($ch)
{
  // get peers
  $data = array("action" => "peers");

  // post curl
  return postCurl($ch, $data);
}

// get account balance for nano_node account
function getAccountBalance($ch, $account)
{
  // get account balance
  $data = array("action" => "account_balance", "account" => $account);

  // post curl
  return postCurl($ch, $data);
}

// get representative info for nano_node account
function getRepresentativeInfo($ch, $account)
{
  // get account info
  $data = array("action" => "account_info",
                "account" => $account,
                "representative" => "true",
                "weight" => "true");

  // post curl
  return postCurl($ch, $data);
}

// get account weight nano_node account
function getAccountWeight($ch, $account)
{
  // get account weight
  $data = array(
    "action" => "account_weight",
    "account" => $account
  );

  // post curl
  return postCurl($ch, $data);
}

// get number of peers
function getStats($ch, $type = "counters")
{
  // get peers
  $data = array(
    "action" => "stats", 
    "type" => $type);

  // post curl
  return postCurl($ch, $data);
}

// get confirmation history from nano_node
function getConfirmationHistory($ch)
{
  // get confirmation history of latest 2048 elections
  $data = array("action" => "confirmation_history");

  // post curl
  return postCurl($ch, $data);
}

// get node uptime
function getUptime($ch)
{
  // get uptime
  $data = array("action" => "uptime");

  // post curl
  return postCurl($ch, $data);
}

// get active difficulty
function getActiveDifficulty($ch)
{
  // get uptime
  $data = array("action" => "active_difficulty");

  // post curl
  return postCurl($ch, $data);
}

// get telemetry data from other nodes
function getTelemetry($ch)
{
  // get uptime
  $data = array("action" => "telemetry");

  // post curl
  return postCurl($ch, $data);
}

// get telemetry data from other nodes
function getDelegatorsCount($ch, $account)
{
  // get uptime
  $data = array("action" => "delegators_count", "account" => $account);

  // post curl
  return postCurl($ch, $data);
}
