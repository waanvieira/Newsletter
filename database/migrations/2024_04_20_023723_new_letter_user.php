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
        Schema::create('newletter_user', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->uuid('newletter_id')->index();
            $table->foreign('newletter_id')->references('id')->on('news_letters');
            $table->unique(['user_id', 'newletter_id']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newletter_user');
    }
};
