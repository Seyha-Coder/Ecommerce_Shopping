<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *  @return void
     */
   
    //where to create table
    public function up(): void
    {
        //
        Schema::table('categories', function (Blueprint $table) {
            // $table->renameColumn('name', 'updated_name');// Renaming "name" to "updated_name"
            // $table->string('description',255)->change(); // Change Datatype length
            // $table->dropColumn('others'); // Remove "others" field
            // $table->smallInteger('status')->after('others'); // Add "status" column
    
    });
        
    }

    /**
     * Reverse the migrations.
     */
    //where to drop table
    public function down(): void
    {
        //
    }
};
