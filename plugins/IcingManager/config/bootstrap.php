<?php

use Cake\Cache\Cache;

Cache::config('forever', [
    'className' => 'File',
    'duration' => '+10 years',
    'path' => CACHE,
    'prefix' => 'icing_forever_'
]);
Cache::config('oneHour', [
    'className' => 'File',
    'duration' => '+1 hours',
    'path' => CACHE,
    'prefix' => 'icing_oneHour_'
]);