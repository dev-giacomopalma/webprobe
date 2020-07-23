<?php

namespace webProbe\LaunchPad\Interfaces;

use webProbe\Missions\Interfaces\Mission;

interface LaunchPad

{

    public function __construct(Mission $mission);

    public function launch(): void;

}