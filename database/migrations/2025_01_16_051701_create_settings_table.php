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
    Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->string('site_name')->nullable();
        $table->string('site_logo')->nullable();
        $table->string('site_favicon')->nullable();
        $table->string('email')->nullable();
        $table->string('phone')->nullable();
        $table->string('address')->nullable();
        $table->text('about')->nullable();
        $table->string('facebook_url')->nullable();
        $table->string('twitter_url')->nullable();
        $table->string('instagram_url')->nullable();
        $table->string('linkedin_url')->nullable();
        $table->string('youtube_url')->nullable();
        $table->boolean('maintenance_mode')->default(false);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
