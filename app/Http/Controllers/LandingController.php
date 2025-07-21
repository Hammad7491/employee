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
        $cnp = $request->input('unique_id');

        // Validate if exactly 13 digits
        if (!preg_match('/^\d{13}$/', $cnp)) {
            return back()->with('cnp_error', true)->with('cnp_data', [
                'sex' => '', 'year' => 0, 'month' => 0,
                'day' => 0, 'county' => '', 'registration_code' => '', 'control_code' => 0
            ]);
        }

        // Try to find the person
        $person = Person::where('unique_id', $cnp)->first();

        if ($person) {
            return back()->with('cnp_data', [
                'sex' => substr($cnp, 0, 1),
                'year' => $person->year,
                'month' => $person->month,
                'day' => $person->day,
                'county' => $person->county,
                'registration_code' => $person->registration_code,
                'control_code' => $person->control_code
            ]);
        } else {
            return back()->with('verified', true); // Format valid, but not found
        }
    }
}
