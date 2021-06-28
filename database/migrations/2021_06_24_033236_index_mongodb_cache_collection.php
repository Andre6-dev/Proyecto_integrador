<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use App\Extensions\Commands\MongodbCacheIndex;
use App\Extensions\Commands\MongodbCacheIndexTags;
use App\Extensions\Commands\MongodbCacheDropIndex;

class IndexMongodbCacheCollection extends Migration
{
  /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Artisan::call('mongodb:cache:index');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Artisan::call('mongodb:cache:dropindex', ['index' => 'key_1']);
        Artisan::call('mongodb:cache:dropindex', ['index' => 'expiration_ttl_1']);
    }
}
