<?php

declare(strict_types=1);

namespace App\Modules\Project\Services;

use App\Modules\CMSIntegration\Api\Directus;
use App\Modules\CMSIntegration\Services\CMSDataService;
use App\Modules\Framework\AbstractDataObject;
use Illuminate\Database\Eloquent\Model;

class ProjectService extends CMSDataService
{
    protected function saveItem(AbstractDataObject $item): Model
    {
        $item->set('cms_id', $item->get('id'));

        return $this->repository->updateOrCreate($item->toArray());
    }

    protected function getFromDirectus(int $id = null): array
    {
        if ($id === null) {
            return Directus::collection('projects')->get();
        }

        return Directus::collection('projects')->find($id);
    }
}
