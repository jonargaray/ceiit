<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCapabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_capabilities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->text('menus', 500);
            $table->text('capabilities', 500);
            $table->integer('exported');
            $table->string('subscriber_code', 20);
            $table->string('branch_code', 20);
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
        Schema::dropIfExists('user_capabilities');
    }
}
