<?php

declare(strict_types=1);

namespace App\Modules\Skill\Services;

use App\Modules\CMSIntegration\Services\DirectusApi;
use App\Modules\Skill\DataObjects\SkillDataObject;
use App\Modules\Skill\Models\Skill;
use App\Modules\Skill\Repositories\SkillRepository;
use GuzzleHttp\Exception\GuzzleException;

class SkillService
{
    public function __construct(
        private readonly SkillRepository $skillRepository,
        private readonly DirectusApi $directusApi
    ) {
    }

    /**
     * @param bool $forceNew
     * @return Skill[]
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function getSkills(bool $forceNew = false): array
    {
        if ($forceNew) {
            return $this->getFromDirectus();
        }

        $items = $this->skillRepository->getList();

        if ($items->isEmpty()) {
            return $this->getFromDirectus();
        }

        /** @var Skill[] $result */
        $result = $items->all();

        return $result;
    }

    /**
     * @param SkillDataObject[] $items
     * @return Skill[]
     */
    private function saveItems(array $items): array
    {
        $result = [];

        foreach ($items as $item) {
            $result[] = $this->saveItem($item);
        }

        return $result;
    }

    /**
     * @param SkillDataObject $item
     * @return Skill
     */
    private function saveItem(SkillDataObject $item): Skill
    {
        $item->set('cms_id', $item->get('id'));

        return $this->skillRepository->updateOrCreate($item->toArray());
    }

    /**
     * @return Skill[]
     * @throws GuzzleException
     * @throws \JsonException
     */
    private function getFromDirectus(): array
    {
        $directusItems = $this->directusApi->getItems('skills');

        $directusItems = array_map(function (array $item) {
            return new SkillDataObject($item);
        }, $directusItems);

        return $this->saveItems($directusItems);
    }
}
