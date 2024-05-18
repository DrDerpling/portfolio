<?php

declare(strict_types=1);

namespace App\Modules\FeatherIcons\View\Components;

use DOMDocument;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class FeatherIcon extends Component
{
    public function __construct(
        public string $name,
    ) {
    }

    public function render(): View
    {
        $iconStorage = Storage::disk('featericons');
        $iconContent = $iconStorage->get($this->name . '.svg');

        if ($iconContent === null) {
            return $this->renderIconNotFound();
        }

        $extractedSvgContents = $this->extractSvgContents($iconContent);

        // TODO: Handle the case when the SVG file is not valid for now we will return the icon not found view
        if ($extractedSvgContents === null) {
            return $this->renderIconNotFound();
        }

        return view('feathericons.icon', [
            'icon' => $extractedSvgContents,
        ]);
    }

    private function extractSvgContents(string $svgContent): ?string
    {
        $dom = new DOMDocument();
        $dom->loadXML($svgContent);
        $svg = $dom->getElementsByTagName('svg')->item(0);

        if ($svg === null) {
            return null;
        }

        $innerSVG = '';
        foreach ($svg->childNodes as $child) {
            $innerSVG .= $dom->saveHTML($child);
        }
        return $innerSVG;
    }

    private function renderIconNotFound(): View
    {
        return view('feathericons.icon-not-found', [
            'iconName' => $this->name,
        ]);
    }
}
