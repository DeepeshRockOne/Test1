<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaves</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex" style="height: 100vh;">
        <nav class="bg-dark text-white p-3" style="width: 250px;">
            <h4 class="text-center mb-4">Leaves</h4>
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
                    <span class="navbar-brand">Leaves</span>
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
                    <h2>Leaves</h2>
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
                    
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Leave Type</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Number of Days</th>
                                <th>Leave Balance</th>
                                <th>Comment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($leaveRecordsWithBalance) > 0)
                                @foreach($leaveRecordsWithBalance as $record)
                                <tr>
                                    <td>{{ $record->id }}</td>
                                    <td>{{ $record->leavetype }}</td>
                                    <td>{{ $record->fromdate }}</td>
                                    <td>{{ $record->todate }}</td>
                                    <td>{{ $record->numberofDays }}</td>
                                    <td>{{ $record->leave_balance }}</td>
                                    <td>{{ $record->comment }}</td>
                                    <td>
                                        <a href="{{ route('leave.edit', $record->id) }}" class="btn btn-primary">Edit</a>
                                        <a href="{{ route('leave.delete', $record->id) }}" class="btn btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this leave request?')">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">There is no record</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
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
