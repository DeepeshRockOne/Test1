<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;

class LocationController extends Controller
{
    public function getStates($countryId)
    {
        return response()->json(State::where('country_id', $countryId)->get());
    }

    public function getCities($stateId)
    {
        return response()->json(City::where('state_id', $stateId)->get());
    }
}
