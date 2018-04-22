<?php

class NullCache extends Cache {
  public function read($key) {
    return NULL;
  }

  public function write($key, $data) {
    return NULL;
  }
}
