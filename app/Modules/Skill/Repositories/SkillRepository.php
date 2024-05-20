<?php

declare(strict_types=1);

namespace App\Modules\Skill\Repositories;

use App\Modules\Skill\Models\Skill;
use DrDerpling\DirectusRepository\Api\Directus;
use DrDerpling\DirectusRepository\Factories\ContextFactory;
use DrDerpling\DirectusRepository\Repositories\Context;
use DrDerpling\DirectusRepository\Repositories\DirectusRepository;
use Illuminate\Support\Collection;
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
        return ContextFactory::create(Skill::class);
    }

    protected function prepareData(array $data): Collection
    {
        $item = collect($data);
        $item->put('cms_id', $data['id']);

        $disk = Storage::disk('public');
        $fileName = 'skills/' . Str::slug($item->get('name')) . '.webp'; // Don't really care if this overwrites

        Directus::collection('assets')
            ->addQueryParameter('fit', 'inside')
            ->addQueryParameter('width', '100')
            ->addQueryParameter('height', '100')
            ->addQueryParameter('quality', ' 100')
            ->addQueryParameter('format', 'webp')
            ->addQueryParameter('download', '1')
            ->download($item->get('logo', ''), $disk, $fileName);

        $item->put('logo', $fileName);

        return $item;
    }
}
