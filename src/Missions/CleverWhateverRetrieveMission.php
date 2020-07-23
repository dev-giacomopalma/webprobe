<?php

namespace webProbe\Missions;

use webProbe\Missions\Settings\MissionSetting;
use webProbe\Probes\Interfaces\Probe;
use webProbe\Missions\Interfaces\MissionResult;
use webProbe\Probes\ProbeResult;


class CleverWhateverRetrieveMission extends BaseMission
{
    public function __construct(MissionSetting $missionSetting, Probe $probe)
    {
        parent::__construct($missionSetting, $probe);
    }

    public function execute(): MissionResult
    {
        $probeResult = $this->probe->run();
        if ($probeResult->statusCode !== ProbeResult::OK_STATUS_CODE) {
            //TODO log the failed execution
        }

        var_dump($probeResult);

        return new MissionResult(); //TODO populate this
    }
}