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
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('role');
            $table->date('dateOfBirth');
            $table->string('title');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('middleName');
            $table->string('accountStatus');
            $table->string('loanAppicationStatus')->nullable();
            $table->string('phoneNumber');
            $table->string('address');
            $table->string('gender');
            $table->string('occupation');
            $table->string('nextOfKinName');
            $table->string('nextOfKinAddress');
            $table->string('nextOfKinPhoneNumber');
            $table->string('bank')->nullable();
            $table->string('accountNumber')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
