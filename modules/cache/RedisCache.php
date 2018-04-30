<?php

class RedisCache extends Cache {
  private $ttl;

  public function __construct(array $options = array()) {
    $this->ttl = array_key_exists('ttl', $options) ? $options['ttl'] : 30;

    if (array_key_exists('redis', $options)) {
      $this->redis = $options['redis'];
    } else {
      $this->redis = new Redis();
      $this->redis->connect(
        array_key_exists('host', $options) ? $options['host'] : '127.0.0.1',
        array_key_exists('port', $options) ? $options['port'] : 6379
      );
    }
  }

  public function read($key) {
    $data = $this->redis->get($key);
    if ($data) return json_decode($data);
    return NULL;
  }

  public function write($key, $data) {
    return $this->redis->setEx($key, $this->ttl, json_encode($data));
  }
}
