@extends('Layout.layoutappoint')

@section('header')
<h1 class="display-3 text-white mb-3 animated slideInDown">Appointments</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center text-uppercase">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item text-white active" aria-current="page">Appointments</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container">
    <h1>Make an Appointment</h1>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="location">Full Name</label>
            <input type="text" name="full_name" id="full_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="service_center_id">Service Center</label>
            <select name="service_center_id" id="service_center_id" class="form-control">
                <option value="">Select Service Center</option>
                @foreach($serviceCenters as $serviceCenter)
                    <option value="{{ $serviceCenter->id }}">{{ $serviceCenter->service_center }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="services_id">Service</label>
            <select name="services_id" id="services_id" class="form-control">
                <option value="">Select Service</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="schedule_date">Schedule Date</label>
            <input type="date" name="schedule_date" id="schedule_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="schedule_time">Schedule Time</label>
            <input type="time" name="schedule_time" id="schedule_time" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Appointment</button>
    </form>

    <h2>Your Appointments</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Service Center</th>
                <th>Service</th>
                <th>Location</th>
                <th>Schedule Date</th>
                <th>Schedule Time</th>
                <th>Is Complete</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->full_name }}</td>
                    <td>{{ $appointment->serviceCenter->service_center }}</td>
                    <td>{{ $appointment->service }}</td>
                    <td>{{ $appointment->location }}</td>
                    <td>{{ $appointment->schedule_date }}</td>
                    <td>{{ $appointment->schedule_time }}</td>
                    <td>
                        @if($appointment->is_completed)
                            <i class="fas fa-check-circle text-success"></i>
                        @else
                            <i class="fas fa-times-circle text-danger"></i>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Cancel</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
