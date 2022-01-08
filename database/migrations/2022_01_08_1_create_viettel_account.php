<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViettelAccount extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('ViettelAcc', function (Blueprint $table) {
            $table->string('viettelPhone')->primary();
            $table->string('viettelPassword');
            $table->bigInteger('viettelBalance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('ViettelAcc');
    }
}
