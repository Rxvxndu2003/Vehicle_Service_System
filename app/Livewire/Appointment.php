<?php

use Livewire\Component;
use App\Models\User;
use App\Models\ServiceCenter;
use App\Models\Service;
use App\Models\Appointment;

class Appointment extends Component
{
    public $appointments;
    public $users;
    public $serviceCenters;
    public $services;
    public $user_id;
    public $service_center_id;
    public $service_id;
    public $location;
    public $schedule_date;
    public $schedule_time;

    public function mount()
    {
        $this->users = User::all();
        $this->serviceCenters = ServiceCenter::all();
        $this->services = Service::all();
        $this->appointments = Appointment::with('user', 'serviceCenter', 'service')->get();
    }

    public function createAppointment()
    {
        $this->validate([
            'user_id' => 'required',
            'service_center_id' => 'required',
            'service_id' => 'required',
            'location' => 'nullable|string',
            'schedule_date' => 'required|date',
            'schedule_time' => 'required',
        ]);

        Appointment::create([
            'user_id' => $this->user_id,
            'service_center_id' => $this->service_center_id,
            'service_id' => $this->service_id,
            'location' => $this->location,
            'schedule_date' => $this->schedule_date,
            'schedule_time' => $this->schedule_time,
        ]);

        session()->flash('message', 'Appointment created successfully.');

        $this->resetForm();
        $this->appointments = Appointment::with('user', 'serviceCenter', 'service')->get();
    }

    private function resetForm()
    {
        $this->user_id = '';
        $this->service_center_id = '';
        $this->service_id = '';
        $this->location = '';
        $this->schedule_date = '';
        $this->schedule_time = '';
    }

    public function render()
    {
        return view('livewire.user-appointments', [
            'users' => $this->users,
            'serviceCenters' => $this->serviceCenters,
            'services' => $this->services,
            'appointments' => $this->appointments,
        ]);
    }
}