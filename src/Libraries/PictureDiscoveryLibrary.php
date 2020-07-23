<?php

namespace webProbe\Libraries;

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
        $parts = explode('"og:image" content="', $this->page);
        if (count($parts) > 1) {
            $parts = explode('"', $parts[1]);
            if (count($parts) > 1) {
                $parts = explode('?', trim($parts[0]));
                return $parts[0];
            }
        }

        return null;
    }

}