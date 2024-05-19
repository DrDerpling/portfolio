<?php

declare(strict_types=1);

namespace App\Modules\Project\Models;

use App\Modules\Skill\Models\Skill;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**

 * @property-read \Illuminate\Database\Eloquent\Collection<int, Skill> $skills
 * @property-read int|null $skills_count
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @property int $id
 * @property string $name
 * @property string $short_description
 * @property string $image
 * @property string $url
 * @property string $status
 * @property string $content
 * @property int $cms_id CMS ID for the project
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCmsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUrl($value)
 * @mixin \Eloquent
 */
class Project extends Model
{
    protected $fillable = [
        'name',
        'short_description',
        'image',
        'url',
        'status',
        'content',
        'cms_id',
        'sort',
    ];

    protected $casts = [
        'cms_id' => 'integer',
        'sort' => 'integer',
    ];

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }
}
