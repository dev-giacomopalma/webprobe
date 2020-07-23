<?php

namespace webProbe\Probes\Interfaces;

use webProbe\Probes\ProbeResult;
use webProbe\Probes\Settings\ProbeSetting;

interface Probe
{

    public function __construct(ProbeSetting $probeSetting);

    public function run(): ProbeResult;

}