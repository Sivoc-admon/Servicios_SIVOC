<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_requisitions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('num_item')->unsigned();
            $table->integer('id_classification')->unsigned();
            $table->integer('id_requisition')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->string('unit', 50);
            $table->string('description', 250);
            $table->string('model', 250);
            $table->string('preference', 250);
            $table->string('urgency', 50);
            $table->string('status', 50);
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
        Schema::dropIfExists('detail_requisitions');
    }
}
