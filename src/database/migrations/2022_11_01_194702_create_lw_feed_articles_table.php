<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
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
        Schema::create('lw_feed_articles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('feed_id')->unsigned();
            $table->uuid('uuid');
            $table->string('url');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('image');
            $table->string('language');
            $table->json('data')
                        ->default(new Expression('(JSON_ARRAY())'))
                        ->comment('The extra information of the saved article');
            $table->json('custom')
                        ->default(new Expression('(JSON_ARRAY())'))
                        ->comment('A custom filter for automation or specific searches');
            $table->boolean('active')
                        ->default(true)
                        ->comment('Defines if the article is able to be visible');
            $table->boolean('black_list')
                        ->default(false)
                        ->comment('The article is blacklisted if there are offensive words');
            $table->timestamp('date')->nullable();
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
        Schema::dropIfExists('lw_feed_articles');
    }
};
