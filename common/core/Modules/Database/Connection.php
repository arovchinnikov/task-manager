<?php

declare(strict_types=1);

namespace Core\Modules\Database;

use Core\Modules\Database\Exceptions\ConnectionException;
use Core\Modules\Database\Interfaces\QueryBuilderInterface;
use PDO;
use PDOException;

class Connection
{
    private PDO $pdo;

    /**
     * @param string|QueryBuilderInterface $query
     * @return array|bool
     */
    public function query(string|QueryBuilderInterface $query): array|bool
    {
        if (is_subclass_of($query, QueryBuilderInterface::class)) {
            $query = $query->getQuery();
        }

        $preparedQuery = $this->pdo->prepare($query);
        $preparedQuery->execute();

        $result = $preparedQuery->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) === 1) {
            if (empty($result[0])) {
                $result = true;
            }
        }

        return $result;
    }

    /**
     * @throws ConnectionException
     */
    public function connect(string $host, string $port, string $dbName, string $dbUser, string $dbPassword): self
    {
        if (isset($this::$pdo)) {
            ConnectionException::alreadyConnected();
        }

        try {
            $this->pdo = new PDO(
                "pgsql:host=$host;port=$port;dbname=$dbName",
                $dbUser,
                $dbPassword,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            ConnectionException::connectionFailed($e);
        }

        return $this;
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}