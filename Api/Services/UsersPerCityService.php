<?php 

namespace Api\Services;

use Api\Dao\CityDao;
use Api\Dao\UserDao;

class UsersPerCityService
{
    public function get($cityId): array
    {
        $data = [];

        if ($cityId) {
            $city = CityDao::get($cityId);

            if ($city != null) {
                $city = $city->getId();
                $usersByCity = UserDao::getByCity($city);
                http_response_code(200);
                $data['total_users_by_city'] = $usersByCity;
            } else {
                http_response_code(404);
                throw new \Exception('City Not Found');
                exit;
            }
        } else {
            http_response_code(422);
            throw new \Exception('Unprocessable Entity! Required Id Not Sent');
            exit;
        }
        

        return $data;
    }
}
