<?php

namespace App\Providers;

use App\Extensions\MongoStore;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use App\Extensions\Commands\MongodbCacheIndex;
use App\Extensions\Commands\MongodbCacheIndexTags;
use App\Extensions\Commands\MongodbCacheDropIndex;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

     public function register()
    {
       
        $this->app->booting(function () {
            Cache::extend('mongo', function ($app) {
                $config = config('cache')['stores']['mongodb'];
                $prefix = config('cache')['prefix'];
                $connection = $app['db']->connection($config['connection'] ?? null);
                return Cache::repository(new MongoStore($connection,$config['table'],$prefix));
            });
        });

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

            $this->commands([
                MongodbCacheIndex::class,
                MongodbCacheIndexTags::class,
                MongodbCacheDropIndex::class,
            ]);
        }
        /*
        $this->app->resolving('cache', function ($cache) {
             @var $cache CacheManager 
            $cache->extend('mongo', function ($app) {
                
                $manager = new MongoStore();

                return $manager->driver('mongodb');
            });
        });
        
        */
    }
    /*
        $this->app->booting(function () {
             Cache::extend('mongo', function ($app) {
                 return Cache::repository(new MongoStore($app));
             });
         });
    }*/

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
        $this->app->resolving('cache', function ($cache) {
            @var $cache CacheManager 
           $cache->extend('mongo', function ($app) {
               
               $manager = new MongoStore();

               return $manager->driver('mongodb');
           });
       });
       */

        $this->app->booting(function () {
            Cache::extend('mongodb', function ($app) {
                /*
                $config = config('cache')['stores']['mongodb'];
                $prefix = config('cache')['prefix'];
                $connection = $app['db']->connection($config['connection'] ?? null);
    */
                //return Cache::repository(new MongoStore($connection, $config['table'], $prefix));
            
                return Cache::repository(new MongoStore) ;
            });
        });

        // register the cache indexing commands if running in cli
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

            $this->commands([
                MongodbCacheIndex::class,
                MongodbCacheIndexTags::class,
                MongodbCacheDropIndex::class,
            ]);
        }
    }
}
