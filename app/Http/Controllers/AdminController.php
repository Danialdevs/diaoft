<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\License;
use App\Models\School;
use Illuminate\Support\Facades\Request;

class AdminController extends Controller
{
    public function schoolsIndex()
    {
        $schools = School::all();

        return view('pages.admin.schools.index', compact('schools'));
    }

    public function schoolsEdit($id)
    {

        $school = School::findOrFail($id);
        $cities = City::all();

        return view('pages.admin.schools.edit', compact('school', 'cities'));
    }
    function generateLicenseNumber()
    {
        $letters = strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 4));

        $numbers = rand(1000, 9999);

        return $letters . '-' . $numbers;
    }

    public function schoolsAddLicense(\Illuminate\Http\Request $request, $id) {
        License::create([
            'school_id' => $id,
            'issue_date' => $request->input('issue_date'),
            'expiry_date' => $request->input('expiry_date'),
            'status' => "active",
            "license_number" => $this->generateLicenseNumber()
        ]);
        return redirect()->back();
    }
}
