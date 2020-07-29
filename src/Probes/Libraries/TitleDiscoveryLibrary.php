<?php

namespace webProbe\Probes\Libraries;

use ScrapeElementNotFound;
use webProbe\Probes\Helpers\ScraperHelper;

class TitleDiscoveryLibrary
{
    /** @var string */
    private $page;

    public function __construct(string $page)
    {
        $this->page = $page;
    }

    public function findTitle():? string
    {
        try {
            $body = ScraperHelper::readAfter('<title"', $this->page, true);
            return trim(ScraperHelper::readBetween('>', '<', $body, true));
        } catch (ScrapeElementNotFound $exception) {
            return null;
        }
    }
}