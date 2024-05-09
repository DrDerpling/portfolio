<?php

declare(strict_types=1);

namespace App\Modules\Page\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @property int $id
 * @property string $slug
 * @property string $content
 * @property string $status
 * @property int $cms_id CMS ID for the page
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCmsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page wherePageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereName($value)
 * @property string $type Is used to determine the blade template to render the page.
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereType($value)
 * @mixin \Eloquent
 */
class Page extends Model
{
    protected $fillable = [
        'name',
        'content',
        'status',
        'sort',
        'slug',
        'cms_id',
        'type'
    ];

    protected $casts = [
        'sort' => 'integer',
    ];
}
