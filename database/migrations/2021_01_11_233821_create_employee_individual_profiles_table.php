<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeIndividualProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_individual_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('started_job_at');
            $table->string('drive_license_number');
            $table->string('drive_license_end_at');
            $table->string('drive_license_photo');
            $table->string('national_license_number');
            $table->string('national_license_end_at');
            $table->string('national_license_photo');
            $table->string('passport_number');
            $table->string('passport_photo');
            $table->string('passport_end_at');
            $table->string('residence_end_at');
            $table->string('residence_photo');
            $table->string('delivery_commission');
            $table->string('receiving_commission');
            $table->string('personal_photo');


            $table->unsignedBigInteger('country_id');
//            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


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
        Schema::dropIfExists('employee_individual_profiles');
    }
}
