<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('progress', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('completed_at');  // Status para validação
            $table->text('submission')->nullable()->after('status');  // Submissão do aluno (ex.: texto ou JSON)
            $table->text('feedback')->nullable()->after('submission');  // Feedback do professor
        });
    }

    public function down() {
        Schema::table('progress', function (Blueprint $table) {
            $table->dropColumn(['status', 'submission', 'feedback']);
        });
    }
};