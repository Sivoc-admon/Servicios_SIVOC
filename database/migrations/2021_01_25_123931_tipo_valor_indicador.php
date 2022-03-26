<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TipoValorIndicador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indicator_type', function (Blueprint $table) {
           
            $table->decimal('min', 8, 2)->change();
            $table->decimal('max', 8, 2)->change();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('indicator_type', function (Blueprint $table) {
           
            $table->dropColumn('min', 8, 2);
            $table->dropColumn('max', 8, 2);
           
        });*/
        
    }
}
