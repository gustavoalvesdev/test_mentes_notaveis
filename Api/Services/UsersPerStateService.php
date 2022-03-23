<?php 

namespace Api\Services;

use Api\Dao\StateDao;
use Api\Dao\UserDao;

class UsersPerStateService
{
    public function get(int $stateId): array
    {
        $data = [];

        if ($stateId) {
            $state = StateDao::get($stateId);

            if ($state != null) {
                $state = $state->getId();
                $usersByCity = UserDao::getByState($state);
                http_response_code(200);
                $data['total_users_by_state'] = $usersByCity;
            } else {
                http_response_code(404);
                throw new \Exception('State Not Found');
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
