<?php

use Illegal\LaravelAI\Models\Chat;
use Illegal\LaravelAI\Models\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(Chat::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Model::class)->constrained(Model::getTableName());
            $table->string('external_id')->nullable();
            $table->json('messages')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Chat::getTableName());
    }
};
