<?php


namespace webProbe\Libraries;


class TitleDiscoveryLibrary
{
    /** @var string */
    private $page;

    public function __construct(string $page)
    {
        $this->page = $page;
    }

    public function findTitle():? string
    {
        $parts = explode('<title', $this->page);
        if (count($parts) > 1) {
            $parts = explode('>',$parts[1]);
            if (count($parts) > 1) {
                $parts = explode('<', $parts[1]);
                if (count($parts) > 1) {
                    return trim($parts[0]);
                }
            }
        }

        return null;
    }
}