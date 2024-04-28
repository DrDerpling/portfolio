<?php

declare(strict_types=1);

namespace App\Domains\BaseDomain\Services;

use App\Domains\BaseDomain\Exceptions\AppDomainNotFound;
use Exception;
use InvalidArgumentException;

class DomainDirectoryService
{
    public const DOMAIN_PATH = 'app/Domains/';

    /**
     * returns an array of domain paths if the domains directory exists
     *
     * @return array|null
     * @throws AppDomainNotFound
     * @throws InvalidArgumentException
     */
    public function listDomainPaths(): ?array
    {
        $baseDomainPath = base_path(self::DOMAIN_PATH);

        if (!file_exists($baseDomainPath)) {
            throw new AppDomainNotFound('app/Domains directory not found. Please create it.');
        }

        $domains = $this->getFolderContents($baseDomainPath);
        /** @var string[] $domainPaths */
        $domainPaths = [];


        foreach ($domains as $domain) {
            $domainPath = base_path(self::DOMAIN_PATH) .  $domain;

            if (!is_dir($domainPath)) {
                continue;
            }

            $domainPaths[] = $domainPath;
        }

        return $domainPaths;
    }

    public function getFolderContents(string $path): array
    {
        if (!is_dir($path)) {
            throw new InvalidArgumentException('Path is not a directory');
        }

        return array_diff(scandir($path), ['.', '..']);
    }

    public function getCurrentDomainPath(string $path): string
    {
        $pathPart = explode('/', $path);
        $appKey = array_search('app', $pathPart);

        if ($appKey === false) {
            throw new Exception('App directory not found in path');
        }

        $pathPart = array_slice($pathPart, $appKey);
        $pathPart = array_slice($pathPart, 0, 3);

        return implode('/', $pathPart);
    }
}
