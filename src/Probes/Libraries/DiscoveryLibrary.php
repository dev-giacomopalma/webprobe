<?php

namespace webProbe\Probes\Libraries;

use webProbe\Probes\Exceptions\ScrapeElementNotFound;
use webProbe\Probes\Helpers\ScraperHelper;

class DiscoveryLibrary
{

    public function readAfterAndBetween(
        string $body,
        string $afterDelimiter,
        string $betweenLeftDelimiter,
        string $betweenRightDelimiter,
        bool $strict = false
    ):? string {
        try {
            $body = ScraperHelper::readAfter($afterDelimiter, $body, $strict);
            return $this->readBetween($betweenLeftDelimiter, $betweenRightDelimiter, $body, $strict);
        } catch (ScrapeElementNotFound $exception) {
            throw $exception;
        }
    }

    public function readBetweenAndBefore(
        string $body,
        string $betweenLeftDelimiter,
        string $betweenRightDelimiter,
        string $beforeDelimiter,
        bool $strict = false
    ):? string {
        try {
            $body = $this->readBetween(
                $betweenLeftDelimiter,
                $betweenRightDelimiter,
                $body,
                $strict);
            return ScraperHelper::readBefore($beforeDelimiter, trim($body), $strict);
        } catch (ScrapeElementNotFound $exception) {
            throw $exception;
        }
    }

    public function readBetween(
        string $betweenLeftDelimiter,
        string $betweenRightDelimiter,
        string $body,
        bool $strict = false
    ): string {
        return trim(ScraperHelper::readBetween($betweenLeftDelimiter, $betweenRightDelimiter, $body, $strict));
    }

}