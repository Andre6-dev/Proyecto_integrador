<?php
namespace App\Extensions;

use Illuminate\Contracts\Cache\Store;
use Illuminate\Cache\DatabaseStore;
use Closure;
use MongoDB\BSON\UTCDateTime;
use MongoDB\Driver\Exception\BulkWriteException;
use Illuminate\Cache\Repository;
use Illuminate\Cache\Events\KeyWritten;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Facades\Cache;

class MongoTaggedCache extends Repository
{
    protected $tags;

    /**
     * @param \Illuminate\Contracts\Cache\Store $store
     * @param array $tags
     */
    public function __construct(Store $store, array $tags = [])
    {
        parent::__construct($store);

        $this->tags = $tags;
    }

    /**
     * Store an item in the cache with tags.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @param  \DateTimeInterface|\DateInterval|float|int  $ttl
     * @return void
     */
    public function put($key, $value, $ttl = null)
    {
        if (is_array($key)) {
            return $this->putMany($key, $value);
        }

        $seconds = $this->getSeconds(is_null($ttl) ? 315360000 : $ttl);

        if ($seconds > 0) {
            $result = $this->store->put($this->itemKey($key), $value, $seconds, $this->tags);

            if ($result) {
                $this->event(new KeyWritten($key, $value, $seconds));
            }

            return $result;
        } else {
            return $this->forget($key);
        }
    }

    /**
     * Saves array of key value pairs to the cache
     *
     * @param array $values
     * @param  \DateTimeInterface|\DateInterval|float|int  $ttl
     * @return void
     */
    public function putMany(array $values, $ttl = null)
    {
        foreach ($values as $key => $value) {
            $this->put($key, $value, $ttl);
        }
    }

    /**
     * Flushes the cache for the given tags
     *
     * @return void
     */
    public function flush()
    {
        return $this->store->flushByTags($this->tags);
    }
}

class MongoStore extends DatabaseStore  implements Store
{
        /*
        $config= config('cache.stores.mongodb',[
            'driver'='mongodb',
            'table' ='cache',
        ])

*/


    #public function __construct()
    #{

/*
        $this->app->booting(function () {
            Cache::extend('mongo', function ($app) {
                return Cache::repository(new MongoStore);
            });
        });
*/
/*
        Cache::extend('mongodb', function ($app) {
            $config = config('cache')['stores']['mongodb_atlas'];
            $prefix = config('cache')['prefix'];
            $connection = $app['db']->connection($config['connection'] ?? null);

            parent::__construct($connection,$config['table'],$prefix);

        });*/

          //return Cache::repository(new MongoStore($connection, $config['table'], $prefix));
        // register the cache indexing commands if running in cli

    #}


    /**
     * Sets the tags to be used
     *
     * @param array $tags
     * @return MongoTaggedCache
     */
    public function tags(array $tags)
    {
        return new MongoTaggedCache($this, $tags);
    }

    /**
     * Retrieve an item from the cache by key.
     *
     * @param  string $key
     * @return mixed
     */
    public function get($key)
    {
        $cacheData = $this->table()->where('key', $this->getKeyWithPrefix($key))->first();

        return $cacheData ? $this->decodeFromSaved($cacheData['value']) : null;
    }

    /**
     * Store an item in the cache for a given number of seconds.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @param  float|int  $ttl
     * @param  array|null $tags
     * @return bool
     */
    public function put($key, $value, $ttl, $tags = [])
    {
        $expiration = ($this->getTime() + (int) $ttl) * 1000;

        try {
            return (bool) $this->table()->where('key', $this->getKeyWithPrefix($key))->update(
                [
                    'value' => $this->encodeForSave($value),
                    'expiration' => new UTCDateTime($expiration),
                    'tags' => $tags
                ],
                ['upsert' => true]
            );
        } catch (BulkWriteException $exception) {
            // high concurrency exception
            return false;
        }
    }

    /**
     * Retrieve an item's expiration time from the cache by key.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getExpiration($key)
    {
        $cacheData = $this->table()->where('key', $this->getKeyWithPrefix($key))->first();

        if (!$cacheData) {
            return null;
        }

        $expirationSeconds = $cacheData['expiration']->toDateTime()->getTimestamp();

        return round(($expirationSeconds - time()) / 60);
    }

    /**
     * Increment or decrement an item in the cache.
     *
     * @param  string  $key
     * @param  int  $value
     * @param  Closure  $callback
     * @return int|bool
     */
    protected function incrementOrDecrement($key, $value, Closure $callback)
    {
        if (isset($this->connection->transaction)) {
            return parent::incrementOrDecrement($key, $value, $callback);
        }

        $currentValue = $this->get($key);

        if ($currentValue === null) {
            return false;
        }

        $newValue = $callback($currentValue, $value);

        if ($this->put($key, $newValue, $this->getExpiration($key))) {
            return $newValue;
        }

        return false;
    }

    /**
     * Format the key to always search for
     *
     * @param string $key
     * @return string
     */
    protected function getKeyWithPrefix(string $key)
    {
        return $this->getPrefix() . $key;
    }

    /**
     * Encode data for save
     *
     * @param mixed $data
     * @return string
     */
    protected function encodeForSave($data)
    {
        return serialize($data);
    }

    /**
     * Decode data from save
     *
     * @param string $data
     * @return mixed
     */
    protected function decodeFromSaved($data)
    {
        return unserialize($data);
    }

    /**
     * Deletes all records with the given tag
     *
     * @param array $tags
     * @return void
     */
    public function flushByTags(array $tags)
    {
        foreach ($tags as $tag) {
            $this->table()->where('tags', $tag)->delete();
        }
    }
}
