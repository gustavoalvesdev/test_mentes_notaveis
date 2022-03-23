<?php 

namespace Api\Dao;

use Api\Database\Database;
use Api\Models\Address;

abstract class AddressDao
{

    private static string $table = 'addresses';
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

                $address = new Address();
                $address->setId($item['id']);
                $address->setPublicPlace($item['public_place']);
                $address->setPlaceNumber($item['place_number']);
                $address->setZipCode($item['zip_code']);
                $address->setComplement($item['complement'] ?? '');
                $address->setDistrict($item['district']);

                $city = CityDao::get($item['city']);

                $address->setCity($city);

                $state = StateDao::get($city->getState()->getId());
                
                $data[] = [
                    'id' => $address->getId(),
                    'public_place' => $address->getPublicPlace(),
                    'place_number' => $address->getPlaceNumber(),
                    'zip_code' => $address->getZipCode(),
                    'complement' => $address->getComplement(),
                    'district' => $address->getDistrict(),
                    'city' => $city->getName(),
                    'state' => $state->getName()
                ];

            }

        }

        return $data;
    }

    public static function get(int $id): ?Address
    {   
        
        $address = null;
        self::$conn = Database::getInstance();
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = :id';
        $stmt = self::$conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $stmt = $stmt->fetch(\PDO::FETCH_ASSOC);

            $address = new Address();

            $address->setId($stmt['id']);
            $address->setPublicPlace($stmt['public_place']);
            $address->setPlaceNumber($stmt['place_number']);
            $address->setZipCode($stmt['zip_code']);
            $address->setComplement($stmt['complement'] ?? '');
            $address->setDistrict($stmt['district']);

            $city = CityDao::get($stmt['city']);

            $address->setCity($city);

        }

        return $address;

    }

}
