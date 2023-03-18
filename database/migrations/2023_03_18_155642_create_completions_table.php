<?php

use Illegal\LaravelAI\Models\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('completions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Model::class)->constrained();
            $table->string('external_id');
            $table->string('prompt');
            $table->string('answer');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('completions');
    }
};
