<?php

// print error and die
function myError($errorMsg)
{
  header("HTTP/1.1 503 Service Unavailable");
  die('<div class="myError">' . $errorMsg . '</div>');
}

// check whether php-curl is installed
function phpCurlAvailable()
{
    return function_exists('curl_version');
}

// raw to Mnano
function rawToMnano($raw)
{
  return (float) ($raw / 1000000000000000000000000000000.0);
}

// raw to banano
function rawToBanano($raw)
{
  return rawToMnano($raw) * 10.;
}

// raw to currency
function rawToCurrency($raw, $currency)
{
  switch ($currency)
  {
    case 'banano':
      return rawToBanano($raw);
    default:
      return rawToMnano($raw);
  }
}

// get system load average
function getSystemLoadAvg()
{
  return sys_getloadavg()[2];
}

// get system memory info
function getSystemMemInfo()
{
    if (!file_exists("/proc/meminfo")) return NULL;
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
    if (!file_exists('/proc/uptime')) return NULL;
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
    CURLOPT_CONNECTTIMEOUT => 2,
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

  return PROJECT_VERSION;
}

// get a string with information about the
// current version and possible updates
function getVersionInformation($latestVersion)
{
  $currentVersion = PROJECT_VERSION;
  $versionInfo = "Version: " . $currentVersion;

  if ( version_compare($currentVersion, $latestVersion) < 0 )
  {
    $versionInfo .= "<br>A new version " . $latestVersion;
    $versionInfo .= " is available on ";
    $versionInfo .= "<a href=\"" . PROJECT_URL . "\" target=\"_blank\" rel=\"noopener\">GitHub.</a>";
  }

  return $versionInfo;

}

// get version of latest release from github
function getLatestNodeReleaseVersion()
{

  // get release tag of "latest" from github
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.github.com/repos/nanocurrency/nano-node/releases/latest',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => EXTERNAL_TIMEOUT,
    CURLOPT_CONNECTTIMEOUT => EXTERNAL_CONECTTIMEOUT,
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
    return substr($response->tag_name, 1); //delete the V at the beginning
  }

  return '';
}

// gets the number from the version string
function formatVersion($rawversion){
  $formattedVersionArray = explode(' ', $rawversion);
  $formattedVersion = ltrim($formattedVersionArray[1], 'V');

  return $formattedVersion;
}

// get a string with information about the
// current version and possible updates
function isNewNodeVersionAvailable($currentVersion, $latestVersion, $currency)
{

  // for now, we can only check nano reliably
  if ($currency != "nano") {
    return false;
  } 

  $currentVersion = $currentVersion;

  if ( version_compare($currentVersion, $latestVersion) < 0 ){
    return $latestVersion;
  } else {
    return false;
  }
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
    CURLOPT_TIMEOUT => EXTERNAL_TIMEOUT,
    CURLOPT_CONNECTTIMEOUT => EXTERNAL_CONECTTIMEOUT,
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
  $errCode = -1;

  curl_close($curl);

  if ($err) {
    return $errCode;
  }

  // decode JSON response
  $response = json_decode($response);

  if (json_last_error() != JSON_ERROR_NONE) {
    return $errCode;
  }

  if (! array_key_exists('monitors', $response)) {
    return $errCode;
  }

  return (float)$response->monitors[0]->custom_uptime_ratio;
}

// truncate long Nano addresses to display the first and
// last characters with ellipsis in the center
function truncateAddress($addr)
{
  $totalNumChar = NANO_ADDR_NUM_CHAR;
  $numEllipsis  = 3; // ...
  $numPrefix    = 4; // xrb_

  // handle nano_ prefix of addresses

  if (substr($addr, 0, 5) === "nano_")
  {
    $numPrefix = 5;
  }

  $numAddrParts  = floor(($totalNumChar-$numEllipsis-$numPrefix) / 2.0);

  return strlen($addr) > $totalNumChar ? substr($addr,0,$numPrefix+$numAddrParts)."...".substr($addr,-$numAddrParts) : $addr;
}

// get a block explorer URL from an account
function getAccountUrl($account, $blockExplorer)
{
  if(is_null($account)) return NULL;

  switch ($blockExplorer)
  {
    case 'ninja':
      return "https://mynano.ninja/account/" . $account;
    case 'nanocrawler-beta':
      return "https://beta.nanocrawler.cc/explorer/account/" . $account;
    case 'bananocreeper':
      return "https://creeper.banano.cc/explorer/account/" . $account;
    case 'bananolooker':
      return "https://bananolooker.com/account/" . $account;
    case 'yellowspyglass':
      return "https://yellowspyglass.com/search?address=" .$account;
    default:
      return "https://nanocrawler.cc/explorer/account/" . $account;
  }
}

// get sync status
function getSyncStatus($node_blockcount, $telemetry_blockcount){
  $sync = round(($node_blockcount / $telemetry_blockcount) * 100, 1);

  if($sync > 100){
    return 100;
  }
  return $sync;
}

// get node location
// 1) If location is set by user, we use it.
// 2) If location not set by user, we try to get if from ninja.
function getNodeLocation($nodeLocationByUser, $nodeNinja) {

    $locationDefault = "N/A";
    $location = $locationDefault;

    if ($nodeLocationByUser) {
        // location set by user
        $location = $nodeLocationByUser;
    }
    elseif ($nodeNinja && array_key_exists('location', $nodeNinja)) {

        // location taken from ninja's location object
        $locationObj = $nodeNinja->{'location'};

        $locCity = '';
        $locCountry = '';

        // get city from ninja's location object
        if ($locationObj && isset($locationObj->city)) {
          $locCity = $locationObj->city;
        }

        // get country from ninja's location object
        if ($locationObj && isset($locationObj->country)) {
          $locCountry = $locationObj->country;
        }

        // city and country available
        if (! empty($locCity) && ! empty($locCountry)) {
          $location = $locCity . ', ' . $locCountry;
        }
        elseif (! empty($locCity)) {
          // only city
          $location = $locCity;
        }
        elseif (! empty($locCountry)) {
          // only country
          $location = $locCountry;
        }
        else
        {
          // nothing given
          $location = $locationDefault;
        }
    }
   
    // run some final checks on location
    if (is_null($location) || empty($location)) {
      $location = $locationDefault;
    }

    return $location;
}


// get currency name from currency
function currencyName($currency) 
{
  switch ($currency) {
    case 'banano':
      return "Banano";
    
    case 'nano-beta':
      return "Nano BETA";
    
    default:
      return "Nano";
  }

}


// get currency symbol from currency
function currencySymbol($currency) 
{
  switch ($currency) {
    case 'banano':
      return "BANANO";
    
    case 'nano-beta':
      return "\u{3B2}NANO";
    
    default:
      return "NANO";
  }

}

// sort array by 'duration' sub value
function cmpByDuration($a, $b) {
  return $a->{'duration'} - $b->{'duration'};
}

// sort array by 'time' sub value (largest first)
function cmpByTime($a, $b) {
  return $b->{'time'} - $a->{'time'};
}

// get a percentile from a sorted json structure which contains sub element values with the name 'duration'
// ex: get_percentile(75, $arr) to get the 75th percentile
function getConfirmationsDurationPercentile($percentile, $array) {
    if (empty($array)) {
        return 0;
    }
    $index = ($percentile/100) * count($array);
    if (floor($index) == $index) {
         $result = ($array[$index-1]->{'duration'} + $array[$index]->{'duration'})/2;
    }
    else {
        $result = $array[floor($index)]->{'duration'};
    }
    return (int) $result;
}
