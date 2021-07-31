<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterSpareparts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_spareparts', function (Blueprint $table) {
            $table->id();
            $table->date('spareparts_date');
            $table->bigInteger('spareparts_ti');
            $table->bigInteger('spareparts_tm');
            $table->string('spareparts_comment');
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
        Schema::dropIfExists('master_spareparts');
    }
}
