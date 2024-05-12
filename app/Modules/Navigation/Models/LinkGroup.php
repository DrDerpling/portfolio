<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class LinkGroup
 *
 * @package App\Modules\Navigation\Models
 * @property string $name
 * @property int $id
 * @property string $status
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Navigation\Models\LinkItem> $children
 * @property-read int|null $children_count
 * @method static \Illuminate\Database\Eloquent\Builder|LinkGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LinkGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LinkGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|LinkGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkGroup whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkGroup whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkGroup whereUpdatedAt($value)
 * @property int $cms_id CMS ID for the link group
 * @method static \Illuminate\Database\Eloquent\Builder|LinkGroup whereCmsId($value)
 * @mixin \Eloquent
 */
class LinkGroup extends Model
{
    protected $fillable = [
        'name',
        'status',
        'sort',
        'cms_id',
    ];

    protected $casts = [
        'sort' => 'integer',
    ];

    public function children(): HasMany
    {
        return $this->hasMany(LinkItem::class, 'parent_id');
    }

    public function hasActiveChildren(): bool
    {
        foreach ($this->children as $child) {
            if ($child->is_active) {
                return true;
            }
        }

        return false;
    }
}
