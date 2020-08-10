<?php

namespace webProbe\LaunchPad;

use webProbe\LaunchPad\Interfaces\LaunchPad as LaunchPadInterface;
use webProbe\Missions\Interfaces\Mission;
use webProbe\Missions\Interfaces\MissionResult;


class LaunchPad implements LaunchPadInterface
{

    /** @var Mission */
    private $mission;

    public function __construct(Mission $mission)
    {
        $this->mission = $mission;
    }

    public function launch(): MissionResult
    {
        return $this->getMission()->execute();
    }

    public function getMission(): Mission
    {
        return $this->mission;
    }
}