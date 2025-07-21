<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;

class PeopleController extends Controller
{
    // Show all people (Admin list)
    public function index(Request $request)
    {
        $query = Person::query();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('unique_id', 'like', '%' . $search . '%')
                  ->orWhere('county', 'like', '%' . $search . '%');
            });
        }

        $people = $query->latest()->get();

        return view('admin.people.index', compact('people'));
    }

    // Show create form
    public function create()
    {
        return view('admin.people.create');
    }

    // Store new person
    public function store(Request $request)
    {
        $request->validate([
            'unique_id'         => 'required|digits:13|unique:people,unique_id',
            'year'              => 'required|integer|digits:4',
            'month'             => 'required|integer|min:1|max:12',
            'day'               => 'required|integer|min:1|max:31',
            'county'            => 'required|string|max:255',
            'registration_code' => 'required|integer',
            'control_code'      => 'required|integer',
        ]);

        Person::create($request->only([
            'unique_id', 'year', 'month', 'day', 'county',
            'registration_code', 'control_code'
        ]));

        return redirect()->route('admin.people.index')
                         ->with('success', 'Person added successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $user = Person::findOrFail($id);
        return view('admin.people.create', compact('user'));
    }

    // Update person
    public function update(Request $request, $id)
    {
        $user = Person::findOrFail($id);

        $request->validate([
            'unique_id'         => 'required|digits:13|unique:people,unique_id,' . $user->id,
            'year'              => 'required|integer|digits:4',
            'month'             => 'required|integer|min:1|max:12',
            'day'               => 'required|integer|min:1|max:31',
            'county'            => 'required|string|max:255',
            'registration_code' => 'required|integer',
            'control_code'      => 'required|integer',
        ]);

        $user->update($request->only([
            'unique_id', 'year', 'month', 'day', 'county',
            'registration_code', 'control_code'
        ]));

        return redirect()->route('admin.people.index')
                         ->with('success', 'Person updated successfully.');
    }

    // Delete person
    public function destroy($id)
    {
        $user = Person::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.people.index')
                         ->with('success', 'Person deleted successfully.');
    }

    // Search from landing page
    public function search(Request $request)
{
    $cnp = $request->input('unique_id');

    // Invalid CNP: not 13 digits or non-numeric
    if (strlen($cnp) !== 13 || !is_numeric($cnp)) {
        $parsed = $this->parseCNP($cnp);
        return back()
            ->with('cnp_error', true)
            ->with('entered_cnp', $cnp)
            ->with('cnp_data', $parsed);
    }

    // Check if CNP exists in DB
    $user = Person::where('unique_id', $cnp)->first();

    if ($user) {
        $parsed = [
            'sex' => $user->gender ?? 'N/A',
            'year' => $user->year,
            'month' => $user->month,
            'day' => $user->day,
            'county' => $user->county,
            'registration_code' => $user->registration_code,
            'control_code' => $user->control_code,
        ];
        return back()
            ->with('cnp_data', $parsed)
            ->with('entered_cnp', $cnp);
    } else {
        return back()
            ->with('verified', true)
            ->with('entered_cnp', $cnp);
    }
}

    // Helper to parse incomplete/invalid CNP
    private function parseCNP($cnp)
{
    $cnp = str_pad(preg_replace('/\D/', '', $cnp), 13, '0', STR_PAD_RIGHT);
    
    $parsed = [
        'sex' => 'Unknown',
        'year' => 0,
        'month' => 0,
        'day' => 0,
        'county' => '',
        'registration_code' => '',
        'control_code' => 0,
    ];

    if (strlen($cnp) >= 1) {
        $parsed['sex'] = (int)$cnp[0] % 2 === 1 ? 'Male' : 'Female';
    }
    if (strlen($cnp) >= 3) {
        $parsed['year'] = (int)substr($cnp, 1, 2);
    }
    if (strlen($cnp) >= 5) {
        $parsed['month'] = (int)substr($cnp, 3, 2);
    }
    if (strlen($cnp) >= 7) {
        $parsed['day'] = (int)substr($cnp, 5, 2);
    }
    if (strlen($cnp) >= 9) {
        $parsed['county'] = substr($cnp, 7, 2);
    }
    if (strlen($cnp) >= 12) {
        $parsed['registration_code'] = substr($cnp, 9, 3);
    }
    if (strlen($cnp) === 13) {
        $parsed['control_code'] = $cnp[12];
    }

    return $parsed;
}

}
