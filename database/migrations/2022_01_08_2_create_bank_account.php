<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccount extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('BankAcc', function (Blueprint $table) {
            $table->string('bankCard')->primary();
            $table->string('bankName');
            $table->string('bankCvv');
            $table->string('bankExpired');
            $table->bigInteger('bankBalance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('BankAcc');
    }
}
