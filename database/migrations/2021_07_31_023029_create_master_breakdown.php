<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterBreakdown extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_breakdown', function (Blueprint $table) {
            $table->id();
            $table->date('breakdown_date');
            $table->bigInteger('breakdown_ti');
            $table->bigInteger('breakdown_tm');
            $table->string('breakdown_comment');
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
        Schema::dropIfExists('master_breakdown');
    }
}
