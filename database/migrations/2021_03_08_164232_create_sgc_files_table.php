<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSgcFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sgc_files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sgc_id')->unsigned();
            $table->foreign('sgc_id')
                ->references('id')
                ->on('sgc')
                ->onDelete('cascade');
            $table->string('name', 100);
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
        Schema::dropIfExists('sgc_files');
    }
}
