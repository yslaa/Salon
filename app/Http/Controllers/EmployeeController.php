<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\EmployeeModel;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = User::join(
            "employees",
            "users.id",
            "=",
            "employees.user_id"
        )
            ->select(
                "users.id",
                "users.name",
                "users.images",
                "users.role",
                "users.deleted_at",
                "employees.user_id",
                "employees.employee_role",
            )
            ->orderBy("employees.user_id", "DESC")
            ->withTrashed()
            ->get();

        if (session(key: "success_message")) {
            Alert::image(
                "Congratulations!",
                session(key: "success_message"),
                "https://media3.giphy.com/media/tKys00Ye9maGtn9pcq/giphy.gif?cid=ecf05e47knblbh9ucuhl5m1gjveld8lk5g6rt9skhd9ok636&rid=giphy.gif&ct=s",
                "200",
                "200",
                "I Am A Pic"
            );
        }

        return view("employee.index", ["employees" => $employee]);
    }


    /**
     * Display a listing of the resource.
     */
    public function getEmployeeProfile()
    {
        $employee = User::join(
            "employees",
            "users.id",
            "=",
            "employees.user_id"
        )
            ->select(
                "users.id",
                "users.name",
                "users.images",
                "users.role",
                "employees.user_id",
                "employees.employee_role",
            )
            ->where('employees.user_id',Auth::id())
            ->first();
        return view('employee.profile',compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getRegister()
    {
        return view('employee.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function postRegistered(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:4',
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter your password.',
            'password.min' => 'Your password must be at least 4 characters long.',
        ]);

        $user = new User();
                $user->name = $request->input("name");
                $user->email = $request->input("email");
                $user->password = bcrypt($request->input('password'));
                $user->role = 'employee';

            if ($request->hasfile("images")) {
                $file = $request->file("images");
                $filename =  $file->getClientOriginalName();
                $file->move("images/employee/", $filename);
                $user->images = $filename;
            }
                $user->save();

        $employee = new EmployeeModel();
                $employee->user_id = $user->id;
                $employee->employee_role = $request->input("employee_role");

        $employee->save();
       return redirect()->route('user.signIn');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $employees = User::join(
            "employees",
            "users.id",
            "=",
            "employees.user_id"
        )
             ->select(
                "users.id",
                "users.name",
                "users.images",
                "users.role",
                "employees.user_id",
                "employees.employee_role",
            )
            ->where('employees.user_id', $id)
            ->get();

        return View::make('employee.show', compact('employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        $employees = EmployeeModel::join('users', 'employees.user_id', '=', 'users.id')
                              ->where('users.id', '=', $id)
                              ->first();
        return view('employee.edit', compact('users', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required',
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
        ]);

            $users = User::find($id);
            $users->name = $request->input("name");
            $users->email = $request->input("email");
        if ($request->hasfile("images")) {
            $destination = "images/employee/" . $users->images;
        if (File::exists($destination)) {
            File::delete($destination);
        }
            $file = $request->file("images");
            $filename =  $file->getClientOriginalName();
            $file->move("images/employee/", $filename);
            $users->images = $filename;
        }
        $users->update();

        $employees = EmployeeModel::where('user_id', '=', $id)->first();
        $employees->employee_role = $request->input("employee_role");
        $employees->update();
        return Redirect::to("/employee")->withSuccessMessage("Employee Updated!");
    }



   public function profileEdit($id)
    {
        $employees = DB::table('users')
            ->join('employees', 'users.id', '=', 'employees.user_id')
            ->where('users.id', Auth::id())
            ->select(
                    "users.id",
                    "users.name",
                    "users.email",
                    "users.images",
                    "users.role",
                    "employees.user_id",
                    "employees.employee_role",
                )
            ->first();

        return view("employee.profileEdit")->with("employees", $employees);
    }

    public function profileUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required',
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
        ]);

        $user = User::find($id);
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        if ($request->hasfile("images")) {
            $destination = "images/employee/" . $user->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $filename =  $file->getClientOriginalName();
            $file->move("images/employee/", $filename);
            $user->images = $filename;
        }
        $user->update();
        return redirect()->route('employee.profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return Redirect::to("/employee")->withSuccessMessage("Employee Deleted!");
    }

     public function restore($id)
    {
        User::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::to("/employee")->withSuccessMessage("Employee Restored!");
    }

    public function forceDelete($id)
    {
        $employees = User::findOrFail($id);
        $destination = "uploads/employees/" . $employees->images;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $employees->forceDelete();
        return Redirect::to("/employee")->withSuccessMessage("Employee Permanently Deleted!");
    }
}
