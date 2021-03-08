<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_cars', function (Blueprint $table) {
            $table->id();
            $table->string('Model');
            $table->string('vehicleType');
            $table->string('chassisNo');
            $table->string('vehicleClass');
            $table->string('vehicleNumber');
            $table->string('licenseAuthority');
            $table->string('ownershipType');
            $table->string('trafficCode');
            $table->date('registrationDate');
            $table->date('registrationExpirationDate');
            $table->date('insuranceDate');
            $table->date('insuranceExpirationDate');
            $table->string('insuranceCompany');
            $table->string('ownershipImage');
            $table->string('trafficID');
            $table->string('salikCardNo');
            $table->string('aberCardNo');
            $table->longText('Notice');
            $table->integer('user_id')->nullable();
            $table->enum('status',['garage','damaged','working','stopped'])->default('working');
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
        Schema::dropIfExists('company_cars');
    }
}
