<?php

namespace webProbe\Probes\Libraries;

class TitleDiscoveryLibrary extends DiscoveryLibrary
{
    /** @var string */
    private $page;

    public function __construct(string $page)
    {
        $this->page = $page;
    }

    public function findHTMLTitle():? string
    {

        return $this->readAfterAndBetween(
            $this->page,
            '<title"',
            '>',
            '<'
        );
    }
}