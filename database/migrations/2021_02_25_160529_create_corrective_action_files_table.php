<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrectiveActionFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corrective_action_files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('corrective_action_id')->unsigned();
            $table->foreign('corrective_action_id')
            ->references('id')
            ->on('corrective_actions')
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
        Schema::dropIfExists('corrective_action_files');
    }
}
