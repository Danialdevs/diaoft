<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LicensesController extends Controller
{
    public function notLicense(){
        return view("pages.not-license");
    }
    public function licenses()
    {
        $school = Auth::user()->school;
        $licenses = $school->licenses;
        $activeLicense = $school->activeLicenses->first();
        return view("pages.licenses", compact("licenses", "activeLicense"));
    }
}
