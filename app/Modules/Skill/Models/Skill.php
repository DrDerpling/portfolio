<?php

declare(strict_types=1);

namespace App\Modules\Skill\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Skill
 * @package App\Modules\Skill\Models
 * @property string $name
 * @property string $logo
 * @property int $proficiency
 * @property int $cms_id
 */
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
