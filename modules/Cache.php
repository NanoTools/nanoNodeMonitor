<?php

require_once __DIR__.'/cache/FileCache.php';
require_once __DIR__.'/cache/NullCache.php';

abstract class Cache {
  public static function factory() {
    global $cache;
    switch ($cache["engine"]) {
      case 'files': return new FileCache($cache['options']);
      default: return new NullCache();
    }
  }

  abstract public function read($key);
  abstract public function write($key, $data, $options = []);

  public function fetch($key, $callback, $options = []) {
    $data = $this->read($key);
    if (is_null($data)) {
      $data = $callback();
      $this->write($key, $data, $options);
    }

    return $data;
  }
}
