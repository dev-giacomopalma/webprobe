<?php

namespace webProbe\Probes\Helpers;

use HeadlessChromium\BrowserFactory;
use Exception;
use webProbe\Probes\Dtos\HTMLPageDto;
use webProbe\Probes\Exceptions\PageLoadException;
use webProbe\Probes\Exceptions\ScrapeElementNotFound;

class ScraperHelper
{

    private const HTML_ELEMENT_TYPE_SPAN = 'span';

    /**
     * @param string $url
     * @return HTMLPageDto
     * @throws Exception
     */
    public static function loadPage(string $url): HTMLPageDto
    {
        $browserFactory = new BrowserFactory('chromium-browser');
        $browser = $browserFactory->createBrowser();
        $page = $browser->createPage();
        $page->navigate($url)->waitForNavigation();
        $head = $page->evaluate("document.head.innerHTML")->getReturnValue();
        $body = $page->evaluate("document.body.innerHTML")->getReturnValue();
        if (null !== $head && null !== $body) {
            return new HTMLPageDto($head, $body);
        }

        throw new PageLoadException(sprintf('Page not loaded. Url: %s', $url));

    }

    public static function readSpanByUniqueStart(string $page, string $start): string
    {
        $blocks = explode($start, $page);
        if (count($blocks) > 1) {
            $pointerBlock = $blocks[1];
            return self::readInsideHtmlTagLeft(
                self::readBeforeSpanClose($pointerBlock)
            );
        }

        return '';

    }

    private static function readBeforeSpanClose(string $block): string
    {
        return self::readBeforeElementClose($block, self::HTML_ELEMENT_TYPE_SPAN);
    }

    private static function readBeforeElementClose(string $block, string $element)
    {
        $blocks = explode("</{$element}>", $block);
        if (count($blocks) > 1) {
            return (string) $blocks[0];
        }

        return '';
    }

    private static function readInsideHtmlTagLeft(string $block)
    {
        $blocks = explode('>', $block);
        if (count($blocks) > 1) {
            return (string) $blocks[1];
        }

        return '';
    }

    protected static function removeCurrenciesSign(string $block, $removeHtml = true): string
    {
        $block = str_replace(array('€', '$'), '', $block);

        if ($removeHtml) {
            $block = str_replace(array('&euro;', '&dollar;'), '', $block);
        }

        return $block;
    }

    /**
     * @param string $delimiter
     * @param string $body
     * @param bool $strict
     * @return string
     * @throws ScrapeElementNotFound
     */
    public static function readAfter(string $delimiter, string $body, bool $strict = false): string
    {
        $blocks = explode($delimiter, $body);
        if (count($blocks) > 1) {
            return $blocks[1];
        }

        if ($strict) {
            throw new ScrapeElementNotFound(sprintf('%s : Delimiter not found %s', __FUNCTION__, $delimiter));
        }

        return '';
    }

    /**
     * @param string $delimiter
     * @param string $body
     * @param bool $strict
     * @return string
     * @throws ScrapeElementNotFound
     */
    public static function readBefore(string $delimiter, string $body, bool $strict = false): string
    {
        $blocks = explode($delimiter, $body);
        if (count($blocks) > 1) {
            return $blocks[0];
        }

        if ($strict) {
            throw new ScrapeElementNotFound(sprintf('%s : Delimiter not found  %s',__FUNCTION__, $delimiter));
        }

        return '';
    }

    /**
     * Read string contained between left and right delimiter
     * if $strict == true, return an exception instead of an empty string
     * in case delimiters are not found in body
     *
     * @param string $leftDelimiter
     * @param string $rightDelimiter
     * @param string $body
     * @param bool $strict
     * @return string
     * @throws ScrapeElementNotFound
     */
    public static function readBetween(
        string $leftDelimiter,
        string $rightDelimiter,
        string $body,
        bool $strict = false
    ):string {
        $body = self::readAfter($leftDelimiter, $body, $strict);
        return self::readBefore($rightDelimiter, $body, $strict);
    }
}