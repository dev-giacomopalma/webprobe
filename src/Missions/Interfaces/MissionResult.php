<?php

namespace webProbe\Missions\Interfaces;

class MissionResult
{

    public const OK_STATUS_CODE = 200;

    /** @var int */
    private $statusCode;

    public function __construct(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}