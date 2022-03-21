<?php 

namespace Api\Dao;

use Api\Database\Database;
use Api\Models\User;

abstract class UserDao
{

    private static string $table = 'users';
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

                $user = new User();
                $user->setId($item['id']);
                $user->setName($item['name']);
                $user->setEmail($item['email']);
                $user->setPassword($item['password']);

                $address = AddressDao::get($item['address']);

                $user->setAddress($address);

                $city = CityDao::get($address->getCity()->getId());

                $state = StateDao::get($city->getState()->getId());

                $data[] = [
                    'id' => $user->getId(),
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => $user->getPassword(),
                    'address' => [
                        'public_place' => $user->getAddress()->getPublicPlace(),
                        'place_number' => $user->getAddress()->getPlaceNumber(),
                        'zip_code' => $user->getAddress()->getZipCode(),
                        'complement' => $user->getAddress()->getComplement(),
                        'district' => $user->getAddress()->getDistrict(),
                        'city' => $city->getName(),
                        'state' => $state->getName()
                    ]
                ];

            }

        }

        return $data;
    }

    public static function get(int $id)
    {   
        
        $user = null;
        self::$conn = Database::getInstance();
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = :id';
        $stmt = self::$conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $stmt = $stmt->fetch(\PDO::FETCH_ASSOC);

            $user = new User();

            $user->setId($stmt['id']);
            $user->setName($stmt['name']);
            $user->setEmail($stmt['email']);
            $user->setPassword($stmt['password']);

            $address = AddressDao::get($stmt['address']);

            $user->setAddress($address);

        }

        return $user;

    }

}