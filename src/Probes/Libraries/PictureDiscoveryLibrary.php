<?php

namespace webProbe\Probes\Libraries;

use webProbe\Probes\Exceptions\ScrapeElementNotFound;

class PictureDiscoveryLibrary extends DiscoveryLibrary
{
    /** @var string */
    private $page;

    public function __construct(string $page)
    {
        $this->page = $page;
    }

    public function findOgImage():? string
    {
        try {
            return $this->readBetweenAndBefore(
                $this->page,
                '"og:image" content="',
                '"',
                '?'
            );
        } catch (ScrapeElementNotFound $exception) {
            return null;
        }
    }

}