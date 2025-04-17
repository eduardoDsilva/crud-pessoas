<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

trait HasCache
{
    private const DEFAULT_CACHE_MINUTES  = 10;

    protected function getFromCache(string $key, \Closure $callback)
    {
        return Cache::remember($key, Carbon::now()->addMinutes(self::DEFAULT_CACHE_MINUTES), $callback);
    }

    protected function forgetCache(string $key)
    {
        return Cache::forget($key);
    }
}
