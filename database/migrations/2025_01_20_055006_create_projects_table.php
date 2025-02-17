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
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); 
            $table->string('name'); 
            $table->longText('description'); 
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('image')->nullable(); 
            $table->string('slug');
            $table->timestamps(); 
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
