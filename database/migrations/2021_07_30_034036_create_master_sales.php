<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_sales', function (Blueprint $table) {
            $table->id();
            $table->date('sales_date');
            $table->bigInteger('sales_quantity_ti');
            $table->bigInteger('sales_ti');
            $table->bigInteger('sales_quantity_tm');
            $table->bigInteger('sales_tm');
            $table->string('sales_comment');
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
        Schema::dropIfExists('master_sales');
    }
}
