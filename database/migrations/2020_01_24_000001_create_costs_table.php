<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostsTable extends Migration
{
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('transportation_costs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cost_id');
            $table->string('mode');
            $table->string('cost_range');
            $table->timestamps();

            $table->foreign('cost_id')->references('id')->on('costs')->onDelete('cascade');
        });

        Schema::create('dining_costs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cost_id');
            $table->string('place');
            $table->string('cost_range');
            $table->timestamps();

            $table->foreign('cost_id')->references('id')->on('costs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dining_costs');
        Schema::dropIfExists('transportation_costs');
        Schema::dropIfExists('costs');
    }
}
