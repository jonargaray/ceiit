<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_tables', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->integer('table_id');
            $table->timestamps('last_exported_at');
            $table->date('last_updated_at');
            $table->string('export_status')->length(10);
            $table->string('import_status')->length(10);
            $table->integer('uploaded');
            $table->timestamps();
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
        Schema::dropIfExists('branch_tables');
    }
}
