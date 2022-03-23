<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function all()
    {
        $array = [];
        $users = User::all();

        $array['status'] = 'success';

        foreach($users as $user) {

            $address = Address::find($user->address);
            $city = City::find($address->city);
            $state = State::find($city->state);

            $array['data'][] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'address' => [
                    'public_place' => $address->public_place,
                    'place_number' => $address->place_number,
                    'zip_code' => $address->zip_code,
                    'complement' => $address->complement,
                    'district' => $address->district,
                    'city' => $city->name,
                    'state' => $state->name
                ]
            ];
        }
        return response()->json($array, 200);
    }

    public function get($id)
    {
        $array = [];
        $user = User::find($id);

        if ($user) {

            $address = Address::find($user->address);
            $city = City::find($address->city);
            $state = State::find($city->state);

            $array['status'] = 'success';

            $array['data'] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'address' => [
                    'public_place' => $address->public_place,
                    'place_number' => $address->place_number,
                    'zip_code' => $address->zip_code,
                    'complement' => $address->complement,
                    'district' => $address->district,
                    'city' => $city->name,
                    'state' => $state->name
                ]
            ];

            return response()->json($array, 200);

        }

        $array['status'] = 'error';
        $array['data'] = 'User Not Found';
        return response()->json($array, 404);

    }

    public function update(Request $request, $id)
    {
        $array = [];

        $rules = [
            'name' => 'min:2',
            'email' => 'email',
            'password' => 'min:3',
            'address' => 'integer'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $array['status'] = 'error';
            $array['data'] = $validator->getMessageBag();
            return response()->json($array, 422);
        }

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $address = $request->input('address');

        $user = User::find($id);

        if ($user) {

            if ($name) {
                $user->name = $name;
            }

            if ($email) {
                $user->email = $email;
            }

            if ($password) {
                $user->password = $password;
            }

            if ($address) {
                $address = Address::find($address);

                if ($address) {
                    $user->address = $address->id;
                } else {

                    $array['status'] = 'error';
                    $array['data'] = 'Address Not Found';
                    return response()->json($array, 404);
                }

            }

            $user->save();

            $array['status'] = 'success';
            $array['data'] = 'User ' . $id . ' updated successfully';

            return response()->json($array, 200);
        }

        $array['status'] = 'error';
        $array['data'] = 'User ' . $id . ' Not Found, thus it can\'t be updated';

        return response()->json($array, 404);
    }
}
