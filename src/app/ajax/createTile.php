<?php
error_reporting(E_ALL);

require_once '../../../vendor/autoload.php';

use cw\Tile\dto\TileClass;
use cw\Tile\TileManagerClass;

$operation = $_POST['o'];
switch ($operation) {
    case "submitLink":
        $url = trim((string) $_POST['url']);
        $tileClass = new TileManagerClass();
        /** @var TileClass $tile */
        $tile = $tileClass->insertTile($url);
        ?>
        <input type="text" id="tileTitle" value="<?=$tile->getTitle()?>" />
        <img src="<?=$tile->getPicture();?>" style="width:50px; height: 50px;">
        found price: <input type="text" id="tileFoundPrice" value="<?=(double)$tile->getPrice()/100;?>" />
        your target price: <input type="text" id="tileTargetPrice" value="" />
        <div id="confirm_button" class="confirm_button" style="display:block;" onclick="saveTile();"></div>
        <?php
        break;
}