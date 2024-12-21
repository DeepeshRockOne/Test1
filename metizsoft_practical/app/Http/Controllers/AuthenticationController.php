<?php

namespace App\Http\Controllers;
use App\Models\EmployeeMaster;
use App\Models\Country;
use App\Models\LeaveBalance;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $employee = EmployeeMaster::where('username', $request->username)->first();

        if ($employee && Hash::check($request->password, $employee->password)) {
            Session::put('employee_id', $employee->id);
            Session::put('employee_name', $employee->employee_name);

            return redirect()->route('dashboard')->with('success', 'Logged in successfully.');
        }

        return redirect()->route('dashboard')->with('fail', 'Invalid username or password');
    }

    public function showRegistrationForm()
    {
        $countries = Country::all();
        return view('registration', compact('countries'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'employee_name' => 'required|string|max:255',
            'employee_code' => 'required|unique:employee_master,employee_code',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|unique:employee_master,username',
            'email' => 'required|email:rfc,dns|unique:employee_master,email',
            'phone' => 'required|integer|max:9999999999',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'address' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'zip' => 'required|integer|max:999999',
        ]);

        $employee = EmployeeMaster::create([
            'employee_name' => $request->employee_name,
            'employee_code' => $request->employee_code,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'zip' => $request->zip,
        ]);

        $leaveTypes = [
            ['leavetype' => 1, 'leavebalance' => 5],
            ['leavetype' => 2, 'leavebalance' => 10],
            ['leavetype' => 3, 'leavebalance' => 12],
            ['leavetype' => 4, 'leavebalance' => 15],
        ];

        foreach ($leaveTypes as $leaveType) {
            LeaveBalance::create([
                'leavetype' => $leaveType['leavetype'],
                'employeecode' => $employee->id,
                'leavebalance' => $leaveType['leavebalance'],
            ]);
        }

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    public function dashboard()
    {
        $employeeId = session('employee_id');
        $employee = EmployeeMaster::find($employeeId);
        return view('dashboard', compact('employee'));
    }

    public function showProfile()
    {
        $employee = $this->getAuthenticatedEmployee();

        $countries = Country::all();
        $states = $employee->country->states ?? [];
        $cities = $employee->state->cities ?? [];

        return view('profile', compact('employee', 'countries', 'states', 'cities'));
    }

    public function updateProfile(Request $request)
    {
        $employee = $this->getAuthenticatedEmployee();

        $request->validate([
            'employee_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|unique:employee_master,username,' . $employee->id,
            'email' => 'required|email:rfc,dns|unique:employee_master,email,' . $employee->id,
            'phone' => 'required|integer|max:9999999999',
            'address' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'zip' => 'required|integer|max:999999',
        ]);

        $emp = EmployeeMaster::find($employee->id);

        $emp->update([
            'employee_name' => $request->employee_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'zip' => $request->zip,
        ]);

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }

    private function getAuthenticatedEmployee()
    {
        $employeeId = session('employee_id');

        if (!$employeeId) {
            abort(403, 'Unauthorized action.');
        }

        return EmployeeMaster::findOrFail($employeeId);
    }
}
