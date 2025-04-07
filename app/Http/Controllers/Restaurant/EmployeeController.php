<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    // Display the Employee List
    // public function index()
    // {
    //     $restaurantId = auth()->guard('restaurant')->id();

    //     $employees = DB::table('employees')
    //         ->leftJoin('employee_roles', 'employees.id', '=', 'employee_roles.employee_id')
    //         ->leftJoin('roles', 'employee_roles.role_id', '=', 'roles.id')
    //         ->select('employees.*', 'roles.name as role_name')
    //         ->where('employees.restaurant_id', $restaurantId)
    //         ->paginate(10);

    //     return view('restaurant.employees.index', compact('employees'));
    // }

    public function index()
{
    $restaurantId = auth()->guard('restaurant')->id();

    // Fetch employees with roles and permissions using Query Builder
    $employees = DB::table('employees')
        ->leftJoin('employee_roles', 'employees.id', '=', 'employee_roles.employee_id')
        ->leftJoin('roles', 'employee_roles.role_id', '=', 'roles.id')
        ->select(
            'employees.*', 
            'roles.name as role_name',
            'employee_roles.role_id'
        )
        ->where('employees.restaurant_id', $restaurantId)
        ->paginate(10);

    // Fetch permissions using role_id
    foreach ($employees as $employee) {
        if ($employee->role_id) {
            $permissions = DB::table('roles_permissions')
                ->join('permissions', 'roles_permissions.permission_id', '=', 'permissions.id')
                ->where('roles_permissions.role_id', $employee->role_id)
                ->pluck('permissions.name')
                ->toArray();

            $employee->permissions = $permissions;
        } else {
            $employee->permissions = [];
        }
    }

    return view('Restaurant.employees.index', compact('employees'));
}


    // Show Create Employee Form
    public function create()
    {
        $roles = DB::table('roles')->where('type', 'Restaurant')->get();
        $permissions = DB::table('permissions')->where('type', 'Restaurant')->get();
        return view('Restaurant.employees.create', compact('roles', 'permissions'));
    }

    // Store Employee Data
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('employees')],
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $restaurantId = auth()->guard('restaurant')->id();

        // Create Employee
        $employeeId = DB::table('employees')->insertGetId([
            'restaurant_id' => $restaurantId,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Assign Role
        DB::table('employee_roles')->insert([
            'employee_id' => $employeeId,
            'role_id' => $request->role_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Assign Permissions (if selected)
        if ($request->permissions) {
            foreach ($request->permissions as $permissionId) {
                DB::table('roles_permissions')->insert([
                    'role_id' => $request->role_id,
                    'permission_id' => $permissionId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('restaurant.employees.index')->with('success', 'Employee created successfully!');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => ['required', 'string', 'email', 'max:255', Rule::unique('employees')],
    //         'password' => 'required|string|min:6|confirmed',
    //         'role_id' => 'required|exists:roles,id',
    //         'permissions' => 'nullable|array',
    //         'permissions.*' => 'exists:permissions,id',
    //     ]);

    //     $restaurantId = auth()->guard('restaurant')->id();

    //     try {
    //         DB::beginTransaction();

    //         // Create Employee
    //         $employeeId = DB::table('employees')->insertGetId([
    //             'restaurant_id' => $restaurantId,
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password),
    //             'status' => 'Active',
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);

    //         // Assign Role
    //         DB::table('employee_roles')->insert([
    //             'employee_id' => $employeeId,
    //             'role_id' => $request->role_id,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     // dd($request->permissions);
    //         // Assign Permissions (If Selected) - Insert into `employee_permissions`
    //         if (!empty($request->permissions)) {
    //             $employeePermissions = [];
    //             foreach ($request->permissions as $permissionId) {
    //                 $employeePermissions[] = [
    //                     'role_id' => $request->role_id,
    //                     'permission_id' => $permissionId,
    //                     'created_at' => now(),
    //                     'updated_at' => now(),
    //                 ];
    //             }
    //             DB::table('roles_permissions')->insert($employeePermissions);
    //         }

    //         DB::commit();
    //         return redirect()->route('restaurant.employees.index')->with('success', 'Employee created successfully!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return back()->with('error', 'Error: ' . $e->getMessage());
    //     }
    // }

    // Show Edit Form
    public function edit($id)
    {
        $restaurantId = auth()->guard('restaurant')->id();

        $employee = DB::table('employees')
            ->where('id', $id)
            ->where('restaurant_id', $restaurantId)
            ->first();

        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found!');
        }

        $roles = DB::table('roles')->where('type', 'Restaurant')->get();
        $permissions = DB::table('permissions')->where('type', 'Restaurant')->get();
        $employeeRole = DB::table('employee_roles')->where('employee_id', $id)->pluck('role_id')->first();
        $employeePermissions = DB::table('roles_permissions')->where('role_id', $employeeRole)->pluck('permission_id')->toArray();

        return view('Restaurant.employees.edit', compact('employee', 'roles', 'permissions', 'employeeRole', 'employeePermissions'));
    }

    // Update Employee Data
    public function update(Request $request, $id)
    {
        $restaurantId = auth()->guard('restaurant')->id();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('employees')->ignore($id)],
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Update Employee
        DB::table('employees')
            ->where('id', $id)
            ->where('restaurant_id', $restaurantId)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'updated_at' => now(),
            ]);

        // Update Role
        DB::table('employee_roles')->where('employee_id', $id)->delete();
        DB::table('employee_roles')->insert([
            'employee_id' => $id,
            'role_id' => $request->role_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Update Permissions
        DB::table('roles_permissions')->where('role_id', $request->role_id)->delete();
        if ($request->permissions) {
            foreach ($request->permissions as $permissionId) {
                DB::table('roles_permissions')->insert([
                    'role_id' => $request->role_id,
                    'permission_id' => $permissionId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('restaurant.employees.index')->with('success', 'Employee updated successfully!');
    }

    // Delete Employee
    public function destroy($id)
    {
        $restaurantId = auth()->guard('restaurant')->id();

        DB::table('employees')
            ->where('id', $id)
            ->where('restaurant_id', $restaurantId)
            ->delete();

        return redirect()->route('restaurant.employees.index')->with('success', 'Employee deleted successfully!');
    }
}
