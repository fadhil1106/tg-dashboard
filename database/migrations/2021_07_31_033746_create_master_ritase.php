<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterRitase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_ritase', function (Blueprint $table) {
            $table->id();
            $table->date('ritase_date');
            $table->bigInteger('ritase_ti');
            $table->bigInteger('ritase_tm');
            $table->string('ritase_comment');
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
        Schema::dropIfExists('master_ritase');
    }
}
