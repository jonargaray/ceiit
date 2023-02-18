<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informations', function (Blueprint $table) {
            $table->id();
            $table->integer('bakery_id');
            $table->text('term_condition')->length(1000);
            $table->text('privacy_policy')->length(1000);
            $table->text('contact_us')->length(1000);
            $table->text('about_us')->length(1000);
            $table->text('overview')->length(1000);
            $table->text('created_by')->length(1000);
             $table->text('updated_by')->length(1000);
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
        Schema::dropIfExists('information');
    }
}
