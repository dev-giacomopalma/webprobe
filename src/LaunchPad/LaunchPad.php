<?php

namespace twittingeek\webProbe\LaunchPad;

use twittingeek\webProbe\LaunchPad\Interfaces\LaunchPad as LaunchPadInterface;
use twittingeek\webProbe\Missions\Interfaces\Mission;
use twittingeek\webProbe\Missions\Interfaces\MissionResult;


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