<?php

namespace webProbe\Probes\Libraries;

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
        return $this->readAfterAndBetween(
            $this->page,
            'rel="canonical"',
            'href="',
            '"'
        );
    }
}