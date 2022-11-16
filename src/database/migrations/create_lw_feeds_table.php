<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lw_feeds', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('title')->nullable()->comment('The name of RSS feed provider');
            $table->string('key')->unique()->index()->comment('The key | id on config file');
            $table->timestamp('read_at')->comment('Last time the original RSS was accessed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lw_feeds');
    }
};
