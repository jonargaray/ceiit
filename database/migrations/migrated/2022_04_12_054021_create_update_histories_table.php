<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_table_id');
            $table->string('status');
            $table->timestamps();
            $table->integer('exported');
            $table->integer('uploaded');
            $table->integer('updated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('update_histories');
    }
}
