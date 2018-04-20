<?php

class ApcuCache extends Cache {
  private $ttl;

  public function __construct(array $options = array()) {
    $this->ttl = array_key_exists('ttl', $options) ? $options['ttl'] : 30;
  }

  public function read($key) {
    $data = apcu_fetch($key, $success);
    if ($success) return $data;
    return NULL;
  }

  public function write($key, $data) {
    return apcu_store($key, $data, $this->ttl);
  }
}
