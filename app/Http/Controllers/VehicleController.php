<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserVehicle;
use App\Models\User;
use Auth;

class VehicleController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $vehicles = UserVehicle::where('user_id', Auth::id())->get();

        return view('pages.vehicle', compact('users', 'vehicles'));
    }

    // AppointmentsController.php

public function store(Request $request)
{
    $validatedData = $request->validate([
        'full_name' => 'required',
        'vehicle_name' => 'required',
        'vehicle_number' => 'required',
        'made' => 'required',
    ]);

    $user_id = Auth::id();

    $vehicles = new UserVehicle();
    $vehicles->user_id = $user_id;
    $vehicles->full_name = $validatedData['full_name'];
    $vehicles->vehicle_name = $validatedData['vehicle_name'];
    $vehicles->vehicle_number= $validatedData['vehicle_number'];
    $vehicles->made = $validatedData['made'];
    $vehicles->save();

    return redirect()->route('vehicles.index')->with('message', 'Vehicle add successfully');
}

    public function destroy($id)
    {
        $vehicles = UserVehicle::findOrFail($id);
        if ($vehicles->user_id == Auth::id()) {
            $vehicles->delete();
            return redirect()->back()->with('message', 'Vehicle delete successfully.');
        }

        return redirect()->back()->with('error', 'You are not authorized to delete this vehicle.');
    }
}