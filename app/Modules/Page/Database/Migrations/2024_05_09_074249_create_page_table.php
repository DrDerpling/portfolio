<?php

declare(strict_types=1);

use App\Modules\CMSIntegration\Enums\StatusEnum;
use App\Modules\Page\Types\PageTypes;
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
        Schema::create('page', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('page_type')->default(PageTypes::CONTENT)
                ->comment('Is used to determine the blade template to render the page.');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->string('status')->default(StatusEnum::DRAFT);
            $table->integer('cms_id')->index()->comment('CMS ID for the page');
            $table->timestamps();
        });

        if (Schema::hasTable('link_items')) {
            Schema::table('link_items', function (Blueprint $table) {
                $table->foreignId('page_id')->nullable()->constrained('page')->nullOnDelete();
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
                $table->dropForeign(['page_id']);
                $table->dropColumn('page_id');
            });
        }

        Schema::dropIfExists('page');
    }
};
