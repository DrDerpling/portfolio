<?php

declare(strict_types=1);

namespace App\Modules\Page\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @mixin \Eloquent
 */
class Page extends Model
{
    protected $fillable = [
        'title',
        'content',
        'status',
        'sort',
    ];

    protected $casts = [
        'sort' => 'integer',
    ];
}
