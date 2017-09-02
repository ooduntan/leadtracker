<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('website_id')->unsigned();
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('ip_address');
            $table->integer('status')->default(0);
            $table->string('country');
            $table->integer('postal_code')->nullable();
            $table->string('company');
            $table->text('description')->nullable();
            $table->string('links');
            $table->string('source')->nullable();
            $table->string('state')->nullable();
            $table->string('first_seen');
            $table->string('last_seen');
            $table->timestamps();

            $table->foreign('website_id')
                ->references('id')
                ->on('websites')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}
