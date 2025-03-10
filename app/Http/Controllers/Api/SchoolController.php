<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Annotation\Route;

class SchoolController extends Controller
{
    public function index()
    {
        return School::all();
    }
    public function show($bin)
    {
        return School::where("bin", $bin)->first();
    }
}
