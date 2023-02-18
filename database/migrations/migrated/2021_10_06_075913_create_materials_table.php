<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->integer('subscriber_id');
            $table->string('material')->length(100);
            $table->string('category')->length(50);
            $table->string('description')->length(100)->nullable();
            $table->integer('life_shelf');
            $table->string('duration')->length(20)->nullable();
            $table->integer('unit_id');
            $table->float('unit_price', 8, 2);
            $table->string('image')->length(20)->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('exported');
            $table->integer('uploaded');
            $table->integer('updated');
            $table->string('subscriber_code')->length(10);
            $table->string('branch_code')->length(10);
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
        Schema::dropIfExists('materials');
    }
}
