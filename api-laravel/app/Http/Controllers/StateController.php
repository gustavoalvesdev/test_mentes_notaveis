<?php

namespace App\Http\Controllers;

use App\Models\State;

class StateController extends Controller
{
    public function all()
    {

        $array = [];

        $array['status'] = 'success';
        $array['data'] = State::all();

        return response()->json($array, 200);

    }

    public function get($id)
    {
        $array = [];
        $state = State::find($id);

        if ($state) {

            $array['status'] = 'success';
            $array['data'] = $state;

            return response()->json($array, 200);

        } else {
            $array['status'] = 'error';
            $array['data'] = 'State Not Found';
            return response()->json($array, 404);
        }

    }
}
