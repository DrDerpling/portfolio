<?php

declare(strict_types=1);

namespace App\Modules\Package\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name',
        'image',
        'sort',
        'url'
    ];
}
