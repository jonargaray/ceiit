<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_suppliers', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->integer('supplier_id');
            $table->integer('created_');
            $table->integer('updated_id');
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
        Schema::dropIfExists('branch_suppliers');
    }
}
