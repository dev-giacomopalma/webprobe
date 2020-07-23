<?php

namespace webProbe\PersistingLayer;

use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\DriverManager;

class DataPersisting
{

    /** @var Connection */
    private $dbConnection;

    public function __construct()
    {
        $connectionParams = [
            'dbname' => 'cleverwhatever',
            'user' => 'pi',
            'password' => 'nanoberry',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ];
        try {
            $this->dbConnection = DriverManager::getConnection($connectionParams);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function query(string $query)
    {
        $sql = "SELECT * FROM links";
        try {
            $stmt = $this->dbConnection->query($sql);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        var_dump($stmt);
        while ($row = $stmt->fetch()) {
            var_dump($row);
        }

    }

}