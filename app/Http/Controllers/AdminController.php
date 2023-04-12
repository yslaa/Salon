<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\AdminModel;
use RealRashid\SweetAlert\Facades\Alert;
use App\DataTables\AdminDataTable;

class AdminController extends Controller
{

    public function index(AdminDataTable $dataTable)
    {
        return $dataTable->render('admin.index');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function index()
    // {
    //     $admins = User::join(
    //         "admins",
    //         "users.id",
    //         "=",
    //         "admins.user_id"
    //         )
    //         ->select(
    //             "users.id",
    //             "users.name",
    //             "users.images",
    //             "users.role",
    //             "users.deleted_at",
    //             "admins.user_id",
    //         )
    //         ->where('users.id', '<>', Auth::user()->id)
    //         ->orderBy("admins.user_id", "DESC")
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

    //     return view("admin.index", ["admins" => $admins]);
    // }

    /**
     * Display a listing of the resource.
     */
    public function getAdminProfile()
    {
        $admin = User::join(
            "admins",
            "users.id",
            "=",
            "admins.user_id"
        )
            ->select(
                "users.id",
                "users.name",
                "users.images",
                "users.role",
                "admins.user_id",
            )
            ->where('admins.user_id',Auth::id())
            ->first();
        return view('admin.profile',compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getRegister()
    {
        return view('admin.register');
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
                $user->role = 'admin';

            if ($request->hasfile("images")) {
                $file = $request->file("images");
                $filename =  $file->getClientOriginalName();
                $file->move("images/admin/", $filename);
                $user->images = $filename;
            }
                $user->save();

        $admin = new AdminModel();
                $admin->user_id = $user->id;

        $admin->save();
       return redirect()->route('user.signIn');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $admins = User::join(
            "admins",
            "users.id",
            "=",
            "admins.user_id"
        )
             ->select(
                "users.id",
                "users.name",
                "users.images",
                "users.role",
                "admins.user_id",
            )
            ->where('admins.user_id', $id)
            ->get();

        return View::make('admin.show', compact('admins'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admins = User::find($id);
        return view("admin.edit",  compact('admins'));
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

        $admins = User::find($id);
        $admins->name = $request->input("name");
        $admins->email = $request->input("email");
        if ($request->hasfile("images")) {
            $destination = "images/admin/" . $admins->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $filename =  $file->getClientOriginalName();
            $file->move("images/admin/", $filename);
            $admins->images = $filename;
        }
        $admins->update();
        return Redirect::to("/admin")->withSuccessMessage("Admin Updated!");
    }

    public function profileEdit($id)
    {
        $admins = DB::table('users')
            ->join('admins', 'users.id', '=', 'admins.user_id')
            ->where('users.id', Auth::id())
            ->select(
                    "users.id",
                    "users.name",
                    "users.email",
                    "users.images",
                    "users.role",
                    "admins.user_id",
                )
            ->first();

        return view("admin.profileEdit")->with("admins", $admins);
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
            $destination = "images/admin/" . $user->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $filename =  $file->getClientOriginalName();
            $file->move("images/admin/", $filename);
            $user->images = $filename;
        }
        $user->update();
        return redirect()->route('admin.profile');
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
        return Redirect::to("/admin")->withSuccessMessage("Admin Deleted!");
    }

     public function restore($id)
    {
        User::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::to("/admin")->withSuccessMessage("Admin Restored!");
    }

    public function forceDelete($id)
    {
        $admins = User::findOrFail($id);
        $destination = "uploads/admins/" . $admins->images;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $admins->forceDelete();
        return Redirect::to("/admin")->withSuccessMessage("Admin Permanently Deleted!");
    }
}
