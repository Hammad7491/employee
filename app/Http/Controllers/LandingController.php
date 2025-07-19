<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class LandingController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function searchPerson(Request $request)
    {
        $request->validate([
            'unique_id' => 'required|digits:12'
        ]);

        $person = Person::where('unique_id', $request->unique_id)->first();

        if ($person) {
            return response()->json([
                'status' => 'success',
                'data' => $person
            ]);
        } else {
            return response()->json([
                'status' => 'not_found'
            ]);
        }
    }
}
