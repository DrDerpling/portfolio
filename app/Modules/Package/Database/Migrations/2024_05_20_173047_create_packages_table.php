<?php

declare(strict_types=1);

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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->string('git_url')->nullable();
            $table->string('image')->nullable();
            $table->string('version')->nullable();
            $table->integer('downloads')->default(0);
            $table->integer('stars')->default(0);
            $table->integer('releases')->default(0);
            $table->integer('commits')->default(0);
            $table->integer('cms_id')->index();
            $table->integer('sort')->default(0);
            $table->timestamp('last_commit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
