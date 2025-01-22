<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function schoolsIndex()
    {
        $schools = School::all();
        return view('pages.admin.schools.index', compact("schools"));
    }
}
