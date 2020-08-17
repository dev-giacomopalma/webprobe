<?php

namespace twittingeek\webProbe\Missions\Interfaces;

use twittingeek\webProbe\Missions\Settings\MissionSetting;
use twittingeek\webProbe\Probes\Interfaces\Probe;

interface Mission
{

    public function __construct(MissionSetting $missionSetting, Probe $probe);

    public function execute(): MissionResult;

    public function getSettings(): MissionSetting;

    public function getProbe(): Probe;

}