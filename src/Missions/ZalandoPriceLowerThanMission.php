<?php

namespace webProbe\Missions;

use webProbe\Missions\Interfaces\MissionResult;
use webProbe\Missions\Settings\MissionSetting;
use webProbe\Probes\Interfaces\Probe;
use webProbe\Probes\ProbeResult;

class ZalandoPriceLowerThanMission extends BaseMission
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

        $payload = json_decode($probeResult->payload);
        $params = $this->getSettings()->getParams();
        if ($payload->currentPrice < $params['threshold']) {
            echo "OK! ".$payload->currentPrice." ".$params['threshold'];
        } else {
            echo "the price is too high! ".$payload->currentPrice." Euro you've set a threshold of ".(double)$params['threshold']." Euro \n";
        }

        return new MissionResult(); //TODO populate this
    }
}