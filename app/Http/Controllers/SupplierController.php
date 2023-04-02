<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\SupplierModel;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = User::join(
            "suppliers",
            "users.id",
            "=",
            "suppliers.user_id"
        )
            ->select(
                "users.id",
                "users.name",
                "users.images",
                "users.role",
                "users.deleted_at",
                "suppliers.user_id",
            )
            ->orderBy("suppliers.user_id", "DESC")
            ->withTrashed()
            ->get();

        if (session(key: "success_message")) {
            Alert::image(
                "Congratulations!",
                session(key: "success_message"),
                "https://media0.giphy.com/media/1YcLOSW6JCNdsfSr5E/giphy.gif?cid=790b76115cd3d732681c09d4b2ea920e8c940bcfdb2711a6&rid=giphy.gif&ct=s",
                "200",
                "200",
                "I Am A Pic"
            );
        }

        return view("supplier.index", ["suppliers" => $supplier]);
    }


    /**
     * Display a listing of the resource.
     */
    public function getSupplierProfile()
    {
        $supplier = User::join(
            "suppliers",
            "users.id",
            "=",
            "suppliers.user_id"
        )
            ->select(
                "users.id",
                "users.name",
                "users.images",
                "users.role",
                "suppliers.user_id",
            )
            ->where('suppliers.user_id',Auth::id())
            ->first();
        return view('supplier.profile',compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getRegister()
    {
        return view('supplier.register');
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
            'images' => 'mimes:jpeg,png,jpg,gif,svg',
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter your password.',
            'password.min' => 'Your password must be at least 4 characters long.',
            'images.mimes' => 'Please enter a valid image.',
        ]);

        $user = new User();
                $user->name = $request->input("name");
                $user->email = $request->input("email");
                $user->password = bcrypt($request->input('password'));
                $user->role = 'supplier';

            if ($request->hasfile("images")) {
                $file = $request->file("images");
                $filename =  $file->getClientOriginalName();
                $file->move("images/supplier/", $filename);
                $user->images = $filename;
            }
                $user->save();

        $supplier = new SupplierModel();
                $supplier->user_id = $user->id;

        $supplier->save();
       return redirect()->route('user.signIn');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $suppliers = User::join(
            "suppliers",
            "users.id",
            "=",
            "suppliers.user_id"
        )
             ->select(
                "users.id",
                "users.name",
                "users.images",
                "users.role",
                "suppliers.user_id",
            )
            ->where('suppliers.user_id', $id)
            ->get();

        return View::make('supplier.show', compact('suppliers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suppliers = User::find($id);
        return view("supplier.edit",  compact('suppliers'));
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
            'images' => 'mimes:jpeg,png,jpg,gif,svg',
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'images.mimes' => 'Please enter a valid image.',
        ]);

        $suppliers = User::find($id);
        $suppliers->name = $request->input("name");
        $suppliers->email = $request->input("email");
        if ($request->hasfile("images")) {
            $destination = "images/supplier/" . $suppliers->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $filename =  $file->getClientOriginalName();
            $file->move("images/supplier/", $filename);
            $suppliers->images = $filename;
        }
        $suppliers->update();
        return Redirect::to("/supplier")->withSuccessMessage("Supplier Updated!");
    }

   public function profileEdit($id)
    {
        $suppliers = DB::table('users')
            ->join('suppliers', 'users.id', '=', 'suppliers.user_id')
            ->where('users.id', Auth::id())
            ->select(
                    "users.id",
                    "users.name",
                    "users.email",
                    "users.images",
                    "users.role",
                    "suppliers.user_id",
                )
            ->first();

        return view("supplier.profileEdit")->with("suppliers", $suppliers);
    }

    public function profileUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required',
            'images' => 'mimes:jpeg,png,jpg,gif,svg',
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'images.mimes' => 'Please enter a valid image.',
        ]);

        $user = User::find($id);
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        if ($request->hasfile("images")) {
            $destination = "images/supplier/" . $user->images;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("images");
            $filename =  $file->getClientOriginalName();
            $file->move("images/supplier/", $filename);
            $user->images = $filename;
        }
        $user->update();
        return redirect()->route('supplier.profile');
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
        return Redirect::to("/supplier")->withSuccessMessage("Supplier Deleted!");
    }

     public function restore($id)
    {
        User::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::to("/supplier")->withSuccessMessage("Supplier Restored!");
    }

    public function forceDelete($id)
    {
        $suppliers = User::findOrFail($id);
        $destination = "uploads/suppliers/" . $suppliers->images;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $suppliers->forceDelete();
        return Redirect::to("/supplier")->withSuccessMessage("Supplier Permanently Deleted!");
    }
}
