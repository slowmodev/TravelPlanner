<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalInformationTable extends Migration
{
    public function up()
    {
        Schema::create('additional_information', function (Blueprint $table) {
            $table->id();
            $table->string('local_currency');
            $table->string('exchange_rate');
            $table->string('timezone');
            $table->text('weather_forecast');
            $table->text('means_of_transportation');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('additional_information');
    }
}
