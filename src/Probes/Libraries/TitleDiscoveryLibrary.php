<?php

namespace webProbe\Probes\Libraries;

use webProbe\Probes\Exceptions\ScrapeElementNotFound;

class TitleDiscoveryLibrary extends DiscoveryLibrary
{
    /** @var string */
    private $page;

    public function __construct(string $page)
    {
        $this->page = $page;
    }

    public function findHTMLTitle(): string
    {
        $elements = $this->readBetween(
            '<title>',
            '<',
            $this->page,
            false,
            true
            );
        return $elements[0];
    }
}