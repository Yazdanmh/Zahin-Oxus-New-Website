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
        Schema::create('m_o_u_s', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->longText('description'); 
            $table->text('parties_involved'); 
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('mou_file'); 
            $table->string('status'); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_o_u_s');
    }
};
