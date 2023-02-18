<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('root_id');
            $table->integer('subscriber_id');
            $table->string('product')->length(100);
            $table->integer('base_unit_id');
            $table->integer('unit_id');
            $table->integer('category_id');
            $table->integer('material_id');
            $table->string('product_type')->length(50);
            $table->string('code')->length(100);
            $table->float('current_unit_price');
            $table->double('current_srp');
            $table->float('mark_up');
            $table->double('current_package_srp');
            $table->integer('with_package');
            $table->string('desciption')->length(100);
            $table->integer('shelf_life');
            $table->string('photo')->length(255);
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('products');
    }
}
