<?php

declare(strict_types=1);

namespace App\Modules\Skill\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'logo',
        'proficiency',
        'cms_id',
    ];
}
