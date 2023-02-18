<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitConversionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_conversions', function (Blueprint $table) {
            $table->id();
            $table->integer('material_id');
            $table->integer('product_id');
            $table->integer('base_id');
            $table->integer('equivalent_id');
            $table->float('unit_price');
            $table->float('srp');
            $table->float('quantity');
            $table->integer('created_by');
            $table->timestamps();
            $table->integer('status');
            $table->integer('exported');
            $table->integer('uploaded');
            $table->integer('updated');
            $table->string('branch_code')->length(10);
            $table->string('subscriber_code')->length(10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit_conversions');
    }
}
