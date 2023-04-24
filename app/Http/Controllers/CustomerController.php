<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\CustomerModel;
use RealRashid\SweetAlert\Facades\Alert;
use App\DataTables\CustomerDataTable;

class CustomerController extends Controller
{

    public function index(CustomerDataTable $dataTable)
    {
        return $dataTable->render('customer.index');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function index()
    // {
    //     $customers = User::join(
    //         "customers",
    //         "users.id",
    //         "=",
    //         "customers.user_id"
    //         )
    //         ->select(
    //             "users.id",
    //             "users.name",
    //             "users.images",
    //             "users.role",
    //             "users.deleted_at",
    //             "customers.user_id",
    //         )
    //         ->where('users.id', '<>', Auth::user()->id)  
    //         ->orderBy("customers.user_id", "DESC")
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

    //     return view("customer.index", ["customers" => $customers]);
    // }

    /**
     * Display a listing of the resource.
     */
    public function getcustomerProfile()
    {
        $customer = User::join(
            "customers",
            "users.id",
            "=",
            "customers.user_id"
        )
            ->select(
                "users.id",
                "users.name",
                "users.images",
                "users.role",
                "customers.user_id",
            )
            ->where('customers.user_id',Auth::id())
            ->first();
        return view('customer.profile',compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getRegister()
    {
        return view('customer.register');
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
            $user->role = 'customer';

            $images = array();
            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $name = $file->getClientOriginalName();
                    $destinationPath = public_path().'/images/customer';
                    $file->move($destinationPath, $name);
                    $images[] = 'images/customer/'.$name;
                }
            }

            $user->images = implode('|', $images);
            $user->save();

        $customer = new customerModel();
                $customer->user_id = $user->id;

        $customer->save();
       return redirect()->route('user.signIn');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $customers = User::join(
            "customers",
            "users.id",
            "=",
            "customers.user_id"
        )
             ->select(
                "users.id",
                "users.name",
                "users.images",
                "users.role",
                "customers.user_id",
            )
            ->where('customers.user_id', $id)
            ->get();

        return View::make('customer.show', compact('customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = User::find($id);
        return view("customer.edit",  compact('customers'));
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

            $customers = User::find($id);
            $customers->name = $request->input("name");
            $customers->email = $request->input("email");

            $images = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $name = $file->getClientOriginalName();
                    $destinationPath = public_path().'/images/customer';
                    $file->move($destinationPath, $name);
                    $images[] = 'images/customer/'.$name;
                }
                $customers->images = implode('|', $images);
}

$customers->update();

        return Redirect::to("/customer")->withSuccessMessage("customer Updated!");
    }

    public function profileEdit($id)
    {
        $customers = DB::table('users')
            ->join('customers', 'users.id', '=', 'customers.user_id')
            ->where('users.id', Auth::id())
            ->select(
                    "users.id",
                    "users.name",
                    "users.email",
                    "users.images",
                    "users.role",
                    "customers.user_id",
                )
            ->first();

        return view("customer.profileEdit")->with("customers", $customers);
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

$customers = User::find($id);
$customers->name = $request->input("name");
$customers->email = $request->input("email");

$images = [];
if ($request->hasFile('images')) {
    foreach ($request->file('images') as $file) {
        $name = $file->getClientOriginalName();
        $destinationPath = public_path().'/images/customer';
        $file->move($destinationPath, $name);
        $images[] = 'images/customer/'.$name;
    }
    $customers->images = implode('|', $images);
    $customers->update();
        return redirect()->route('customer.profile');
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
        return Redirect::to("/customer")->withSuccessMessage("Customer Deleted!");
    }

     public function restore($id)
    {
        User::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::to("/customer")->withSuccessMessage("customer Restored!");
    }
public function forceDelete($id)
{
    $customer = User::onlyTrashed()->findOrFail($id);
        $destination = $customer->images;
        if (File::exists($destination)) {
            File::delete($destination);
        }
    $customer->forceDelete();

    return redirect()->route('customer.index')->withSuccessMessage('customer permanently deleted.');
}

}
