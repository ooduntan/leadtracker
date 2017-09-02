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
            $table->integer('visitor_id')->unsigned();
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('company_name')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('company_billing_email')->unique()->nullable();
            $table->string('street')->nullable();
            $table->string('country')->nullable();
            $table->integer('postal_code')->nullable();
            $table->string('website')->nullable();
            $table->string('city')->nullable();
            $table->string('vat_id')->nullable();
            $table->timestamps();

            $table->foreign('visitor_id')
                    ->references('id')
                    ->on('visitors')
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
        Schema::dropIfExists('companies');
    }
}
