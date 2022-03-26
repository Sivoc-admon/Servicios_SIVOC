<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWelcomeFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('welcome_files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('welcome_id')->unsigned();
            $table->foreign('welcome_id')
            ->references('id')
            ->on('welcome')
            ->onDelete('cascade');
            $table->string('name', 150);
            $table->string('ruta');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('welcome_files');
    }
}
