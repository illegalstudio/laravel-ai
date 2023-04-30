<?php

use Illegal\LaravelAI\Models\Completion;
use Illegal\LaravelAI\Models\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(Completion::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Model::class)->constrained(Model::getTableName());
            $table->string('external_id')->nullable();
            $table->string('prompt');
            $table->string('answer');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Completion::getTableName());
    }
};
