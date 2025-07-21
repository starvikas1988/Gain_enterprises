<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Driver;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->can(request()->segment(2))) {
                return $next($request);
            }
            abort(403);
        });
    }

    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('admin.driver.header', ['title' => 'Driver List']);
        }

        $limit = 10;
        $page = $request->input('page', 1); // default to page 1 if not set
        $serial = [($limit * ($page - 1)) + 1];

        $query = Driver::query();

        // Search Filters
        if ($request->input('skey')) {
            $skey = $request->input('skey');
            $query->where(function ($q) use ($skey) {
                $q->where('name', 'LIKE', '%' . $skey . '%')
                  ->orWhere('phone', 'LIKE', '%' . $skey . '%')
                  ->orWhere('email', 'LIKE', '%' . $skey . '%');
            });
        }

        if ($request->input('sstat')) {
            $query->where('status', $request->input('sstat'));
        }

        if ($request->input('sdate')) {
            $query->whereDate('created_at', $request->input('sdate'));
        }

        $count = $query->count();
        $result = $query->orderBy('id', 'DESC')->paginate($limit);

        return view('admin.driver.table', ['serial' => $serial, 'count' => $count, 'result' => $result]);
    }

    public function create()
    {
        return view('admin.driver.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required',
            'email'          => 'nullable|email',
            'phone'          => 'required|numeric|unique:drivers,phone',
            'license_number' => 'required|unique:drivers,license_number',
        ], [
            'phone.required' => 'Phone number is required',
            'phone.unique'   => 'Phone number is already registered',
            'license_number.required' => 'License number is required',
            'license_number.unique'   => 'License number must be unique',
            'email.email'    => 'Please enter a valid email address',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.driver.create'))->withErrors($validator)->withInput();
        }

        $driver = new Driver;
        $driver->name = $request->name;
        $driver->email = $request->email;
        $driver->phone = $request->phone;
        $driver->license_number = $request->license_number;
        $driver->address = $request->address;
        $driver->date_of_birth = $request->date_of_birth;
        $driver->vehicle_type = $request->vehicle_type;
        $driver->status = 'A'; // default to active
        $driver->save();

        return redirect(route('admin.drivers'))->withSuccess('Driver added successfully');
    }

    public function show($id)
    {
        $driver = Driver::findOrFail($id);
        return view('admin.driver.show', compact('driver'));
    }

    public function edit(Request $request)
    {
        $driver = Driver::findOrFail($request->id);
        return view('admin.driver.edit', compact('driver'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required',
            'email'          => 'nullable|email',
            'phone'          => 'required|numeric|unique:drivers,phone,' . $request->id,
            'license_number' => 'required|unique:drivers,license_number,' . $request->id,
        ], [
            'phone.required' => 'Phone number is required',
            'phone.unique'   => 'Phone number is already registered',
            'license_number.required' => 'License number is required',
            'license_number.unique'   => 'License number must be unique',
            'email.email'    => 'Please enter a valid email address',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.driver.edit', ['id' => $request->id]))->withErrors($validator)->withInput();
        }

        $driver = Driver::find($request->id);
        $driver->name = $request->name;
        $driver->email = $request->email;
        $driver->phone = $request->phone;
        $driver->license_number = $request->license_number;
        $driver->address = $request->address;
        $driver->date_of_birth = $request->date_of_birth;
        $driver->vehicle_type = $request->vehicle_type;
        $driver->status = $request->status ?? 'A';
        $driver->save();

        return redirect(route('admin.drivers'))->withSuccess('Driver updated successfully');
    }

    public function destroy(Request $request)
    {
        Driver::findOrFail($request->id)->delete();
        return redirect(route('admin.drivers'))->withSuccess('Driver deleted successfully');
    }
}

?>