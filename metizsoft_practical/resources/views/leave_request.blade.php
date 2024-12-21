<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex" style="height: 100vh;">
        <nav class="bg-dark text-white p-3" style="width: 250px;">
            <h4 class="text-center mb-4">Leave Request</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white">Home</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('leave.list') }}" class="nav-link text-white">Your Leave Details</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('leave.form') }}" class="nav-link text-white">Apply Leave Here</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" data-bs-toggle="collapse" href="#reportsMenu" role="button" aria-expanded="false" aria-controls="reportsMenu">Reports</a>
                    <div class="collapse" id="reportsMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a href="{{ route('leave.report') }}" class="nav-link text-white">Leave Report</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link text-white">Report2</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link text-white">Report3</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="flex-grow-1">
            <header class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
                <div class="container-fluid">
                    <span class="navbar-brand">Leave Request</span>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}">View Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </header>

            <div class="p-4">
                <div class="container">
                    <h2>Leave Request</h2>
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
                    
                    <form id="leaveRequestForm" action="{{ route('leave.submit') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="employee_code">Employee Code</label>
                            <input type="text" id="employee_code" name="employee_code" class="form-control" value="{{ $employee->employee_code }}" readonly="readonly">
                            @error('employee_code')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="from_date">From Date</label>
                            <input type="date" id="from_date" name="from_date" class="form-control" value="{{ old('from_date') }}">
                            @error('from_date')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="to_date">To Date</label>
                            <input type="date" id="to_date" name="to_date" class="form-control" value="{{ old('to_date') }}">
                            @error('to_date')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="leavetype">Leave Type</label>
                            <select id="leavetype" name="leavetype" class="form-control">
                                <option value="">Select Leave Type</option>
                                @foreach($leaveTypes as $leave)
                                    <option value="{{ $leave->id }}" {{ old('leavetype') == $leave->id ? 'selected' : '' }}>{{ $leave->leaveType }}</option>
                                @endforeach
                            </select>
                            @error('leavetype')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea id="comment" name="comment" class="form-control" rows="3" maxlength="300" placeholder="Enter comment">{{ old('comment') }}</textarea>
                            @error('comment')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var myCollapse = document.getElementById('reportsMenu');
        var bsCollapse = new bootstrap.Collapse(myCollapse, {
            toggle: false
        });
    });
</script>
