<?php 

namespace Api\Services;

use Api\Dao\AddressDao;
use Api\Dao\CityDao;
use Api\Dao\StateDao;
use Api\Dao\UserDao;

class UsersService
{
    public function get($id = null): array
    {
        $data = [];

        if ($id) {
            $id = intval($id);
            if (!empty(UserDao::get($id))) {

                $user = UserDao::get($id);

                $address = AddressDao::get($user->getAddress()->getId());
                $city = CityDao::get($address->getCity()->getId());
                $state = StateDao::get($city->getState()->getId());

                $data = [
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

            } else {
                throw new \Exception('User Not Found');
                exit;
            }
            
        } else {
            $data = UserDao::all();
        }

        return $data;
    }
}
