<?php 

namespace Api\Services;

use Api\Dao\CityDao;

class CitiesService
{
    public function get($id = null): array
    {
        $data = [];

        if ($id) {
            $id = intval($id);
            if (!empty(CityDao::get($id))) {

                $city = CityDao::get($id);

                $data = [
                    'id' => $city->getId(),
                    'name' => $city->getName(),
                    'state' => $city->getState()->getName()
                ];

            } else {
                http_response_code(404);
                throw new \Exception('City Not Found');
                exit;
            }
            
        } else {
            $data = CityDao::all();
        }

        return $data;
    }
}
