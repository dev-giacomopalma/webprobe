<?php

namespace webProbe\Missions;

use stdClass;
use webProbe\Missions\Settings\MissionSetting;
use webProbe\PersistingLayer\DataPersisting;
use webProbe\Probes\Interfaces\Probe;
use webProbe\Missions\Interfaces\MissionResult;
use webProbe\Probes\ProbeResult;


class CleverWhateverRetrieveMission extends BaseMission
{

    /** @var DataPersisting  */
    private $persist;

    public function __construct(MissionSetting $missionSetting, Probe $probe)
    {
        parent::__construct($missionSetting, $probe);
        $this->persist = new DataPersisting();
    }

    public function execute(): MissionResult
    {
        $probeResult = $this->probe->run();
        $statusCode = $probeResult->statusCode;
        if ($probeResult->statusCode === ProbeResult::OK_STATUS_CODE) {
            //TODO log info execution
            //TODO store
            $payload = json_decode($probeResult->payload);
            $linkId = $this->persistLink($payload);
            $this->persistLinkAttribute($linkId, $payload);
            $priceId = $this->persistCurrentPrice($linkId, $payload);
            $this->persistLinkPrice($linkId, $priceId);

        } else {
            //TODO log error execution
        }
        return new MissionResult($statusCode);
    }

    private function persistLink(stdClass $payload):? int
    {
        $query = "
        INSERT INTO `links` (`url`, `canonical`, `creationDate`, `active`, `status`)
        VALUES
	    ('".$payload->url."','".$payload->canonical."', NOW(), 1, 1);
        ";
        return $this->persist->query($query);
    }

    private function persistLinkAttribute(?int $linkId, stdClass $payload)
    {
        $query = "
        INSERT INTO `links_attribute` (`link_id`, `picture`, `title`)
        VALUES
	    (".$linkId.",'".$payload->picture."','".$payload->title."');
        ";
        $this->persist->query($query);
    }

    private function persistCurrentPrice(int $linkId, stdClass $payload):? int
    {
        $query = "
        INSERT INTO `links_price_history` (`link_id`, `value`, `creationDate`)
        VALUES
	    (".$linkId.",'".$payload->price."',NOW());
        ";
        return $this->persist->query($query);
    }

    private function persistLinkPrice(?int $linkId, ?int $priceId)
    {
        $query = "INSERT INTO `links_current_price` (`link_id`, `links_price_history_id`)
        VALUES
	    (".$linkId.", ".$priceId.");
         ";
        $this->persist->query($query);
    }
}