<?php

namespace JannisMilz\Docsify\Contracts;

use Illuminate\Contracts\Cache\Repository;

class Cache
{
  /**
   * The cache implementation.
   *
   * @var Repository
   */
  protected $cache;

  /**
   * Create a new documentation instance.
   *
   * @param  Repository  $cache
   * @return void
   */
  public function __construct(Repository $cache)
  {
    $this->cache = $cache;
  }

  /**
   * Wrapper.
   *
   * @param  \Closure  $callback
   * @param  string  $key
   * @return mixed
   */
  public function remember(\Closure $callback, $key)
  {
    if (!config('docsify.cache.enabled')) {
      return $callback();
    }

    $cachePeriod = config('docsify.cache.period');
    $app_version = explode('.', app()->version());

    // If version is higher than 5.8 minutes need to get changed to seconds
    if (($app_version[0] == '5' && $app_version[1] >= '8') || $app_version[0] > '5') {
      $cachePeriod *= 60;
    }

    return $this->cache->remember($key, $cachePeriod, $callback);
  }
}
