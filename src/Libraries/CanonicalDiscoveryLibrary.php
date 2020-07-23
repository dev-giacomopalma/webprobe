<?php


namespace webProbe\Libraries;


class CanonicalDiscoveryLibrary
{
    /** @var string */
    private $page;

    public function __construct(string $page)
    {
        $this->page = $page;
    }

    public function findCanonical():? string
    {
        $parts = explode('rel="canonical"', $this->page);
        if (count($parts) > 1) {
            $parts = explode('href="',$parts[1]);
            if (count($parts) > 1) {
                $parts = explode('"', $parts[1]);
                if (count($parts) > 1) {
                    return trim($parts[0]);
                }
            }
        }

        return null;
    }
}