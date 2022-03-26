<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalAuditFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_audit_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('ruta');
            $table->unsignedInteger('internal_audits_id')->unsigned();
            $table->foreign('internal_audits_id')
                ->references('id')
                ->on('internal_audits')
                ->onDelete('cascade');
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
        Schema::dropIfExists('internal_audit_files');
    }
}
