<?php

namespace webProbe\Probes\Libraries;

use webProbe\Probes\Exceptions\ScrapeElementNotFound;

class CanonicalDiscoveryLibrary extends DiscoveryLibrary
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
            return $this->readAfterAndBetween(
                $this->page,
                'rel="canonical"',
                'href="',
                '"'
            );
        } catch (ScrapeElementNotFound $exception) {
            return null;
        }
    }
}