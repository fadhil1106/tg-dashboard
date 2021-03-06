<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterFuel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_fuel', function (Blueprint $table) {
            $table->id();
            $table->date('fuel_date');
            $table->bigInteger('fuel_ti');
            $table->bigInteger('fuel_tm');
            $table->string('fuel_comment');
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
        Schema::dropIfExists('master_fuel');
    }
}
