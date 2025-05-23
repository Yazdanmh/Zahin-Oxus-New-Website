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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade'); // Foreign key
            $table->string('name');
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->date('start_date')->nullable(); 
            $table->date('end_date')->nullable();
            $table->boolean('has_form')->nullable(); 
            $table->string('slug')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
