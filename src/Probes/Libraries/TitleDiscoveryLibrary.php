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
        try {
            return $this->readBetween(
                '<title>',
                '<',
                $this->page,
                true

                );
        } catch (ScrapeElementNotFound $exception) {
            return null;
        }
    }
}