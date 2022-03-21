<?php 

namespace Api\Services;

use Api\Dao\AddressDao;
use Api\Dao\CityDao;
use Api\Dao\StateDao;
use Api\Dao\UserDao;
use Api\Models\User;

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

    public function post()
    {
        $data = [];

        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $address = filter_input(INPUT_POST, 'address');

        if (!empty($name) && !empty($email) && !empty($password) && !empty($address)) {

            $user = new User();
            $user->setName($name);
            $user->setEmail($email);
            $user->setPassword($password);
            $address = AddressDao::get($address);
            $user->setAddress($address);

            if (UserDao::add($user)) {

                http_response_code(200);
                $data = 'User added successfully!';

            } else {
                http_response_code(400);
                throw new \Exception('Bad Request! Error inserting user!');
            }

        } else {

            http_response_code(422);
            throw new \Exception('Unprocessable Entity! Required Data Not Sent');

        }

        return $data;

    }

    public static function put()
    {
        $data = [];

        parse_str(file_get_contents('php://input'), $input);

        $id = $input['id'] ?? null;
        $name = $input['name'] ?? null;
        $email = $input['email'] ?? null;
        $password = $input['password'] ?? null;
        $address = $input['address'] ?? null;

        $id = intval(filter_var($id));
        $name = filter_var($name);
        $email = filter_var($email);
        $password = filter_var($password);
        $address = filter_var($address);

        if (!empty($id) && !empty($name) && !empty($email) && !empty($password) && !empty($address)) {

            $user = UserDao::get($id);

            if ($user != null) {
                $user->setName($name);
                $user->setEmail($email);
                $user->setPassword($password);
                $address = AddressDao::get($address);

                if ($address != null) {
                    $user->setAddress($address);
                } else {
                    http_response_code(404);
                    throw new \Exception('Address Not Found!');
                }

                if (UserDao::update($user)) {

                    http_response_code(200);
                    $data = 'User updated successfully!';
    
                } else {
                    http_response_code(400);
                    throw new \Exception('Bad Request! Error updating user!');
                }
            } else {
                http_response_code(404);
                throw new \Exception('User Not Found!');
            }

        } else {
            http_response_code(422);
            throw new \Exception('Unprocessable Entity! Required Data Not Sent');

        }

        return $data;
    }

    public static function delete()
    {
        $data = [];

        parse_str(file_get_contents('php://input'), $input);

        $id = $input['id'] ?? null;
        $id = intval(filter_var($id));


        if (!empty($id)) {

            $user = UserDao::get($id);

            if ($user != null) {
         
                if (UserDao::delete($id)) {

                    http_response_code(200);
                    $data = 'User deleted successfully!';
    
                } else {
                    http_response_code(400);
                    throw new \Exception('Bad Request! Error deleting user!');
                }
            } else {
                http_response_code(404);
                throw new \Exception('User Not Found!');
            }

        } else {
            http_response_code(422);
            throw new \Exception('Unprocessable Entity! Required Id Not Sent');

        }

        return $data;
    }
}
