<?php

use Illegal\LaravelAI\Models\Image;
use Illegal\LaravelAI\Models\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(Image::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Model::class)->nullable()->constrained(Model::getTableName());
            $table->string('external_id')->nullable();
            $table->string('prompt');
            $table->integer('width');
            $table->integer('height');
            $table->text('url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Image::getTableName());
    }
};
