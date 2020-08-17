<?php

namespace twittingeek\webProbe\LaunchPad\Interfaces;

use twittingeek\webProbe\Missions\Interfaces\Mission;
use twittingeek\webProbe\Missions\Interfaces\MissionResult;

interface LaunchPad

{

    public function __construct(Mission $mission);

    public function launch(): MissionResult;

}