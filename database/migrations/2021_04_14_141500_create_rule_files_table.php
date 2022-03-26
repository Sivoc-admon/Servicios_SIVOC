<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuleFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rule_files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rule_id')->unsigned();
            $table->foreign('rule_id')
            ->references('id')
            ->on('rules')
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
        Schema::dropIfExists('rule_files');
    }
}
