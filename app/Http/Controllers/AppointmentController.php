<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAppointment;
use App\Models\ServiceCenter;
use App\Models\Services;
use App\Models\User;
use Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $serviceCenters = ServiceCenter::all();
        $services = Services::all();
        $appointments = UserAppointment::where('user_id', Auth::id())->with( 'serviceCenter', 'services')->get();

        return view('pages.appointment', compact('users', 'serviceCenters', 'services', 'appointments'));
    }

    // AppointmentsController.php
public function store(Request $request)
{
    $validatedData = $request->validate([
        'full_name' => 'required',
        'service_center_id' => 'required',
        'services_id' => 'required',
        'location' => 'required',
        'schedule_date' => 'required',
        'schedule_time' => 'required',
    ]);

    $user_id = Auth::id();

    $appointment = new UserAppointment();
    $appointment->user_id = $user_id;
    $appointment->full_name = $validatedData['full_name'];
    $appointment->service_center_id = $validatedData['service_center_id'];
    $appointment->services_id = $validatedData['services_id'];
    $appointment->location = $validatedData['location'];
    $appointment->schedule_date = $validatedData['schedule_date'];
    $appointment->schedule_time = $validatedData['schedule_time'];
    $appointment->save();

    return redirect()->route('appointments.index')->with('message', 'Appointment created successfully');
}

    public function destroy($id)
    {
        $appointment = UserAppointment::findOrFail($id);
        if ($appointment->user_id == Auth::id()) {
            $appointment->delete();
            return redirect()->back()->with('message', 'Appointment canceled successfully.');
        }

        return redirect()->back()->with('error', 'You are not authorized to cancel this appointment.');
    }
}