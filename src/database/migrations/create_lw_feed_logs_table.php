<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lw_feed_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('feed_id')->unsigned();
            $table->uuid('uuid');
            $table->string('title')->nullable();
            $table->string('key');
            $table->string('action');
            $table->timestamp('date');
            $table->timestamps();

            $table->foreign('feed_id')->references('id')->on('lw_feeds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lw_feed_logs');
    }
};
