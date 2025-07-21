<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
class StoreController extends Controller
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

    public function index(Request $request) {
        if (!$request->ajax()) {
            return view('admin.store.header', ['title' => 'Store List']);
        }

        $limit = 10;
        $serial[] = ($request->input('page') == 0) ? 1 : (($limit * ($request->input('page') - 1)) + 1);
        $query = Store::query();

        if ($request->input('skey')) {
            $query->where('name', 'like', '%' . $request->input('skey') . '%');
        }

        if ($request->input('sstat')) {
            $query->where('status', $request->input('sstat'));
        }

        if ($request->input('sdate')) {
            $query->whereDate('created_at', $request->input('sdate'));
        }

        $count = $query->count();
        $result = $query->orderBy('id', 'DESC')->paginate($limit);

        return view('admin.store.table', compact('serial', 'count', 'result'));
    }

    public function create() {
        return view('admin.store.create');
    }

    // public function store(Request $request) {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'nullable|email',
    //         'phone' => 'nullable|numeric',
    //     ]);

    //     Store::create($request->all());

    //     return redirect()->route('admin.stores')->withSuccess('Store added successfully.');
    // }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|numeric',
            'status' => 'in:A,D', // Only allow Active or De-active
        ]);

        Store::create([
            'name' => $request->name,
            'location' => $request->location,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status ?? 'A',
        ]);

        return redirect()->route('admin.stores')->withSuccess('Store added successfully.');
    }


    public function show($id) {
        $store = Store::findOrFail($id);
        return view('admin.store.show', compact('store'));
    }

    public function edit($id) {
        $store = Store::findOrFail($id);
        return view('admin.store.edit', compact('store'));
    }

    public function update(Request $request, $id) {
        $store = Store::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|numeric',
        ]);

        $store->update($request->all());

        return redirect()->route('admin.stores')->withSuccess('Store updated successfully.');
    }

    public function destroy($id) {
        Store::destroy($id);
        return redirect()->route('admin.stores')->withSuccess('Store deleted successfully.');
    }

}
