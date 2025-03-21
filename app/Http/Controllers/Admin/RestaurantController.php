<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Restaurant;
use Auth;
use DB;
use Hash;
use Carbon\Carbon;

class RestaurantController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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

    /**
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            // dd($request->all());
            return view('admin.restaurant.header', ['title' => 'Restaurant list']);
        } else {
            $limit = 10;
            $serial[] = (request()->input('page') == 0) ? 1 : (($limit * (request()->input('page') - 1)) + 1);
            $query = Restaurant::where('id', '>', '0');
            // Search Start
            if ($request->input('skey') != '') {
                $query = $query->where('name', 'LIKE', '%' . $request->input('skey') . '%');
                $query = $query->OrWhere('mobile', 'LIKE', '%' . $request->input('skey') . '%');
                $query = $query->OrWhere('email', 'LIKE', '%' . $request->input('skey') . '%');
            }
            if ($request->input('sstat') != '')
                $query = $query->where('status', '=', $request->input('sstat'));

            // if($request->input('sdate')!='')
            //     $query = $query->whereDate('created_at','=', $request->input('sdate'));

            if ($request->input('sdate') != '') {
                try {
                    // Convert from MM/DD/YYYY to YYYY-MM-DD
                    $formattedDate = Carbon::createFromFormat('m/d/Y', $request->input('sdate'))->format('Y-m-d');

                    // Apply the filter
                    $query = $query->whereDate('updated_at', '=', $formattedDate);
                } catch (\Exception $e) {
                    return response()->json(['success' => false, 'message' => 'Invalid date format'], 400);
                }
            }
            // Debugging: Print SQL Query with Bindings
            // dd(vsprintf(str_replace('?', "'%s'", $query->toSql()), $query->getBindings()));
            // Search End

            $count = $query->count();
            $result = $query->orderBy('id', 'DESC')->paginate($limit);


            return view('admin.restaurant.table', ['serial' => $serial, 'count' => $count, 'result' => $result]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationRules = [
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:restaurants',
            'mobile' => 'required|digits:10|unique:restaurants',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|numeric|min:0|max:5',
            'availability' => 'required|in:OPEN,CLOSE',
            'gst_percentage' => 'required|integer|min:0',
            'gst_type' => 'required|in:Including,Excluding',
            'status' => 'required|in:A,D',
            'password' => 'required|min:6|confirmed',
            'address' => 'required|string|max:500',
        ];

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Creating new restaurant
        $restaurant = new Restaurant();
        $restaurant->name = $request->name;
        $restaurant->email = $request->email;
        $restaurant->mobile = $request->mobile;
        $restaurant->rating = $request->rating;
        $restaurant->availability = $request->availability;
        $restaurant->gst_percentage = $request->gst_percentage;
        $restaurant->gst_type = $request->gst_type;
        $restaurant->status = $request->status;
        $restaurant->address = $request->address;
        $restaurant->password = Hash::make($request->password);

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/restaurant'), $imageName);
            $restaurant->image = 'public/uploads/restaurant/' . $imageName;
        }

        $restaurant->save();

        return redirect(route('admin.restaurant'))->with('success', 'Restaurant added successfully.');
    }

    public function edit($id)
    {
       // $restaurant = Restaurant::Where('id', '=', $request->id)->get();
       $restaurant = Restaurant::findOrFail($id);
        return view('admin.restaurant.edit', ['restaurant' => $restaurant]);
    }

    // public function update(Request $request)
    // {
    //     $sValidationRules = [
    //         'name' => 'required',
    //         'address' => 'required',
    //         'email' => 'required|email|unique:restaurants,email,' . $request->id,
    //         'mobile' => 'required|digits:10,|unique:restaurants,mobile,' . $request->id,
    //     ];
    //     $validator = Validator::make($request->all(), $sValidationRules);
    //     if ($validator->fails()) // on validator found any error 
    //     {
    //         return redirect(route('admin.restaurant.edit', ['id' => $request->id]))->withErrors($validator)->withInput();
    //     }
    //     $franchisee = Driver::find($request->id);
    //     $franchisee->name = $request->name;
    //     $franchisee->shop_name = $request->shopname;
    //     $franchisee->pincode = $request->pincode;
    //     $franchisee->email = $request->email;
    //     $franchisee->mobile = $request->mobile;
    //     $franchisee->address = $request->address;
    //     $franchisee->charge = $request->charge;
    //     $franchisee->creditlimit = $request->creditlimit;
    //     $franchisee->status = $request->status;
    //     if ($request->hasFile('userfile')) {
    //         $image = rand() . time() . '.' . $request->userfile->extension();
    //         $request->userfile->move(public_path('uploads/driver'), $image);
    //         $franchisee->profileimg = 'public/uploads/driver/' . $image;
    //     }
    //     $franchisee->save();
    //     return redirect(route('admin.restaurant'))->withSuccess('Update successfully');
    // }

    public function update(Request $request, $id)
    {
        // Validation rules
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:restaurants,email,' . $id,
            'mobile' => 'required|digits:10|unique:restaurants,mobile,' . $id,
            'password' => 'nullable|min:6|confirmed', // Password should be confirmed
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->name = $request->name;
        $restaurant->email = $request->email;
        $restaurant->mobile = $request->mobile;
        $restaurant->rating = $request->rating;
        $restaurant->availability = $request->availability;
        $restaurant->gst_percentage = $request->gst_percentage;
        $restaurant->gst_type = $request->gst_type;
        $restaurant->status = $request->status;
        $restaurant->address = $request->address;

        // Update password only if provided
        if ($request->filled('password')) {
            $restaurant->password = Hash::make($request->password);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = rand().time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/restaurant'), $image);
            $restaurant->image = 'public/uploads/restaurant/'.$image;
        }

        $restaurant->save();

        return redirect(route('admin.restaurant'))->withSuccess('Restaurant updated successfully.');
    }


    public function destroy(Request $request)
    {
        Restaurant::where('id', '=', $request->id)->delete();
        return redirect(route('admin.restaurant'))->withSuccess('Deleted successfully');
    }
}
