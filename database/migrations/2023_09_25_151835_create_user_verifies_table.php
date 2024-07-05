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
        //create table
        Schema::create('user_verifies', function (Blueprint $table) {
            $table->integer('user_id'); 
            $table->string('token'); 
            $table->timestamps();
        });

        //alter table
        Schema::table('users', function(Blueprint $table){
            $table->boolean('is_email_verified')->default(0); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_verifies');
    }
};
