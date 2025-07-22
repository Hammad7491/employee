<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Models\Person;

class DashboardController extends Controller
{
   public function index()
{
    $totalPeople = Person::count();

    $genderStats = Person::select('gender', DB::raw('COUNT(*) as total'))
        ->groupBy('gender')
        ->pluck('total', 'gender')
        ->toArray();

    return view('admin.dashboard', compact('totalPeople', 'genderStats'));
}
}
