<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Trip;
use App\Models\Driver;
use App\Models\Route;
use App\Models\Store;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TripController extends Controller
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
            return view('admin.trip.header', ['title' => 'Trip List']);
        }

        $limit = 10;
        $serial[] = ($request->input('page') == 0) ? 1 : (($limit * ($request->input('page') - 1)) + 1);
        $query = Trip::with(['driver', 'route']);

        if ($request->input('skey')) {
            $query->whereHas('driver', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('skey') . '%');
            });
        }

        if ($request->input('sdate')) {
            $query->whereDate('created_at', $request->input('sdate'));
        }

        $count = $query->count();
        $result = $query->orderBy('id', 'DESC')->paginate($limit);

        return view('admin.trip.table', compact('serial', 'count', 'result'));
    }

    public function create()
    {
        $drivers = Driver::all();
        $routes = Route::with('stores')->get();
        return view('admin.trip.create', compact('drivers', 'routes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'route_id' => 'required|exists:routes,id',
        ]);

        DB::transaction(function () use ($request) {
            $trip = Trip::create([
                'driver_id' => $request->driver_id,
                'route_id' => $request->route_id,
                'started_at' => now(),
                'admin_status' => 'in_progress',
            ]);

            $route = Route::with('stores')->find($request->route_id);
            foreach ($route->stores as $index => $store) {
                $trip->stores()->attach($store->id, ['sequence' => $index + 1]);
            }
        });

        return redirect()->route('admin.trips')->withSuccess('Trip created and started.');
    }

    public function show($id)
    {
        $trip = Trip::with(['driver', 'route', 'stores'])->findOrFail($id);
        return view('admin.trip.show', compact('trip'));
    }

    public function edit($id)
    {
        $trip = Trip::with('stores')->findOrFail($id);
        $drivers = Driver::all();
        $routes = Route::with('stores')->get();

        return view('admin.trip.edit', compact('trip', 'drivers', 'routes'));
    }

    public function manageTimings($id)
    {
        $trip = Trip::with('stores')->findOrFail($id);
        return view('admin.trip.manage', compact('trip'));
    }

    public function saveTimings(Request $request, $id)
    {
        $trip = Trip::findOrFail($id);

        foreach ($request->store_ids as $storeId) {
            $trip->stores()->updateExistingPivot($storeId, [
                'arrival_time' => $request->arrival_time[$storeId] ?? null,
                'load_time' => $request->load_time[$storeId] ?? null,
                'departure_time' => $request->departure_time[$storeId] ?? null,
            ]);
        }

        return redirect()->route('admin.trips')->withSuccess('Trip timings updated successfully.');
    }

    public function toggleAdminStatus($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->admin_status = $trip->admin_status === 'completed' ? 'in_progress' : 'completed';

        // If both are done, set completed_at
        $trip->completed_at = ($trip->admin_status === 'completed' && $trip->driver_status === 'confirmed') ? now() : null;

        $trip->save();
        return back()->with('success', 'Admin status toggled.');
    }

    public function toggleDriverStatus($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->driver_status = $trip->driver_status === 'confirmed' ? 'pending' : 'confirmed';

        // If both are done, set completed_at
        $trip->completed_at = ($trip->admin_status === 'completed' && $trip->driver_status === 'confirmed') ? now() : null;

        $trip->save();
        return back()->with('success', 'Driver status toggled.');
    }


    // public function markCompleteByAdmin($id)
    // {
    //     $trip = Trip::findOrFail($id);

    //     $trip->admin_status = 'completed';
    //     if ($trip->driver_status === 'confirmed') {
    //         $trip->completed_at = now();
    //     }
    //     $trip->save();

    //     return back()->withSuccess('Trip marked as completed by admin.');
    // }

    // public function confirmByDriver($id)
    // {
    //     // $trip = Trip::where('id', $id)
    //     //             ->where('driver_id', auth()->id())
    //     //             ->firstOrFail();

    //     $trip = Trip::where('id', $id)->firstOrFail();

    //     $trip->driver_status = 'confirmed';

    //     if ($trip->admin_status === 'completed') {
    //         $trip->completed_at = now();
    //     }

    //     $trip->save();

    //     return redirect()->back()->with('success', 'Trip confirmed successfully.');
    // }


    // public function confirmByDriver(Request $request, $id)
    // {
    //     $trip = Trip::where('id', $id)->where('driver_id', auth()->id())->firstOrFail();

    //     $trip->driver_status = 'confirmed';
    //     if ($trip->admin_status === 'completed') {
    //         $trip->completed_at = now();
    //     }
    //     $trip->save();

    //     return response()->json(['message' => 'Trip confirmed by driver.']);
    // }





    // public function updateStoreTime(Request $request)
    // {
    //     $request->validate([
    //         'trip_id' => 'required|exists:trips,id',
    //         'store_id' => 'required|exists:stores,id',
    //         'arrival_time' => 'nullable|date',
    //         'load_time' => 'nullable|date',
    //         'departure_time' => 'nullable|date',
    //     ]);

    //     Trip::findOrFail($request->trip_id)
    //         ->stores()
    //         ->updateExistingPivot($request->store_id, [
    //             'arrival_time' => $request->arrival_time,
    //             'load_time' => $request->load_time,
    //             'departure_time' => $request->departure_time,
    //         ]);

    //     return back()->withSuccess('Store timings updated.');
    // }

    // public function complete($id)
    // {
    //     $trip = Trip::findOrFail($id);
    //     $trip->update([
    //         'completed_at' => now(),
    //         'admin_status' => 'completed',
    //     ]);

    //     return back()->withSuccess('Trip marked as completed.');
    // }

    public function destroy($id)
    {
        Trip::destroy($id);
        return redirect()->route('admin.trips')->withSuccess('Trip deleted.');
    }
}
