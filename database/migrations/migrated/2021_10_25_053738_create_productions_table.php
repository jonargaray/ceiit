<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_product_id');
            $table->string('batch')->length(50);
            $table->decimal('srp');
            $table->integer('qty');
            $table->integer('rejected');
            $table->date('production_date');
            $table->date('expiration_date');
            $table->integer('status');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->integer('exported');
            $table->integer('uploaded');
            $table->integer('updated');
            $table->string('subscriber_code')->length(10);
            $table->string('branch_code')->length(10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productions');
    }
}
