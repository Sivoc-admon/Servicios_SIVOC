<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgreementFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreement_files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('minute_id')->unsigned();
            $table->foreign('minute_id')
            ->references('id')
            ->on('minutes')
            ->onDelete('cascade');
            $table->string('file');
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
        Schema::dropIfExists('agreement_files');
    }
}
