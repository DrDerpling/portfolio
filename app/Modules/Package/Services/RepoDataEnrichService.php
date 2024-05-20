<?php

declare(strict_types=1);

namespace App\Modules\Package\Services;

use Arr;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class RepoDataEnrichService
{
    public function enrich(Collection $packageData): Collection
    {
        $gitUrl = $packageData->get('git_url', '');
        $repoData = $this->getRepoData($gitUrl);
        $releaseData = $this->getReleasesData($gitUrl);
        $commitsData = $this->getCommitsData($gitUrl);
        $downloadsData = $this->getDownloadCount($gitUrl, $releaseData);

        $packageData->put('releases', $releaseData->count());
        $packageData->put('commits', $commitsData->count());
        $packageData->put('last_commit', Carbon::parse(Arr::get($commitsData->first(), 'commit.author.date')));
        $packageData->put('version', Arr::get($releaseData->first(), 'name'));
        $packageData->put('stars', (int)$repoData->get('stargazers_count'));
        $packageData->put('downloads', $downloadsData);

        return $packageData;
    }

    /**
     * @param string $gitUrl
     * @return Collection
     * @throws ConnectionException
     * @throws RequestException
     */
    public function getRepoData(string $gitUrl): Collection
    {
        $url = sprintf('%s/repos/%s', config('integration.github.base_uri'), $this->getRepoOwnerString($gitUrl));

        $response = Http::withToken(config('integration.github.bearer_token'))
            ->get($url)->throw()->json();

        return new Collection($response);
    }

    private function getRepoOwnerString(string $gitUrl): string
    {
        $path = parse_url($gitUrl, PHP_URL_PATH);
        $owner = Arr::get(explode('/', $path), 1);
        $repo = Arr::get(explode('/', $path), 2);
        $repo = str_replace('.git', '', $repo);

        return sprintf('%s/%s', $owner, $repo);
    }

    private function getCommitsData(string $gitUrl): Collection
    {
        $url = sprintf(
            '%s/repos/%s/commits',
            config('integration.github.base_uri'),
            $this->getRepoOwnerString($gitUrl)
        );

        /** @var array $response */
        $response = Http::withToken(config('integration.github.bearer_token'))
            ->get($url)->throw()->json();

        return collect($response);
    }

    public function getReleasesData(string $gitUrl): Collection
    {
        $url = sprintf(
            '%s/repos/%s/releases',
            config('integration.github.base_uri'),
            $this->getRepoOwnerString($gitUrl)
        );

        /** @var array $response */
        $response = Http::withToken(config('integration.github.bearer_token'))
            ->get($url)->throw()->json();


        return collect($response);
    }

    public function getDownloadCount(string $gitUrl, Collection $releases): int
    {
        $repoOwnerString = $this->getRepoOwnerString($gitUrl);
        $totalDownloads = 0;

        foreach ($releases as $release) {
            $url = sprintf(
                '%s/repos/%s/releases/%s/assets',
                config('integration.github.base_uri'),
                $repoOwnerString,
                $release['id']
            );

            /** @var array $response */
            $response = Http::withToken(config('integration.github.bearer_token'))
                ->get($url);

            $totalDownloads  += collect($response)->sum('download_count');
        }

        return $totalDownloads;
    }
}
