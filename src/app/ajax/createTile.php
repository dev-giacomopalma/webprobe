<?php
error_reporting(E_ALL);

require_once '../../../vendor/autoload.php';

use cw\Tile\TileManagerClass;

$operation = $_POST['o'];
switch ($operation) {
    case "submitLink":
        $url = trim((string) $_POST['url']);
        $tileClass = new TileManagerClass();
        $tile = $tileClass->insertTile($url);
        var_dump($tile);
        break;
}