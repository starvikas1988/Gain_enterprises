<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\RestaurantTablenumber;
use App\Models\Admin;
use App\Models\Role;
use Auth;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function myprofile()
    {
        $user = Admin::find(Auth::user()->id);
        return view('admin.myprofile')->with(array('user'=>$user));;   
    }
	
	public function changepassword()
	{
		return view('admin.changepassword');
	}

    public function passwordchange(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);   
		if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return redirect()->back()->withErrors("Your current password does not matches with the password you provided. Please try again.");
        }
        Admin::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   		return redirect()->back()->withSuccess('Password change successfully');
    }

    public function updateprofile(Request $request)
    {
        $validator = Validator::make($request->all(), 
		[
			 'name' => 'required',
		],[
			'name.required'=>'Name required',
		]);
        if ($validator->fails()) // on validator found any error 
        {
            return redirect(route('admin.myprofile'))->withErrors($validator)->withInput();
        }
        $admin = Admin::find(Auth::id());
        $admin->name = $request->name;
        $admin->address = $request->address;
        $admin->save();
        return redirect(route('admin.myprofile'))->withSuccess('Update successfully');
    }

    public function tableNumberIndex()
    {
        $tableNumbers = RestaurantTablenumber::with('restaurant')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.tablenumbers.index', compact('tableNumbers'));
    }


    public function createTableNumber()
    {
        $restaurants = Restaurant::where('status', 'A')->get();
        return view('admin.tablenumbers.create', compact('restaurants'));
    }

    public function storeTableNumber(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'table_number' => 'required|string|max:50',
            'capacity' => 'nullable|integer',
            'status' => 'required|in:Available,Occupied,Reserved',
        ]);

        RestaurantTablenumber::create([
            'restaurant_id' => $request->restaurant_id,
            'table_number' => $request->table_number,
            'capacity' => $request->capacity,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.table_numbers.index')->with('success', 'Table assigned successfully.');
    }

    public function editTableNumber($id)
    {
        $table = RestaurantTablenumber::findOrFail($id);
        $restaurants = Restaurant::where('status', 'A')->get();
        return view('admin.tablenumbers.edit', compact('table', 'restaurants'));
    }

    public function updateTableNumber(Request $request, $id)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'table_number' => 'required|string|max:50',
            'capacity' => 'nullable|integer',
            'status' => 'required|in:Available,Occupied,Reserved',
        ]);

        RestaurantTablenumber::where('id', $id)->update([
            'restaurant_id' => $request->restaurant_id,
            'table_number' => $request->table_number,
            'capacity' => $request->capacity,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.table_numbers.index')->with('success', 'Table updated successfully.');
    }


    public function deleteTableNumber($id)
    {
        RestaurantTablenumber::where('id', $id)->delete();
        return redirect()->route('admin.table_numbers.index')->with('success', 'Table entry deleted.');
    }

}