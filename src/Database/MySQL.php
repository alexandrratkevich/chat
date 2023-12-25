<?php

namespace Chat\Database;

use PDO;
use Chat\Database;
use PDOStatement;

/**
 * Implements view renderer on top of Twig templates engine.
 */
class MySQL implements Database
{
    /**
     * Database engine for database connections.
     *
     * @var PDO
     */
    protected $pdo;


    /**
     * Creates new database connection.
     *
     * @var string $db_name Database name.
     * @var string $db_host Database host.
     * @var string $db_user Database user.
     * @var string $db_password Database password.
     */
    public function __construct(
        string $db_name,
        string $db_host,
        string $db_user,
        string $db_password
    )
    {
        $dsn = 'mysql:dbname=' . $db_name . ';host=' . $db_host;
        $this->pdo = new PDO($dsn, $db_user, $db_password);
    }


    /**
     * Creates executable SQL statement.
     *
     * @param string $query SQL query string.
     * @param array $options Additional options for query.
     *
     * @return PDOStatement  Executable SQL statement.
     */
    public function prepare(string $query, array $options = []): ?PDOStatement
    {
        return $this->pdo->prepare($query, $options);
    }


    /**
     * Executes an SQL statement and returns the number of affected rows.
     *
     * @param string $statement SQL statement.
     *
     * @return int  Number of affected rows.
     */
    public function exec(string $statement): ?int
    {
        return $this->pdo->exec($statement);
    }


    /**
     * Prepares and executes an SQL statement without placeholders.
     *
     * @param string $query         SQL statement.
     * @param int|null $fetchMode   Fetch mode of the query.
     *
     * @return PDOStatement|null    statement object.
     */
    public function query(string $query, ?int $fetchMode = null): ?PDOStatement
    {
        return $this->pdo->query($query, $fetchMode);
    }
}
