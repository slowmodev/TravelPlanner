<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationOverviewsTable extends Migration
{
    public function up()
    {
        Schema::create('location_overviews', function (Blueprint $table) {
            $table->id();
            $table->text('history_and_culture');
            $table->text('local_customs_and_traditions');
            $table->text('geographic_features_and_climate');
            $table->timestamps();
        });

        Schema::create('historical_events_and_landmarks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('location_overview_id');
            $table->string('name');
            $table->text('description');
            $table->string('coordinates');
            $table->timestamps();

            $table->foreign('location_overview_id')->references('id')->on('location_overviews')->onDelete('cascade');
        });

        Schema::create('cultural_highlights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('location_overview_id');
            $table->string('highlight');
            $table->timestamps();

            $table->foreign('location_overview_id')->references('id')->on('location_overviews')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cultural_highlights');
        Schema::dropIfExists('historical_events_and_landmarks');
        Schema::dropIfExists('location_overviews');
    }
}
