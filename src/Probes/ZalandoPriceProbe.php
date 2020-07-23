<?php


namespace webProbe\Probes;


use Exception;
use webProbe\Probes\Helpers\PriceScraperHelper;
use webProbe\Probes\Helpers\ScraperHelper;
use webProbe\Probes\Interfaces\Probe;
use webProbe\Probes\Settings\ProbeSetting;

class ZalandoPriceProbe implements Probe
{

    /** @var ProbeSetting */
    private $probeSetting;

    public function __construct(ProbeSetting $probeSetting)
    {
        $this->probeSetting = $probeSetting;
    }

    public function run(): ProbeResult
    {
        $probeResult = new ProbeResult();
        try {
            $page = ScraperHelper::loadPage($this->probeSetting->getUrl());
            $pricePayload = $this->getPricePayload($page);
            $probeResult->statusCode = ProbeResult::OK_STATUS_CODE;
            $probeResult->payload = $pricePayload;
        } catch (Exception $exception) {
            $probeResult->statusCode = $exception->getCode();
            $probeResult->errorMessage = $exception->getMessage();
        }

        return $probeResult;
    }

    private function getPricePayload(string $page)
    {
        $price = str_replace(',','.', PriceScraperHelper::getStringPriceBySpanIdentifier(
            $page,
            'Xb35xC'
        ));

        return json_encode(['currentPrice' => (double) $price]);
    }
}