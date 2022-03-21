<?php 

namespace Api\Services;

use Api\Dao\AddressDao;

class AddressesService
{
    public function get($id = null): array
    {
        $data = [];

        if ($id) {
            $id = intval($id);
            if (!empty(AddressDao::get($id))) {

                $address = AddressDao::get($id);

                $data = [
                    'id' => $address->getId(),
                    'public_place' => $address->getPublicPlace(),
                    'place_number' => $address->getPlaceNumber(),
                    'zip_code' => $address->getZipCode(),
                    'complement' => $address->getComplement(),
                    'district' => $address->getDistrict(),
                    'city' => $address->getCity()->getName(),
                    'state' => $address->getCity()->getState()->getName()
                ];

            } else {
                throw new \Exception('Address Not Found');
                exit;
            }
            
        } else {
            $data = AddressDao::all();
        }

        return $data;
    }
}
