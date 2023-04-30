<?php

use Illegal\LaravelAI\Models\Completion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table(Completion::getTableName(), function (Blueprint $table) {
            $table->text('prompt')->change();
            $table->text('answer')->change();
        });
    }

    public function down(): void
    {
        Schema::table(Completion::getTableName(), function (Blueprint $table) {
            $table->string('prompt')->change();
            $table->string('answer')->change();
        });
    }
};
