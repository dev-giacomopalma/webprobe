<?php

namespace twittingeek\webProbe\Probes;

class ProbeResult
{

    public const OK_STATUS_CODE = 200;

    /** @var string */
    public $statusCode;

    /** @var string */
    public $errorMessage;

    /** @var array */
    public $payload;

}