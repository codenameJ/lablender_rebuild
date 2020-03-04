<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('tas', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->timestamps();
        // });

        Schema::table('tas', function (Blueprint $table) {
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
        Schema::dropIfExists('tas');
    }
}
