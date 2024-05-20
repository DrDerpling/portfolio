<?php

declare(strict_types=1);

namespace App\Modules\Package\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string|null $image
 * @property string|null $version
 * @property int $downloads
 * @property int $stars
 * @property int|null $releases
 * @property int|null $commits
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package query()
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereCommits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereDownloads($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereLastCommit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereReleases($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereStars($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereImage($value)
 * @property \Illuminate\Support\Carbon|null $last_commit
 * @property string|null $git_url
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereGitUrl($value)
 * @property int $cms_id
 * @property int $sort
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereCmsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereSort($value)
 * @mixin \Eloquent
 */
class Package extends Model
{
    protected $fillable = [
        'name',
        'url',
        'image',
        'version',
        'downloads',
        'stars',
        'releases',
        'commits',
        'last_commit',
        'git_url',
        'cms_id',
        'sort'
    ];

    protected $casts = [
        'downloads' => 'int',
        'stars' => 'int',
        'releases' => 'int',
        'commits' => 'int',
        'last_commit' => 'datetime'
    ];
}
