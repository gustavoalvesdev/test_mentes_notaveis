<?php 

namespace Api\Dao;

use Api\Database\Database;
use Api\Models\City;

abstract class CityDao
{

    private static string $table = 'cities';
    private static \PDO $conn;

    public static function all(): array
    {
        $data = [];

        self::$conn = Database::getInstance();
        $sql = 'SELECT * FROM ' . self::$table; 
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $stmt = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            foreach($stmt as $item) {

                $city = new City();
                $city->setId($item['id']);
                $city->setName($item['name']);

                $state = StateDao::get($item['state']);

                $city->setState($state);

                $data[] = [
                    'id' => $city->getId(),
                    'name' => $city->getName(),
                    'state' => $state->getName()
                ];

            }

        }

        return $data;
    }

    public static function get(int $id): ?City
    {   
        
        $city = null;
        self::$conn = Database::getInstance();
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = :id';
        $stmt = self::$conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $stmt = $stmt->fetch(\PDO::FETCH_ASSOC);

            $city = new City();

            $city->setId($stmt['id']);
            $city->setName($stmt['name']);

            $state = StateDao::get($stmt['state']);

            $city->setState($state);

        }

        return $city;

    }

}
