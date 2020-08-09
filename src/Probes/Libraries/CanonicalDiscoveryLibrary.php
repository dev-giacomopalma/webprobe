<?php

namespace webProbe\Probes\Libraries;

use webProbe\Probes\Exceptions\ScrapeElementNotFound;

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
        try {
            return $this->readAfterAndBetween(
                $this->page,
                'rel="canonical"',
                'href="',
                '"',
                true
            );
        } catch (ScrapeElementNotFound $exception) {
            return null;
        }
    }

    public function findOgFullUrl():? string
    {
        $ogSite = $this->findOgSite();
        $ogUrl = $this->findOgUrl();

        if (null === $ogSite || null === $ogUrl) {
            return null;
        }

        if (substr($ogSite, -1) === '/' && substr($ogUrl, 0, 1) === '/') {
            $ogUrl = substr($ogUrl, 1);
        }

        return $ogSite.$ogUrl;
    }

    public function findOgUrl():? string
    {
        try {
            return $this->readAfterAndBetween(
                $this->page,
                'property="og:url"',
                'content="',
                '"',
                true
            );
        } catch (ScrapeElementNotFound $exception) {
            return null;
        }
    }

    public function findOgSite():? string
    {
        try {
            return $this->readAfterAndBetween(
                $this->page,
                'property="og:site"',
                'content="',
                '"',
                true
            );
        } catch (ScrapeElementNotFound $exception) {
            return null;
        }
    }
}