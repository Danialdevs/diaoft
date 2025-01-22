<?php

namespace App\Http\Controllers;

use App\Http\Requests\TerminalRateRequest;
use App\Models\Device;
use App\Models\Rate;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TerminalController extends Controller
{
    public function show(Request $request, $id)
    {
      
            $school = School::where("id", $id)->firstOrFail();
            return view("pages.terminal", ["school" => $school]);
       
	}

    public function rate($id, TerminalRateRequest $request)
    {

        $school = School::where("id", $id)->firstOrFail();

        $rate = Rate::create([
           "school_id" => $request->id,
           "score" => $request->get("score"),
            "grade" => $request->get("grade"),
        ]);
        return response()->json([
            "message" => "test",
            "status" => "success",
        ]);
    }
    public function systemInstall(Request $request, $id)
    {

        if ($request->isMethod('get')) {
            return view("pages.systemInstall");
        }

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'qr_data' => 'required|string|size:32|regex:/^[a-f0-9]{32}$/i',
            ]);

            $device = new Device();
            $device->school_id = $id;
            $device->device_Id = $validated['qr_data'];
            $device->save();

            return redirect()->back();
        }
    }
}
