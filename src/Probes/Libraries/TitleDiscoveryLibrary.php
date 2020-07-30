<?php

namespace webProbe\Probes\Libraries;

use webProbe\Probes\Exceptions\ScrapeElementNotFound;
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
            var_dump(substr($body,0,30));
            return trim(ScraperHelper::readBetween('>', '<', $body, true));
        } catch (ScrapeElementNotFound $exception) {
            return null;
        }
    }
}