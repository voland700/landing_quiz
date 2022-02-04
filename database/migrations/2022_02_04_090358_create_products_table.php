<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('active')->unsigned()->default(1);
            $table->string('name');
            $table->integer('sort')->unsigned()->default(500);
            $table->integer('hit')->unsigned()->default(0);
            $table->integer('top')->unsigned()->default(0);
            $table->integer('stock')->unsigned()->default(0);
            $table->integer('gift')->unsigned()->default(0);
            $table->text('summary')->nullable();
            $table->text('description')->nullable();
            $table->string('img')->nullable();
            $table->json('properties')->nullable();
            $table->string('link')->nullable();
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
        Schema::dropIfExists('products');
    }
}
