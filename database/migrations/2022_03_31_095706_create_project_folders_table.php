<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_folders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id')->unsigned();
            $table->foreign('project_id')
            ->references('id')
            ->on('projects')
            ->onDelete('cascade');
            $table->string('name', 250);
            $table->integer('id_padre');
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
        Schema::dropIfExists('project_folders');
    }
}
