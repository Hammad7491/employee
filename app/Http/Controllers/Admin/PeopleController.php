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
    $query = \App\Models\Person::query();

    if ($search = $request->get('search')) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('unique_id', 'like', '%' . $search . '%')
              ->orWhere('company', 'like', '%' . $search . '%');
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
            'name'      => 'required|string|max:255',
            'unique_id' => 'required|digits:12|unique:people,unique_id',
            'gender'    => 'required|in:Male,Female,Other',
            'age'       => 'required|integer|min:1|max:120',
            'company'   => 'required|string|max:255',
        ]);

        Person::create($request->only(['name', 'unique_id', 'gender', 'age', 'company']));

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
            'name'      => 'required|string|max:255',
            'unique_id' => 'required|digits:12|unique:people,unique_id,' . $user->id,
            'gender'    => 'required|in:Male,Female,Other',
            'age'       => 'required|integer|min:1|max:120',
            'company'   => 'required|string|max:255',
        ]);

        $user->update($request->only(['name', 'unique_id', 'gender', 'age', 'company']));

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
}
