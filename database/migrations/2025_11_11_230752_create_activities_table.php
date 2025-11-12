<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up() {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['syllables', 'words', 'phrases']);
            $table->json('items');
            $table->enum('level', ['easy', 'medium', 'hard'])->default('easy');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('activities');
    }
};
