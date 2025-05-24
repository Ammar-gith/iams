<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Office;
use App\Models\Status;
use App\Models\AdvAgency;
use App\Models\Newspaper;
use App\Models\Department;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use function Symfony\Component\VarDumper\Dumper\esc;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:Delete users|Update users', ['only' => ['edit', 'update', 'destroy']]);
    }

    public function index()
    {
        $user = User::all();
        return view('user-management.users.index', [
            'users' => $user
        ]);
    }

    public function create()
    {
        $role = Role::pluck('name', 'name')->all();
        $departments = Department::all();
        $offices = Office::all();
        $user_statuses = User::user_status;
        $newspapers = Newspaper::all();
        return view('user-management.users.create', [
            'roles' => $role,
            'departments' => $departments,
            'offices' => $offices,
            'user_statuses' => $user_statuses,
            'newspapers' => $newspapers,

        ]);
    }

    public function store(Request $request)
    {

        // $request->validate([
        //     'name' => 'required',
        //     'username' => 'required|unique:users,username',
        //     'role' => 'required',
        //     'email' => 'required|unique:users,email',
        //     'password' => 'required',
        //     'designation' => 'nullable',
        //     'image' => 'nullable',
        //     'department_id' => 'nullable|exists:departments,id',
        //     'office_id' =>  'nullable|exists:offices,id',
        //     'newspaper_id' => 'nullable|exists:newspapers,id',
        //     'adv_agency_id' => 'nullable|exists:adv_agencies,id',
        //     'status_id' => 'nullable|exists:statuses,id',
        //     'activation_date' => 'nullable',
        //     'deactivation_date' => 'nullable',

        // ]);


        // Initialize covering_letter_path
        $image_path = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $image_path = $file->store('user_images', 'public');
        }


        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'designation' => $request->designation,
            'image' => $image_path,
            'department_id' => $request->department_id,
            'office_id' =>  $request->office_id,
            'newspaper_id' => $request->newspaper_id,
            'adv_agency_id' => $request->adv_agency_id,
            'status_id' => $request->status_id,
            'activation_date' => $request->activation_date,
            'deactivation_date' => $request->deactivation_date,

        ]);

        $user->syncRoles($request->role);

        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $role = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $departments = Department::all();
        $selected_department = $user->department_id;
        $offices = Office::all();
        $selected_office = $user->office_id;
        $newspapers = Newspaper::all();
        $selected_newspaper = $user->newspaper_id;
        $adv_agencies = AdvAgency::all();
        $selected_adv_agency = $user->adv_agency_id;
        $statuses = Status::all();
        $selected_status = $user->status_id;
        return view('user-management.users.edit', [
            'user' => $user,
            'roles' => $role,
            'userRole' => $userRole,
            'departments' => $departments,
            'selected_department' => $selected_department,
            'offices' => $offices,
            'selected_office' => $selected_office,
            'newspapers' => $newspapers,
            'selected_newspaper' => $selected_newspaper,
            'adv_agencies' => $adv_agencies,
            'selected_adv_agency' => $selected_adv_agency,
            'statuses' => $statuses,
            'selected_status' => $selected_status
        ]);
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'role' => 'required',
            'email' => 'required',
            'password' => 'required',
            'designation' => 'nullable',
            'image' => 'nullable',
            'department_id' => 'nullable|exists:departments,id',
            'office_id' =>  'nullable|exists:offices,id',
            'newspaper_id' => 'nullable|exists:newspapers,id',
            'adv_agency_id' => 'nullable|exists:adv_agencies,id',
            'status_id' => 'nullable|exists:statuses,id',
            'activation_date' => 'nullable',
            'deactivation_date' => 'nullable',

        ]);

        $user = User::find($id);
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'designation' => $request->designation,
            // 'image' => $request->image,
            'department_id' => $request->department_id,
            'office_id' => $request->office_id,
            'newspaper_id' => $request->newspaper_id,
            'adv_agency_id' => $request->adv_agency_id,
            'status_id' => $request->status_id,
            'activation_date' => $request->activation_date,
            'deactivation_date' => $request->deactivation_date

        ];


        if (!empty($request->password)) {
            $data += [
                'password' => Hash::make($request->password),
            ];
        }


        $user->update($data);
        $user->syncRoles($request->role);

        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json(['success' => 'User deleted successfully']);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}