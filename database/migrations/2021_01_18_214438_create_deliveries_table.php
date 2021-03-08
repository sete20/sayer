<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type_id');
            $table->string('consignee');
            $table->string('consignee_phone');
            $table->string('consignee_telephone')->nullable();
            $table->text('consignee_address');
            $table->integer('status')->default(1);

            $table->string('coupon_code')->nullable();
            $table->string('track_delivery_number')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('user_id');

            $table->string('received_date');
            $table->integer('package_number')->default(1);
            $table->integer('weight_in_kilo')->nullable();
            $table->tinyInteger('delivery_amount_from')->default(1);
            $table->string('home_number')->nullable();
            $table->text('notes')->nullable();
            $table->float('order_price')->default(0);
            $table->float('total_price');
            $table->string('order_number')->nullable();

//            $table->tinyInteger('is_breakable')->default(0);
//            $table->tinyInteger('is_cold')->default(0);
//            $table->tinyInteger('is_call_before_delivery')->default(0);
//            $table->tinyInteger('is_call_after_delivery')->default(0);

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
        Schema::dropIfExists('deliveries');
    }
}
