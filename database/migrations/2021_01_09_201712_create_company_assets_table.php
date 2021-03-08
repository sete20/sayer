<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_assets', function (Blueprint $table) {
            $table->id();
            $table->string('assetName');
            $table->string('purchase_date');
            $table->string('billNumber');
            $table->string('supplier');
            $table->string('quantity');
            $table->string('specifications');
            $table->enum('status',['new','used','damaged','custody','stored'])->default('new');
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
        Schema::dropIfExists('company_assets');
    }
}
