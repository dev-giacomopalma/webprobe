<?php


namespace twittingeek\webProbe\Probes\Libraries;


class DomainDiscoveryLibrary extends DiscoveryLibrary
{
    /**
     * @param string $url
     * @return string
     */
    public function findDomain(string $url): string
    {
        return parse_url($url, PHP_URL_HOST);
    }
}