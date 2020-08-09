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
        bool $fullList = false,
        bool $strict = false
    ):? array {
        try {
            $elements = ScraperHelper::readAfter($afterDelimiter, $body, $fullList, $strict);
            $vals = [];
            $insideVals = [];
            foreach ($elements as $element) {
                $insideVals[] = $this->readBetween($betweenLeftDelimiter, $betweenRightDelimiter, $element, false, $strict);
            }

            foreach ($insideVals as $insideVal) {
                $vals[] = $insideVal[0];
            }

            return $vals;
        } catch (ScrapeElementNotFound $exception) {
            throw $exception;
        }
    }

    public function readBetweenAndBefore(
        string $body,
        string $betweenLeftDelimiter,
        string $betweenRightDelimiter,
        string $beforeDelimiter,
        bool $fullList = false,
        bool $strict = false
    ):? array {
        try {
            $vals = [];
            $insideVals = [];
            $elements = $this->readBetween(
                $betweenLeftDelimiter,
                $betweenRightDelimiter,
                $body,
                $fullList,
                $strict);
            foreach ($elements as $element) {
                $insideVals[] = ScraperHelper::readBefore($beforeDelimiter, trim($element), $strict);
            }

            foreach ($insideVals as $insideVal) {
                $vals[] = $insideVal[0];
            }

            return $vals;
        } catch (ScrapeElementNotFound $exception) {
            throw $exception;
        }
    }

    public function readBetween(
        string $betweenLeftDelimiter,
        string $betweenRightDelimiter,
        string $body,
        bool $fullList = false,
        bool $strict = false
    ): array {
        return ScraperHelper::readBetween($betweenLeftDelimiter, $betweenRightDelimiter, $body, $fullList, $strict);
    }

}