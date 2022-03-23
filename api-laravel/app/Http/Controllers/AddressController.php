<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function all()
    {
        $array = [];
        $addresses = Address::all();

        $array['status'] = 'success';

        foreach($addresses as $address) {

            $city = City::find($address->city);
            $state = State::find($city->state);
            $array['data'][] = [
                'id' => $address->id,
                'public_place' => $address->public_place,
                'place_number' => $address->place_number,
                'zip_code' => $address->zip_code,
                'complement' => $address->complement,
                'district' => $address->district,
                'city' => $city->name,
                'state' => $state->name
            ];

        }

        return response()->json($array, 200);

    }

    public function get($id)
    {
        $array = [];
        $address = Address::find($id);

        if ($address) {

            $city = City::find($address->city);
            $state = State::find($city->state);

            $array['status'] = 'success';
            $array['data'] = [
                'id' => $address->id,
                'public_place' => $address->public_place,
                'place_number' => $address->place_number,
                'zip_code' => $address->zip_code,
                'complement' => $address->complement,
                'district' => $address->district,
                'city' => $city->name,
                'state' => $state->name
            ];

            return response()->json($array, 200);

        } else {
            $array['status'] = 'error';
            $array['data'] = 'Address Not Found';
            return response()->json($array, 404);
        }
    }

}
