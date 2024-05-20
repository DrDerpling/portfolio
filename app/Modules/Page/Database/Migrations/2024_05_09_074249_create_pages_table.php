<?php

declare(strict_types=1);

use App\Modules\Page\Types\PageTypes;
use Drderpling\DirectusRepository\Enums\StatusEnum;
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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->default(PageTypes::CONTENT)
                ->comment('Is used to determine the blade template to render the page.');
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            $table->string('status')->default(StatusEnum::DRAFT);
            $table->integer('cms_id')->index()->comment('CMS ID for the page');
            $table->timestamps();
        });

        if (Schema::hasTable('link_items')) {
            Schema::table('link_items', function (Blueprint $table) {
                $table->foreignId('page_id')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('link_items')) {
            Schema::table('link_items', function (Blueprint $table) {
                $table->dropColumn('page_id');
            });
        }

        Schema::dropIfExists('pages');
    }
};
