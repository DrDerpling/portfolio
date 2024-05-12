<?php

declare(strict_types=1);

namespace App\Modules\Project\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
        'link',
        'image',
        'start_date',
        'end_date',
    ];
}
