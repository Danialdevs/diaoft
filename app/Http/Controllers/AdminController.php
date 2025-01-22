<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\School;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function schoolsIndex()
    {
        $schools = School::all();
        return view('pages.admin.schools.index', compact("schools"));
    }
    public function schoolsEdit($id)
    {

        $school = School::findOrFail($id);
        $cities = City::all();
        return view('pages.admin.schools.edit', compact('school', 'cities'));
    }
    public function schoolsAddLicense()
    {

    }
}
