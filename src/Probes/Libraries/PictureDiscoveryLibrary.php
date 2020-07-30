<?php

namespace webProbe\Probes\Libraries;

use webProbe\Probes\Exceptions\ScrapeElementNotFound;
use webProbe\Probes\Helpers\ScraperHelper;

class PictureDiscoveryLibrary
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
        $pictureUrl = ScraperHelper::readBetween(
            '"og:image" content="',
            '"',
            $this->page,
            true);
        return ScraperHelper::readBefore('?', trim($pictureUrl));
        } catch (ScrapeElementNotFound $exception) {
            return null;
        }
    }

}