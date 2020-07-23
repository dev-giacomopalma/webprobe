<?php

namespace webProbe\Probes\Helpers;

use HeadlessChromium\BrowserFactory;
use Exception;
use HeadlessChromium\PageUtils\PageNavigation;

class ScraperHelper
{

    private const HTML_ELEMENT_TYPE_SPAN = 'span';

    /**
     * @param string $url
     * @return string
     * @throws Exception
     */
    public static function loadPage(string $url): string
    {
        $browserFactory = new BrowserFactory('chromium-browser');
        $browser = $browserFactory->createBrowser();
        $page = $browser->createPage();
        $page->navigate($url)->waitForNavigation();
        $htmlContent =
            $page->evaluate("document.head.innerHTML")->getReturnValue()
            .$page->evaluate("document.body.innerHTML")->getReturnValue();

        if (null !== $htmlContent) {
            return $htmlContent;
        }

        throw new Exception('Page not loaded');

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
}