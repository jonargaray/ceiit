<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_suppliers', function (Blueprint $table) {
            $table->id();
            $table->integer('material_id');
            $table->integer('product_id');
            $table->integer('supplier_id');
            $table->integer('unit_id');
            $table->double('current_unit_price');
            $table->string('item_type')->length(50);
            $table->timestamps();
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
        Schema::dropIfExists('material_suppliers');
    }
}
