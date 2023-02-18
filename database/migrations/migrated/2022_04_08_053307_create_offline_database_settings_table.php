<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfflineDatabaseSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offline_database_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->integer('last_updated_at');
            $table->integer('update_status');
            $table->timestamps();
            $table->datetime('last_export');
            $table->float('export_percentage');
            $table->string('remember_toke')->length(10);
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
        Schema::dropIfExists('offline_database_settings');
    }
}
