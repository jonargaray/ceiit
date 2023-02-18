<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->integer('subscriber_id');
            $table->integer('barangay_id');
            $table->integer('street');
            $table->string('contact_num');
            $table->integer('main');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->string('subscriber_code')->lenght(10);
            $table->string('branch_code')->lenght(10);
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
        Schema::dropIfExists('branches');
    }
}
