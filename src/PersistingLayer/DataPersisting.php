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

    public function query(string $query):? int
    {
        try {
            $this->dbConnection->query($query);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return $this->dbConnection->lastInsertId();
    }

}