@extends('Layout.layoutaddress')

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
   
        <h2>Add Address</h2>

        <!-- Check for validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Address Form -->
       <!-- Address Form -->
<form action="{{ route('addresses.store') }}" method="POST" class="address-form">
    @csrf
    <input type="hidden" id="address_id" name="address_id">
    <div class="form-group">
        <label for="street">Street</label>
        <input type="text" name="street" class="form-control" id="street" required>
    </div>
    <div class="form-group">
        <label for="city">City</label>
        <input type="text" name="city" class="form-control" id="city" required>
    </div>
    <div class="form-group">
        <label for="state">State</label>
        <input type="text" name="state" class="form-control" id="state" required>
    </div>
    <div class="form-group">
        <label for="country">Country</label>
        <input type="text" name="country" class="form-control" id="country" required>
    </div>
    <div class="form-group">
        <label for="postal_code">Postal Code</label>
        <input type="text" name="postal_code" class="form-control" id="postal_code" required>
    </div>

    <button type="submit" class="btn btn-primary" id="save-btn">Add Address</button>
</form>

<!-- Table to display addresses -->
<table class="table table-striped address-table mt-3" id="address-table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Street</th>
            <th scope="col">City</th>
            <th scope="col">State</th>
            <th scope="col">Country</th>
            <th scope="col">Postal Code</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Addresses will be loaded here via AJAX -->
    </tbody>
</table>

<!-- Include jQuery and AJAX scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // CSRF token setup for AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Load all addresses via AJAX on page load
        loadAddresses();

        function loadAddresses() {
            $.get("{{ route('addresses.index') }}", function(data) {
                let tableRows = '';
                $.each(data, function(index, address) {
                    tableRows += '<tr id="row_' + address.id + '">';
                    tableRows += '<td>' + address.street + '</td>';
                    tableRows += '<td>' + address.city + '</td>';
                    tableRows += '<td>' + address.state + '</td>';
                    tableRows += '<td>' + address.country + '</td>';
                    tableRows += '<td>' + address.postal_code + '</td>';
                    tableRows += '<td><button class="btn btn-danger btn-sm delete-btn" data-id="' + address.id + '">Delete</button></td>';
                    tableRows += '</tr>';
                });
                $('#address-table tbody').html(tableRows);
            });
        }

// Fetch Address Data for Editing via AJAX
$(document).on('click', '.edit-btn', function(e) {
    e.preventDefault();

    let addressId = $(this).data('id'); // Get the ID from the button's data attribute
    let fetchUrl = "/addresses/" + addressId + "/edit"; // URL for fetching the address data

    $.ajax({
        type: 'GET',
        url: fetchUrl,
        success: function(response) {
            // Populate the form with the fetched data
            $('#street').val(response.street);
            $('#city').val(response.city);
            $('#state').val(response.state);
            $('#country').val(response.country);
            $('#postal_code').val(response.postal_code);

            // Set the form action for updating the address
            $('#addressForm').attr('action', '/addresses/' + addressId);
            $('#addressForm').append('<input type="hidden" name="_method" value="PUT">');
        },
        error: function(response) {
            console.log('Error:', response);
        }
    });
});

// Update Address via AJAX
$('#addressForm').on('submit', function(e) {
    e.preventDefault();

    let formData = $(this).serialize(); // Serialize form data
    let updateUrl = $(this).attr('action'); // Get the form action (update URL)

    $.ajax({
        type: 'POST',
        url: updateUrl,
        data: formData,
        success: function(response) {
            alert('Address updated successfully!');
            loadAddresses(); // Refresh the address list
        },
        error: function(response) {
            console.log('Error:', response);
        }
    });
});


$(document).on('click', '.delete-btn', function(e) {
    e.preventDefault();

    let addressId = $(this).data('id'); // Get the ID from the button's data attribute
    let deleteUrl = "/addresses/" + addressId;

    if (confirm('Are you sure you want to delete this address?')) {
        $.ajax({
            type: 'DELETE',
            url: deleteUrl,
            data: {
                _token: "{{ csrf_token() }}" // Include the CSRF token for security
            },
            success: function(response) {
                alert('Address deleted successfully!');
                loadAddresses(); // Refresh the address list
            },
            error: function(response) {
                console.log('Error:', response);
            }
        });
    }
});

    });
</script>
@endsection
