<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card p-4 shadow" style="width: 100%; max-width: 800px;">
            @if (session('fail'))
                <span class="alert alert-danger text-center">
                    {{session('fail')}}
                </span>
            @endif
            @if (session('success'))
				<span class="alert alert-success text-center">
					{{session('success')}}
				</span>
			@endif
            <h3 class="text-center mb-4">Register</h3>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="employee_name" class="form-label">Employee Name</label>
                        <input type="text" name="employee_name" id="employee_name" class="form-control" placeholder="Enter employee name" value="{{ old('employee_name') }}">
                    </div>
                    @error('employee_name')
                        <span class="alert alert-danger">{{$message}}</span>
                    @enderror
                    <div class="col-md-6">
                        <label for="employee_code" class="form-label">Employee Code</label>
                        <input type="text" name="employee_code" id="employee_code" class="form-control" placeholder="Enter employee code" value="{{ old('employee_code') }}">
                    </div>
                    @error('employee_code')
                        <span class="alert alert-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter first name" value="{{ old('first_name') }}">
                    </div>
                    @error('first_name')
                        <span class="alert alert-danger">{{$message}}</span>
                    @enderror
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter last name" value="{{ old('last_name') }}">
                    </div>
                    @error('last_name')
                        <span class="alert alert-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" value="{{ old('username') }}">
                </div>
                @error('username')
                    <span class="alert alert-danger">{{$message}}</span>
                @enderror

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}">
                </div>
                @error('email')
                    <span class="alert alert-danger">{{$message}}</span>
                @enderror

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone number" value="{{ old('phone') }}">
                </div>
                @error('phone')
                    <span class="alert alert-danger">{{$message}}</span>
                @enderror

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" value="{{ old('password') }}">
                    </div>
                    @error('password')
                        <span class="alert alert-danger">{{$message}}</span>
                    @enderror
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm password">
                    </div>
                    @error('password_confirmation')
                        <span class="alert alert-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" class="form-control" rows="3" placeholder="Enter address">{{ old('address') }}</textarea>
                </div>
                @error('address')
                    <span class="alert alert-danger">{{$message}}</span>
                @enderror

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="country_id" class="form-label">Country</label>
                        <select name="country_id" id="country_id" class="form-select">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('country_id')
                        <span class="alert alert-danger">{{$message}}</span>
                    @enderror
                    <div class="col-md-4">
                        <label for="state_id" class="form-label">State</label>
                        <select name="state_id" id="state_id" class="form-select">
                            <option value="">Select State</option>
                        </select>
                    </div>
                    @error('state_id')
                        <span class="alert alert-danger">{{$message}}</span>
                    @enderror
                    <div class="col-md-4">
                        <label for="city_id" class="form-label">City</label>
                        <select name="city_id" id="city_id" class="form-select">
                            <option value="">Select City</option>
                        </select>
                    </div>
                    @error('city_id')
                        <span class="alert alert-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="zip" class="form-label">Zip Code</label>
                    <input type="text" name="zip" id="zip" class="form-control" placeholder="Enter zip code" value="{{ old('zip') }}">
                </div>
                @error('zip')
                    <span class="alert alert-danger">{{$message}}</span>
                @enderror

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="{{ route('login') }}">Login here</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function() {
        $('#country_id').change(function() {
            let countryId = $(this).val();
            $('#state_id').prop('disabled', !countryId).html('<option value="">Select State</option>');
            $('#city_id').prop('disabled', true).html('<option value="">Select City</option>');

            if (countryId) {
                $.ajax({
                    url: '/get-states/' + countryId,
                    type: 'GET',
                    success: function(states) {
                        states.forEach(state => {
                            $('#state_id').append(`<option value="${state.id}">${state.name}</option>`);
                        });
                    }
                });
            }
        });

        $('#state_id').change(function() {
            let stateId = $(this).val();
            $('#city_id').prop('disabled', !stateId).html('<option value="">Select City</option>');

            if (stateId) {
                $.ajax({
                    url: '/get-cities/' + stateId,
                    type: 'GET',
                    success: function(cities) {
                        cities.forEach(city => {
                            $('#city_id').append(`<option value="${city.id}">${city.name}</option>`);
                        });
                    }
                });
            }
        });
    });
</script>
