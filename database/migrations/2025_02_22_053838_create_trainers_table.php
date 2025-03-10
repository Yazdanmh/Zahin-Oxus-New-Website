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
            $table->string('position');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->json('skills')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('show_on_home')->default(false);
            $table->foreignId('service_id')   
                ->nullable()                 
                ->constrained('services')     
                ->onDelete('set null');       
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
