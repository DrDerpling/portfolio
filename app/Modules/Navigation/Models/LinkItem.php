<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Models;

use App\Modules\Page\Models\Page;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string|null $icon
 * @property string $slug
 * @property string $status
 * @property int $sort
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $page_id
 * @method static \Illuminate\Database\Eloquent\Builder|LinkItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LinkItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LinkItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|LinkItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkItem whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkItem wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkItem whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkItem whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkItem whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkItem whereUpdatedAt($value)
 * @property int $cms_id CMS ID for the link item
 * @property-read \App\Modules\Navigation\Models\LinkGroup|null $linkGroup
 * @property-read Page|null $page
 * @method static \Illuminate\Database\Eloquent\Builder|LinkItem whereCmsId($value)
 * @property bool $is_active
 * @mixin \Eloquent
 */
class LinkItem extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'slug',
        'status',
        'sort',
        'parent_id',
        'page_id',
        'cms_id',
    ];

    public function getUrl(): string
    {
        if ($this->slug === 'home') {
            return URL::to('/');
        }

        return route('navigation.link', ['any' => $this->slug]);
    }

    public function isActive(): Attribute
    {
        return Attribute::make(
            get: fn(?bool $value) => $value !== null ? $value : $this->computeActive(),
            set: static fn(bool $value) => $value,
        );
    }

    private function computeActive(): bool
    {
        // Get path from the current request
        $currentRoute = Request::capture()->path();

        if ($currentRoute === '/') {
            $currentRoute = 'home';
        }

        return $this->slug === $currentRoute;
    }

    public function linkGroup(): BelongsTo
    {
        return $this->belongsTo(LinkGroup::class);
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
