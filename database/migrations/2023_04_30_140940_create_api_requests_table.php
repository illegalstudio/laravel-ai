<?php

use Illegal\LaravelAI\Models\ApiRequest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(ApiRequest::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->nullable();
            $table->integer('usage_prompt_tokens')->default(0);
            $table->integer('usage_completion_tokens')->default(0);
            $table->integer('usage_total_tokens')->default(0);
            $table->nullableMorphs('requestable');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(ApiRequest::getTableName());
    }
};
