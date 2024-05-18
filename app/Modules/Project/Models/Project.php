<?php

declare(strict_types=1);

namespace App\Modules\Project\Models;

use App\Modules\Skill\Models\Skill;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
