<?php

declare(strict_types=1);

namespace App\Modules\Skill\Services;

use App\Modules\CMSIntegration\Services\CMSDataService;
use App\Modules\Framework\AbstractDataObject;
use App\Modules\Skill\DataObjects\SkillDataObject;
use App\Modules\Skill\Models\Skill;
use App\Modules\Skill\Repositories\SkillRepository;

class SkillService extends CMSDataService
{
    public function __construct(
        private readonly SkillRepository $skillRepository,
    ) {
        parent::__construct($skillRepository);
    }

    /**
     * @param SkillDataObject $item
     * @return Skill
     */
    protected function saveItem(AbstractDataObject $item): Skill
    {
        $item->set('cms_id', $item->get('id'));

        return $this->skillRepository->updateOrCreate($item->toArray(), Skill::class);
    }

    /**
     * @param int|null $id
     * @return Skill[]
     */
    protected function getFromDirectus(int $id = null): array
    {
        $directusItems = $this->fetchFromDirectus('skills');

        $directusItems = array_map(function (array $item) {
            return new SkillDataObject($item);
        }, $directusItems);

        /** @var Skill[] $items */
        $items = $this->saveItems($directusItems);

        return $items;
    }
}
