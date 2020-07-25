<?php

namespace webProbe\LaunchPad\Interfaces;

use webProbe\Missions\Interfaces\Mission;
use webProbe\Missions\Interfaces\MissionResult;

interface LaunchPad

{

    public function __construct(Mission $mission);

    public function launch(): MissionResult;

}