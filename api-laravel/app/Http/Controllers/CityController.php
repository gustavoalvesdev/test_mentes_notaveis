<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function all()
    {
        $array = [];
        $cities = City::all();

        $array['status'] = 'success';

        foreach($cities as $city) {
            $state = State::find($city->state);
            $array['data'][] = [
                'id' => $city->id,
                'name' => $city->name,
                'state' => $state->name
            ];
        }

        return response()->json($array, 200);

    }

    public function get($id)
    {

        $array = [];
        $city = City::find($id);

        if ($city) {

            $state = State::find($city->state);

            $array['status'] = 'success';
            $array['data'] = [
                'id' => $city->id,
                'name' => $city->name,
                'state' => $state->name
            ];
            return response()->json($array, 200);
        } else {
            $array['status'] = 'error';
            $array['data'] = 'City Not Found';
            return response()->json($array, 404);
        }

    }
}
