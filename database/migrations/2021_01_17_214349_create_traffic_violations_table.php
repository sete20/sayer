<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrafficViolationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traffic_violations', function (Blueprint $table) {
            $table->id();
            $table->string('car_id');
            $table->string('user_id')->nullable();
            $table->string('violation_number');
            $table->date('violation_date');
            $table->double('violation_value');
            $table->string('violation_type');
            $table->string('violation_status');
            $table->string('violation_area');
            $table->string('violation_image')->nullable();
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
        Schema::dropIfExists('traffic_violations');
    }
}
