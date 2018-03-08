<?php

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

// raw to Mnano
function rawToMnano($raw, $precision)
{
  return round(($raw / 1000000000000000000000000000000.0), $precision);
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

// returns JSON data to the client
function returnJson($data)
{
  header('Content-Type: application/json; charset=utf-8');
  header('Access-Control-Allow-Origin: *');
  echo json_encode($data);
}