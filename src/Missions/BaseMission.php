<?php

namespace webProbe\Missions;

use webProbe\Missions\Interfaces\Mission;
use webProbe\Missions\Interfaces\MissionResult;
use webProbe\Missions\Settings\MissionSetting;
use webProbe\Probes\Interfaces\Probe;

abstract class BaseMission implements Mission
{

    /** @var MissionSetting */
    public $missionSetting;

    /** @var Probe */
    public $probe;

    public function __construct(MissionSetting $missionSetting, Probe $probe)
    {
        $this->missionSetting = $missionSetting;
        $this->probe = $probe;
    }

    abstract public function execute(): MissionResult;

    public function getSettings(): MissionSetting
    {
        return $this->missionSetting;
    }

    public function getProbe(): Probe
    {
        return $this->probe;
    }
}