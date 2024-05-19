<?php

declare(strict_types=1);

namespace App\Modules\Project\Services;

use App\Modules\CMSIntegration\Api\Directus;
use App\Modules\CMSIntegration\Services\CMSDataService;
use App\Modules\Framework\AbstractDataObject;
use App\Modules\Project\DataObjects\Project as ProjectDataObject;
use App\Modules\Project\Models\Project;
use App\Modules\Project\Repositories\ProjectRepository;
use Illuminate\Support\Facades\Storage;
use Str;

class ProjectService extends CMSDataService
{
    public function __construct(
        private readonly ProjectRepository $projectRepository,
    ) {
        parent::__construct($projectRepository);
    }

    /**
     * @param AbstractDataObject $item
     * @return Project
     */
    protected function saveItem(AbstractDataObject $item): Project
    {
        $item->set('cms_id', $item->get('id'));
        $item->set('url', $item->get('url') ?? '');

        return $this->projectRepository->updateOrCreate($item->toArray());
    }

    /**
     * @param int|null $id
     * @return Project[]|Project
     */
    protected function getFromDirectus(int $id = null)
    {
        if ($id === null) {
            $data = Directus::collection('projects')->get();

            $items = array_map(function ($item) {
                return $this->createDataObject($item);
            }, $data);

            /** @var Project[] $items */
            $items = $this->saveItems($items);

            return $items;
        }

        $data = Directus::collection('projects')->find($id);
        $item = $this->createDataObject($data);

        return $this->saveItem($item);
    }

    private function createDataObject(array $data): ProjectDataObject
    {
        $item = new ProjectDataObject($data);

        $disk = Storage::disk('public');
        $fileName = 'projects/' . Str::slug($item->getName()) . '.webp'; // Don't really care if this overwrites

        Directus::collection('assets')
            ->addQueryParameter('fit', 'cover')
            ->addQueryParameter('width', '500')
            ->addQueryParameter('height', '300')
            ->addQueryParameter('quality', ' 100')
            ->addQueryParameter('format', 'webp')
            ->addQueryParameter('download', '1')
            ->download($item->getHero(), $disk, $fileName);

        $item->set('image', $fileName);

        return $item;
    }
}
