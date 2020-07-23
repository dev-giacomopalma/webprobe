<?php
namespace webProbe\Missions\Settings;

class MissionSetting
{

    /** represents the execution frequency in seconds
     * @var int
     */
    private $executionFrequency;

    /** @var array */
    private $params;

    public function __construct(int $executionFrequency, array $params = [])
    {

        $this->executionFrequency = $executionFrequency;
        $this->params = $params;
    }

    public function getExecutionFrequency(): int
    {
        return $this->executionFrequency;
    }

    public function getParams(): array
    {
        return $this->params;
    }



}