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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('training_id'); 
            $table->string('certificate_code')->unique(); 
            $table->string('certificate_name');
            $table->date('issue_date');
            $table->string('for_who'); 
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
