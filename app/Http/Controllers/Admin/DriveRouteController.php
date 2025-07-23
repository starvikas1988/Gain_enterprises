<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Route;
use App\Models\Driver;
use App\Models\Store;

class DriveRouteController extends Controller
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
            return view('admin.drive_route.header', ['title' => 'Drive Route List']);
        }

        $limit = 10;
        $page = $request->input('page', 1);
        $serial = [($limit * ($page - 1)) + 1];

        $query = Route::with(['driver', 'stores']);

        if ($request->input('skey')) {
            $skey = $request->input('skey');
            $query->where('name', 'LIKE', '%' . $skey . '%');
        }

        if ($request->input('sdriver')) {
            $query->where('driver_id', $request->input('sdriver'));
        }

        $count = $query->count();
        $result = $query->orderBy('id', 'DESC')->paginate($limit);

        return view('admin.drive_route.table', [
            'serial' => $serial,
            'count' => $count,
            'result' => $result
        ]);
    }

    public function create()
    {
        $drivers = Driver::all();
       
        $stores = Store::all();
        return view('admin.drive_route.create', compact('drivers', 'stores'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required|string',
            'type'       => 'required|in:linear,circular',
            'driver_id'  => 'required|exists:drivers,id',
            'store_ids'  => 'required|array|min:2',
            'store_ids.*'=> 'exists:stores,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.drive_route.create')->withErrors($validator)->withInput();
        }

        $route = new Route;
        $route->name = $request->name;
        $route->type = $request->type;
        $route->driver_id = $request->driver_id;
        $route->save();

        foreach ($request->store_ids as $index => $storeId) {
            $route->stores()->attach($storeId, ['stop_order' => $index + 1]);
        }

        return redirect()->route('admin.drive_route')->withSuccess('Route created successfully');
    }

    public function show($id)
    {
        $route = Route::with(['driver', 'stores'])->findOrFail($id);
        return view('admin.drive_route.show', compact('route'));
    }

    public function edit(Request $request)
    {
        $route = Route::with('stores')->findOrFail($request->id);
        $drivers = Driver::all();
        $stores = Store::all();
        return view('admin.drive_route.edit', [
            'route'   => $route,
            'drivers' => $drivers,
            'stores'  => $stores
        ]);

       // return view('admin.drive_route.edit', compact('route', 'drivers', 'stores'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required|string',
            'type'       => 'required|in:linear,circular',
            'driver_id'  => 'required|exists:drivers,id',
            'store_ids'  => 'required|array|min:2',
            'store_ids.*'=> 'exists:stores,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.drive_route.edit', ['id' => $request->id])
                             ->withErrors($validator)->withInput();
        }

        $route = Route::findOrFail($request->id);
        $route->name = $request->name;
        $route->type = $request->type;
        $route->driver_id = $request->driver_id;
        $route->save();

        $syncData = [];
        foreach ($request->store_ids as $index => $storeId) {
            $syncData[$storeId] = ['stop_order' => $index + 1];
        }
        $route->stores()->sync($syncData);

        return redirect()->route('admin.drive_route')->withSuccess('Route updated successfully');
    }

    public function destroy(Request $request)
    {
        Route::findOrFail($request->id)->delete();
        return redirect()->route('admin.drive_route')->withSuccess('Route deleted successfully');
    }
}
