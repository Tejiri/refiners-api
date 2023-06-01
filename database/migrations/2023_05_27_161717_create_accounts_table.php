<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->decimal("shareCapital", 65, 2);
            $table->decimal("thriftSavings", 65, 2);
            $table->decimal("specialDeposit", 65, 2);
            $table->decimal("commodityTrading", 65, 2);
            $table->decimal("fine", 65, 2);
            $table->decimal("loan", 65, 2);
            $table->decimal("projectFinancing", 65, 2);
            $table->unsignedBigInteger('userId');
            $table->foreign("userId")->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
