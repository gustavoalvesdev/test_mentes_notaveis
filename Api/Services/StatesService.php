<?php 

namespace Api\Services;

use Api\Dao\StateDao;

class StatesService
{
    public function get($id = null): array
    {
        $data = [];

        if ($id) {
            $id = intval($id);
            if (!empty(StateDao::get($id))) {

                $state = StateDao::get($id);

                $data = [
                    'id' => $state->getId(),
                    'name' => $state->getName()
                ];

            } else {
                throw new \Exception('State Not Found');
                exit;
            }
            
        } else {
            $data = StateDao::all();
        }

        return $data;
    }
}
