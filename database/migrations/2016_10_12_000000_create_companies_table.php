<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('visitor_id')->unsigned();
            $table->string('company_name');
            $table->string('owner_id');
            $table->string('company_billing_email')->unique();
            $table->string('street');
            $table->string('country');
            $table->string('postal_code');
            $table->string('subscription');
            $table->string('website');
            $table->string('city');
            $table->string('vat_id');
            $table->timestamps();

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('visitor_id')
                    ->references('id')
                    ->on('visitors')
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
        Schema::dropIfExists('companies');
    }
}
