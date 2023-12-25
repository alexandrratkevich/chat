<?php

namespace Chat\Inject;

use \Chat\Injector;
use \Chat\Database;


/**
 * Provides class field that contains instance of Database connection
 * and can retrieve it from IoC-container.
 */
trait DatabaseConnection
{
    /**
     * Injected instance of Database.
     *
     * @var Database
     */
    protected $DatabaseConnection;


    /**
     * Retrieves instance of Database connection from IoC-container
     * if it is not set yet.
     *
     * @return Database  Initialized instance of HTML renderer.
     */
    protected function initDatabaseConnection(): Database
    {
        if (!isset($this->DatabaseConnection)) {
            $this->DatabaseConnection = Injector::make('DatabaseConnection');
        }
        return $this->DatabaseConnection;
    }
}
