<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->integer('subscriber_id');
            $table->string('supplier')->length(100);
            $table->string('street')->length(100)->nullable();
            $table->integer('barangay_id');
            $table->string('contact_num')->length(100)->nullable();
            $table->string('contact_person')->length(100)->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
