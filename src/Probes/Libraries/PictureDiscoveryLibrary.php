<?php

namespace webProbe\Probes\Libraries;

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
        return $this->readBetweenAndBefore(
            $this->page,
            '"og:image" content="',
            '"',
            '?'
        );
    }

}