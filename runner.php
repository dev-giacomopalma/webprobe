<?php

require_once 'vendor/autoload.php';
use Symfony\Component\Yaml\Yaml;

$applications = Yaml::parseFile('config/application.yaml');


foreach ($applications['LaunchPads'] as $launchPad) {
    if (true === $launchPad['Active']) {
        $probeSettingDefinition = $launchPad['ProbeSetting'];
        $probeSettings = new webProbe\Probes\Settings\ProbeSetting($probeSettingDefinition['arguments']);
        $probe = new $launchPad['Probe']['class']($probeSettings);
        $missionSettingDefinition = $launchPad['MissionSetting'];
        $missionSettings = new webProbe\Missions\Settings\MissionSetting(
            $missionSettingDefinition['arguments']['frequency'],
            $missionSettingDefinition['arguments']['params']
        );
        $mission = new $launchPad['Mission']['class']($missionSettings, $probe);
        $launchPad = new webProbe\LaunchPad\LaunchPad($mission);
        $launchPad->launch();
    }
}