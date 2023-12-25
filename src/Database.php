<?php

namespace Chat;

use PDOStatement;

/**
 * Describes behaviour that each database instance must implement.
 */
interface Database
{
    /**
     * Prepares SQL query.
     *
     * @param string $query    SQL query string.
     * @param array $options   Additional options for query.
     *
     * @return PDOStatement    Executable SQL statement.
     */
    public function prepare(string $query, array $options = []): ?PDOStatement;


    /**
     * Executes an SQL statement and returns the number of affected rows.
     *
     * @param string $statement SQL statement.
     *
     * @return int              Number of affected rows.
     */
    public function exec(string $statement): ?int;


    /**
     * Prepares and executes an SQL statement without placeholders.
     *
     * @param string $query         SQL statement.
     * @param int|null $fetchMode   Fetch mode of the query.
     *
     * @return PDOStatement|null    statement object.
     */
    public function query(string $query, ?int $fetchMode = null): ?PDOStatement;
}
