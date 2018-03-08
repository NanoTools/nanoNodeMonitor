<?php

// print error and die
function myError($errorMsg)
{
  die('<h2>'.$errorMsg.'</h2>');
}

// check whether php-curl is installed
function phpCurlAvailable()
{
    return function_exists('curl_version');
}

// post curl data array
function postCurl($ch, $data, $url, $addHeader)
{
    $data_string = json_encode($data);
    $header = array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string));
    $header = array_merge($header, $addHeader);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);


    // Send the request and return response
    $resp = curl_exec($ch);

    if (!$resp)
    {
      return False;
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
function getVersion($ch, $url)
{
  // get version string
  $data = array("action" => "version");
  
  // post curl
  $result = postCurl($ch, $data, $url, array());
  if (!$result) {
      myError("Node seems offline");
  }
  return $result;
}


// get block count from nano_node
function getBlockCount($ch, $url) 
{
  // get block count
  $data = array("action" => "block_count");

  // post curl
  return postCurl($ch, $data, $url, array());
}

// get number of peers
function getPeers($ch, $url) 
{
  // get block count
  $data = array("action" => "peers");

  // post curl
  return postCurl($ch, $data, $url, array());
}

// get account balance for nano_node account
function getAccountBalance($ch, $account, $url) 
{
  // get block count
  $data = array("action" => "account_balance", "account" => $account);

  // post curl
  return postCurl($ch, $data, $url, array());
}


// get representative info for nano_node account
function getRepresentativeInfo($ch, $account, $url) 
{
  // get block count
  $data = array("action" => "account_info", 
                "account" => $account, 
                "representative" => "true", 
                "weight" => "true");

  // post curl
  return postCurl($ch, $data, $url, array());
}

// get system load average
function getSystemLoadAvg()
{
  return sys_getloadavg ()[2];
}

// get system memory info
function getSystemMemInfo() 
{       
    $data = explode("\n", file_get_contents("/proc/meminfo"));
    $meminfo = array();
    foreach ($data as $line) {
        list($key, $val) = explode(":", $line);
        $meminfo[$key] = trim($val);
    }
    return $meminfo;
}

// get system total memory in MB
function getSystemTotalMem()
{
    return intval(getSystemMemInfo()["MemTotal"] / 1024);
}

// get system used memory in MB
function getSystemUsedMem()
{
    $meminfo = getSystemMemInfo();
    return intval(($meminfo["MemTotal"] - $meminfo["MemAvailable"]) / 1024);
}

// get system uptime array with secs, mins, hours and days
function getSystemUptime()
{
    $str   = file_get_contents('/proc/uptime');
    $num   = intval($str);
    $array = array();
    $array["secs"] = $num % 60;
    $num = intdiv($num, 60);
    $array["mins"] = $mins  = $num % 60;
    $num = (int)($num / 60);
    $array["hours"] = $num % 24;
    $num = (int)($num / 24);
    $array["days"] = $num;
    return $array;
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


// get current nanode.co block count

function getNanodeBlockCount($key, $nanodeUrl, $ch)
{
    $data = array('action' => 'block_count');
    return postCurl($ch, $data, $nanodeUrl, array('Authorization: ' . $key));
}


?>


