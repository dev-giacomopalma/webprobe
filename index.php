<?php
require_once 'vendor/autoload.php';

$persister = new \webProbe\PersistingLayer\DataPersisting();
$persister->query('whatevs');
/**
$probeSettings = new webProbe\Probes\Settings\ProbeSetting($argv[1]);
$probe = new webProbe\Probes\CleverWhateverProbe($probeSettings);
$missionSettings = new webProbe\Missions\Settings\MissionSetting(3600);
$mission = new webProbe\Missions\CleverWhateverRetrieveMission($missionSettings, $probe);
$launchPad = new webProbe\LaunchPad\LaunchPad($mission);
$launchPad->launch();
 */
