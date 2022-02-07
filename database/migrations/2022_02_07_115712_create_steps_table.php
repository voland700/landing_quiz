<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->integer('active')->unsigned()->default(1);
            $table->string('name');
            $table->integer('sort')->unsigned()->default(50);
            $table->string('type')->nullable()->default('radio');
            $table->integer('extra')->unsigned()->default(0);
            $table->integer('obligatory')->unsigned()->default(1);
            $table->text('advice')->nullable();
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
        Schema::dropIfExists('steps');
    }
}
