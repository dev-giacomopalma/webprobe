<?php
require_once '../../../vendor/autoload.php';

$operation = $_POST['o'];
switch ($operation) {
    case "submitLink":
        $url = trim((string) $_POST['url']);
        $probeSettings = new webProbe\Probes\Settings\ProbeSetting($url);
        $probe = new webProbe\Probes\CleverWhateverProbe($probeSettings);
        $missionSettings = new webProbe\Missions\Settings\MissionSetting(0);
        $mission = new webProbe\Missions\CleverWhateverRetrieveMission($missionSettings, $probe);
        $launchPad = new webProbe\LaunchPad\LaunchPad($mission);
        $launchPad->launch();
        echo "OK!";
        break;
}