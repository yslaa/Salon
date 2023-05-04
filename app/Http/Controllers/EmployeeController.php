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
use App\DataTables\EmployeeDataTable;

class EmployeeController extends Controller
{

    public function index(EmployeeDataTable $dataTable)
    {
        
            if (session('success_message')) {
                Alert::image(
                    "Congratulations!",
                    session('success_message'),
                    "https://i.pinimg.com/originals/59/c2/82/59c2820a57734d7fb2780dd47eed6f23.gif",
                    "200",
                    "200",
                    "I Am A Pic"
                );
            }
        return $dataTable->render('employee.index');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function index()
    // {
    //     $employees = User::join(
    //         "employees",
    //         "users.id",
    //         "=",
    //         "employees.user_id"
    //         )
    //         ->select(
    //             "users.id",
    //             "users.name",
    //             "users.images",
    //             "users.role",
    //             "users.deleted_at",
    //             "employees.user_id",
    //         )
    //         ->where('users.id', '<>', Auth::user()->id)  
    //         ->orderBy("employees.user_id", "DESC")
    //         ->withTrashed()
    //         ->get();

    //     if (session(key: "success_message")) {
    //         Alert::image(
    //             "Congratulations!",
    //             session(key: "success_message"),
    //             "https://media4.giphy.com/media/v1.Y2lkPTc5MGI3NjExYjc2NTBmNjk5M2RlNjdjZTg2MzYzMjEwNTkzNTcwNjc3MTk5NjNhMCZjdD1z/gip7vQSzEepGIoCz4K/giphy.gif",
    //             "200",
    //             "200",
    //             "I Am A Pic"
    //         );
    //     }

    //     return view("employee.index", ["employees" => $employees]);
    // }

    /**
     * Display a listing of the resource.
     */
    public function getemployeeProfile()
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

            $images = array();
            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $name = $file->getClientOriginalName();
                    $destinationPath = public_path().'/images/employee';
                    $file->move($destinationPath, $name);
                    $images[] = 'images/employee/'.$name;
                }
            }

            $user->images = implode('|', $images);
            $user->save();

        $employee = new employeeModel();
                $employee->user_id = $user->id;

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
        $employees = User::find($id);
        return view("employee.edit",  compact('employees'));
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

            $employees = User::find($id);
            $employees->name = $request->input("name");
            $employees->email = $request->input("email");

            $images = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $name = $file->getClientOriginalName();
                    $destinationPath = public_path().'/images/employee';
                    $file->move($destinationPath, $name);
                    $images[] = 'images/employee/'.$name;
                }
                $employees->images = implode('|', $images);
}

$employees->update();

        return Redirect::to("/employee")->withSuccessMessage("employee Updated!");
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

$employees = User::find($id);
$employees->name = $request->input("name");
$employees->email = $request->input("email");

$images = [];
if ($request->hasFile('images')) {
    foreach ($request->file('images') as $file) {
        $name = $file->getClientOriginalName();
        $destinationPath = public_path().'/images/employee';
        $file->move($destinationPath, $name);
        $images[] = 'images/employee/'.$name;
    }
    $employees->images = implode('|', $images);
    $employees->update();
        return redirect()->route('employee.profile');
    }
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
        return Redirect::to("/employee")->withSuccessMessage("employee Deleted!");
    }

     public function restore($id)
    {
        User::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::to("/employee")->withSuccessMessage("employee Restored!");
    }
public function forceDelete($id)
{
    $employee = User::onlyTrashed()->findOrFail($id);
        $destination = $employee->images;
        if (File::exists($destination)) {
            File::delete($destination);
        }
    $employee->forceDelete();

    return redirect()->route('employee.index')->withSuccessMessage('employee permanently deleted.');
}

}
