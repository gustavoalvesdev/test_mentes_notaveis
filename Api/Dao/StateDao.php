<?php 

namespace Api\Dao;

use Api\Database\Database;
use Api\Models\State;

abstract class StateDao
{

    private static string $table = 'states';
    private static \PDO $conn;

    public static function all(): array
    {
        self::$conn = Database::getInstance();
        $sql = 'SELECT * FROM ' . self::$table; 
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

    public static function get(int $id): ?State
    {   
        $state = null;
        self::$conn = Database::getInstance();
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = :id';
        $stmt = self::$conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $stmt = $stmt->fetch(\PDO::FETCH_ASSOC);

            $state = new State();

            $state->setId($stmt['id']);
            $state->setName($stmt['name']);

        }

        return $state;

    }

}
