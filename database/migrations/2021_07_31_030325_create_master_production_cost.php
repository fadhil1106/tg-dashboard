<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterProductionCost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_production_cost', function (Blueprint $table) {
            $table->id();
            $table->date('production_cost_date');
            $table->bigInteger('production_cost_ti');
            $table->bigInteger('production_cost_tm');
            $table->string('production_cost_comment');
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
        Schema::dropIfExists('master_production_cost');
    }
}
