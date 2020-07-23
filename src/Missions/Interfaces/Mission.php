<?php

namespace webProbe\Missions\Interfaces;

use webProbe\Missions\Settings\MissionSetting;
use webProbe\Probes\Interfaces\Probe;

interface Mission
{

    public function __construct(MissionSetting $missionSetting, Probe $probe);

    public function execute(): MissionResult;

    public function getSettings(): MissionSetting;

    public function getProbe(): Probe;

}