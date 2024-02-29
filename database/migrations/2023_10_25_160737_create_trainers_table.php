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
        Schema::create('trainers', function (Blueprint $table) {
            $table->id(); 
            $table->string('name'); 
            $table->string('phone')->nullable(); 
            $table->string('spec'); 
            $table->string('img'); 
            // $table->unsigendBigIntger('cat_id') ;  
            // $table->forign('cat_id')->references('id')->on('cats')  ; 
            // $table->unsigendBigIntger('trainer_id') ;  
            // $table->forign('trainer_id')->references('id')->on('trainers')  ; 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainers');
    }
};
