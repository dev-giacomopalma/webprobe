<?php

namespace twittingeek\webProbe\Probes\Libraries;

use twittingeek\webProbe\Probes\Exceptions\ScrapeElementNotFound;
use twittingeek\webProbe\Probes\Helpers\ScraperHelper;

class TitleDiscoveryLibrary extends DiscoveryLibrary
{
    /** @var string */
    private $page;

    public function __construct(string $page)
    {
        $this->page = $page;
    }

    /**
     * Return the value contained in the HTML tag <title></ (if present)
     *
     * @return string
     * @throws ScrapeElementNotFound
     */
    public function findHTMLTitle(): string
    {
        $elements = $this->readBetween(
            '<title',
            '</',
            $this->page,
            false,
            true
            );
        if (isset( $elements[0])) {
            return ScraperHelper::readAfter('>',$elements[0])[0];
        } else {
            $elements = $this->readBetween(
                '<h1',
                '</',
                $this->page,
                false,
                true
            );
            if (isset( $elements[0])) {
                return ScraperHelper::readAfter('>',$elements[0])[0];
            } else {
                return '';
            }
        }
    }
}