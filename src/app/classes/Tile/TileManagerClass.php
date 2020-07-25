<?php

namespace cw\Tile;

use cw\Tile\dto\TileClass;
use webProbe\LaunchPad\LaunchPad;
use webProbe\Missions\CleverWhateverRetrieveMission;
use webProbe\Missions\Settings\MissionSetting;
use webProbe\Probes\CleverWhateverProbe;
use webProbe\Probes\Settings\ProbeSetting;

class TileManagerClass
{
    public function insertTile(string $url): TileClass
    {
        $probeSettings = new ProbeSetting($url);
        $probe = new CleverWhateverProbe($probeSettings);
        $missionSettings = new MissionSetting(0);
        $mission = new CleverWhateverRetrieveMission($missionSettings, $probe);
        $launchPad =  new LaunchPad($mission);
        $missionResult = $launchPad->launch();
        $missionPayload = json_decode($missionResult->getResult());

        $tile = new TileClass(
            $missionPayload->linkId,
            $missionPayload->title,
            $missionPayload->url,
            $missionPayload->picture,
            $missionPayload->price
        );

        return $tile;
    }
}