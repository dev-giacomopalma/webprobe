<?php

namespace twittingeek\webProbe\Probes\Interfaces;

use twittingeek\webProbe\Probes\ProbeResult;
use twittingeek\webProbe\Probes\Settings\ProbeSetting;

interface Probe
{

    public function __construct(ProbeSetting $probeSetting);

    public function run(): ProbeResult;

}