<?php

// print error and die
function myError($errorMsg)
{
  header("HTTP/1.1 503 Service Unavailable");
  die($errorMsg);
}

// check whether php-curl is installed
function phpCurlAvailable()
{
    return function_exists('curl_version');
}

// raw to Mnano
function rawToMnano($raw, $precision)
{
  return (float)number_format(($raw / 1000000000000000000000000000000.0), $precision);
}

// get system load average
function getSystemLoadAvg()
{
  return sys_getloadavg()[2];
}

// get system memory info
function getSystemMemInfo() 
{       
    $data = explode("\n", file_get_contents("/proc/meminfo"));
    $meminfo = array();
    foreach ($data as $line) {
        list($key, $val) = explode(':', $line.':');
        $meminfo[$key] = trim($val);
    }
    return $meminfo;
}

// get system total memory in MB
function getSystemTotalMem()
{
    return intval((int)getSystemMemInfo()["MemTotal"] / 1024);
}

// get system used memory in MB
function getSystemUsedMem()
{
    $meminfo = getSystemMemInfo();
    return intval(((int)$meminfo["MemTotal"] - (int)$meminfo["MemAvailable"]) / 1024);
}

// get system uptime array with secs, mins, hours and days
function getSystemUptime()
{
    $str   = file_get_contents('/proc/uptime');
    $num   = intval($str);
    $array = array();
    $array["secs"] = $num % 60;
    $num = (int)($num / 60);
    $array["mins"] = $mins  = $num % 60;
    $num = (int)($num / 60);
    $array["hours"] = $num % 24;
    $num = (int)($num / 24);
    $array["days"] = $num;
    return $array;
}

// returns JSON data to the client
function returnJson($data)
{
  header('Content-Type: application/json; charset=utf-8');
  header('Access-Control-Allow-Origin: *');
  echo json_encode($data);
}

// converts boolean to a string
function bool2string($boolean)
{
    return ($boolean) ? 'true' : 'false';
}

// get version of latest release from github
function getLatestReleaseVersion()
{
  // get release tag of "latest" from github
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => GITHUB_LATEST_API_URL,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache",
      "User-Agent: NanoNodeMonitor"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);
  
  if ($err) {
    return "API error";
  }

  // decode JSON response
  $response = json_decode($response);

  // tag string
  if (property_exists($response, "tag_name"))
  {
      $tagString = $response->tag_name;
  
    // search for version name x.x.x 
    if (0 != preg_match('/(\d+\.?)+$/', $tagString, $versionString))
    {
        return $versionString[0];
    }
  }

  return "";
}

// get a string with information about the 
// current version and possible updates
function getVersionInformation()
{
  $currentVersion = PROJECT_VERSION;
  $latestVersion  = getLatestReleaseVersion();

  $versionInfo = "Version: " . $currentVersion;

  if ( version_compare($currentVersion, $latestVersion) < 0 )
  {
    $versionInfo .= "<br>A new version " . $latestVersion;
    $versionInfo .= " is available on ";
    $versionInfo .= "<a href=\"" . PROJECT_URL . "\" target=\"_blank\">GitHub.</a>";
  }

  return $versionInfo;

}

// info about operating system
function getUname()
{
  return php_uname();
}


// get Node Uptime
function getNodeUptime($apiKey, $uptimeRatio = 30)
{
  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.uptimerobot.com/v2/getMonitors",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 5,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "api_key=$apiKey&format=json&custom_uptime_ratios=$uptimeRatio",
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache",
      "content-type: application/x-www-form-urlencoded"
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  
  curl_close($curl);
  
  if ($err) {
    return "API error";
  }

  // decode JSON response
  $response = json_decode($response);
  
  return (float)$response->monitors[0]->custom_uptime_ratio;
}


// truncate long Nano addresses to display the first and 
// last characaters with ellipsis in the center
function truncateAddress($addr)
{
  $totalNumChar = NANO_ADDR_NUM_CHAR;
  $numEllipsis  = 3; // ...
  $numPrefix    = 4; // xrb_
  $numAddrParts  = floor(($totalNumChar-$numEllipsis-$numPrefix) / 2.0);

  return strlen($addr) > $totalNumChar ? substr($addr,0,$numPrefix+$numAddrParts)."...".substr($addr,-$numAddrParts) : $addr;
}

// get a block explorer URL from an account
function getAccountUrl($account, $blockExplorer)
{
  switch ($blockExplorer)
  {
    case 'nano':
      return "https://nano.org/en/explore/account/" . $account;
    case 'nanoexplorer':
      return "https://nanoexplorer.io/accounts/" . $account;
    case 'nanowatch':
      return "https://nanowat.ch/account/" . $account;
    default:
      return "https://www.nanode.co/account/" . $account;
  }
}

