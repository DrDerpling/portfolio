<?php

declare(strict_types=1);

use Drderpling\DirectusRepository\Enums\StatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('link_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('slug')->unique();
            $table->string('status')->default(StatusEnum::DRAFT);
            $table->integer('sort')->default(0);
            $table->foreignId('parent_id')->nullable()->constrained('link_groups')->nullOnDelete();
            $table->integer('cms_id')->index()->comment('CMS ID for the link item');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_items');
    }
};
