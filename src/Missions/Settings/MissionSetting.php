<?php
namespace twittingeek\webProbe\Missions\Settings;

class MissionSetting
{

    /** @var array */
    private $params;

    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    public function getParams(): array
    {
        return $this->params;
    }



}