<?php

namespace webProbe\Probes\Libraries;

use Exception;
use webProbe\Probes\Helpers\ScraperHelper;

class PictureDiscoveryLibrary
{
    /** @var string */
    private $page;

    public function __construct(string $page)
    {
        $this->page = $page;
    }

    public function findPicture():? string
    {
        try {
        $pictureUrl = ScraperHelper::readBetween(
            '"og:image" content="',
            '"',
            $this->page,
            true);
        return ScraperHelper::readBefore('?', trim($pictureUrl));
        } catch (Exception $exception) {
            return null;
        }
    }

}