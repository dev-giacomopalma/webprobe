<?php

use PHPUnit\Framework\TestCase;
use webProbe\Probes\Libraries\DiscoveryLibrary;

class DiscoveryLibraryTest extends TestCase
{
    /** @var DiscoveryLibrary */
    private $zalandoDiscoveryLibrary;

    /** @var string */
    private $page;

    public function setUp()
    {
        $this->zalandoDiscoveryLibrary = new DiscoveryLibrary();
        $this->page = file_get_contents(__DIR__.'/TestFiles/zalandoProductsList.html');
    }

    public function testSuccessGetList()
    {
        $list = $this->zalandoDiscoveryLibrary->readAfterAndBetween(
            $this->page,
            'class="cat_imageLink',
            'href="',
            '"',
            true,
            true,
        );

        $this->assertIsArray($list);

    }

}