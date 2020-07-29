<?php

namespace webProbe\Probes\Libraries;

use ScrapeElementNotFound;
use webProbe\Probes\Helpers\ScraperHelper;

class CanonicalDiscoveryLibrary
{
    /** @var string */
    private $page;

    public function __construct(string $page)
    {
        $this->page = $page;
    }

    public function findCanonical():? string
    {
        try {
            $body = ScraperHelper::readAfter('rel="canonical"', $this->page, true);
            return trim(ScraperHelper::readBetween('href="', '"', $body, true));
        } catch (ScrapeElementNotFound $exception) {
            return null;
        }

    }
}