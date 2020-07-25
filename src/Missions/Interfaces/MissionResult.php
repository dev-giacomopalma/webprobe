<?php

namespace webProbe\Missions\Interfaces;

class MissionResult
{

    public const OK_STATUS_CODE = 200;

    /** @var int */
    private $statusCode;

    /** @var string */
    private $result;

    public function __construct(int $statusCode, string $result)
    {
        $this->statusCode = $statusCode;
        $this->result = $result;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getResult(): string
    {
        return $this->result;
    }
}