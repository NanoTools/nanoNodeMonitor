<?php

require_once __DIR__.'/cache/ApcCache.php';
require_once __DIR__.'/cache/ApcuCache.php';
require_once __DIR__.'/cache/FileCache.php';
require_once __DIR__.'/cache/NullCache.php';

abstract class Cache {
  public static function factory() {
    global $cache;
    switch ($cache["engine"]) {
      case 'apc': return new ApcCache($cache['options']);
      case 'apcu': return new ApcuCache($cache['options']);
      case 'files': return new FileCache($cache['options']);
      default: return new NullCache();
    }
  }

  abstract public function read($key);
  abstract public function write($key, $data);

  public function fetch($key, $callback) {
    $data = $this->read($key);
    if (is_null($data)) {
      $data = $callback();
      $this->write($key, $data);
    }

    return $data;
  }
}
