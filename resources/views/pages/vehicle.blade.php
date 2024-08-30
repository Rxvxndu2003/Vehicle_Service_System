@extends('Layout.layoutvehicle')

@section('header')
<h1 class="display-3 text-white mb-3 animated slideInDown">Vehicle</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center text-uppercase">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item text-white active" aria-current="page">Vehicle</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container">
    <h1>Add a Vehicle</h1>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('vehicles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="location">Full Name</label>
            <input type="text" name="full_name" id="full_name" class="form-control">
        </div>

        <div class="form-group">
            <label for="vehicle_name">Vehicle Name</label>
            <input type="text" name="vehicle_name" id="vehicle_name" class="form-control">
        </div>

        <div class="form-group">
            <label for="vehicle_number">Vehicle Number</label>
            <input type="text" name="vehicle_number" id="vehicle_number" class="form-control">
        </div>

        <div class="form-group">
            <label for="made">Made</label>
            <input type="date" name="made" id="made" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Add Vehicle</button>
    </form>

    <h2>Your Vehicles</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Vehicle Name</th>
                <th>Vehicle Number</th>
                <th>Made</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->full_name }}</td>
                    <td>{{ $vehicle->vehicle_name }}</td>
                    <td>{{ $vehicle->vehicle_number}}</td>
                    <td>{{ $vehicle->made }}</td>
                    <td>
                        <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection