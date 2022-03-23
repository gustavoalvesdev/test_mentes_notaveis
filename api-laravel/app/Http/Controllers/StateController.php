<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function all()
    {

        $array = [];

        $array['status'] = 'success';
        $array['data'] = State::all();

        return response()->json($array, 200);

    }
}
