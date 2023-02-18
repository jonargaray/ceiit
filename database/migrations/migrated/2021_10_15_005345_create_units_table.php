<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('unit')->length('50');
            $table->string('description')->length('50')->nullable();
            $table->integer('subscriber_id');
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
        Schema::dropIfExists('units');
    }
}
