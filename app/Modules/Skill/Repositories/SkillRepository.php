<?php

declare(strict_types=1);

namespace App\Modules\Skill\Repositories;

use App\Modules\CMSIntegration\Api\Directus;
use App\Modules\CMSIntegration\Repositories\Context;
use App\Modules\CMSIntegration\Repositories\DirectusRepository;
use App\Modules\Framework\DataObject;
use App\Modules\Skill\Models\Skill;
use Illuminate\Support\Facades\Storage;
use Str;

class SkillRepository extends DirectusRepository
{
    /**
     * @param int[] $cmsIds
     * @return int[]
     */
    public function getSkillIds(array $cmsIds): array
    {
        return $this->getModelQuery()->whereIn('cms_id', $cmsIds)->pluck('id', 'cms_id')->toArray();
    }

    public function getContext(): Context
    {
        return new Context(Skill::class);
    }

    protected function prepareData(array $data): DataObject
    {
        $item = new DataObject($data);
        $item->set('cms_id', $data['id']);

        $disk = Storage::disk('public');
        $fileName = 'skills/' . Str::slug($item->get('name')) . '.webp'; // Don't really care if this overwrites

        Directus::collection('assets')
            ->addQueryParameter('fit', 'inside')
            ->addQueryParameter('width', '100')
            ->addQueryParameter('height', '100')
            ->addQueryParameter('quality', ' 100')
            ->addQueryParameter('format', 'webp')
            ->addQueryParameter('download', '1')
            ->download($item->get('logo'), $disk, $fileName);

        $item->set('logo', $fileName);

        return $item;
    }
}
