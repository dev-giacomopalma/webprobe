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

    /**
     * Return the value contained in the HTML tag <title></ (if present)
     *
     * @return string
     * @throws ScrapeElementNotFound
     */
    public function findHTMLTitle(): string
    {
        $elements = $this->readBetween(
            '<title>',
            '</',
            $this->page,
            false,
            true
            );
        return $elements[0];
    }
}