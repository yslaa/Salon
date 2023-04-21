<?php

namespace App\Http\Controllers;

use App\Models\ServiceModel;
use App\Models\ServiceEmployee;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;
use Auth;
use View;
use DB;

class ServiceModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = ServiceModel::all();
        return view("service.index", ["services" => $services]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = ServiceModel::all();
        $employees = DB::table('employees as e')
            ->join('users as u','u.id', '=', 'e.user_id')
            ->where('u.role', '=', 'employee')
            ->get(['u.name','e.id as emp_id']);
        $products = DB::table('products as p')->get(['p.product','p.id as product_id']);

        return View::make("service.create" , ["services" => $services, 
                "employees" => $employees, 
                'products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'service'=>'required|max:50',
            'cost'=>'required',
            'employee'=>'required'
        ]);

        $serve_id = DB::table('services')->insertGetId([
            'service' => $request->service,
            'cost' => $request->cost,
            'product_id' => $request->product,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('service_employee')->insert([
            'service_id' => $serve_id,
            'employee_id' => $request->employee,
        ]);
        
        return redirect()->route('service.index')->with('message', 'Service Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceModel  $serviceModel
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceModel $serviceModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceModel  $serviceModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        $services = ServiceModel::find($id);
        $products = DB::table('products as p')->get(['p.product','p.id as product_id']);
        $employees = DB::table('employees as e')
            ->join('users as u','u.id', '=', 'e.user_id')
            ->where('u.role', '=', 'employee')
            ->get(['u.name','e.id as emp_id']);
        return view('service.edit', compact('services', 'products', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceModel  $serviceModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $services = DB::table('services')->where('id', $id)->update([
            'service' => $request->service,
            'cost' => $request->cost,
            'product_id' => $request->product,
            'updated_at' => now()
        ]);

        $serve_emp = DB::table('service_employee')->where('service_id', $id)->update([
            'employee_id' => $request->employee,
        ]);

        // if($request->file()) {
        //     $fileName = time().'_'.$request->file('img_path')->getClientOriginalName();
           
        //     // $filePath = $request->file('img_path')->storeAs('uploads', $fileName,'public');
        //     // dd($fileName,$filePath);
           
        //     $path = Storage::putFileAs(
        //         'public/images', $request->file('img_path'), $fileName
        //     );
        //     $artist->img_path = '/storage/images/' . $fileName;
        // }
       

        return redirect()->route('service.index')->withSuccessMessage("Product Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceModel  $serviceModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ServiceModel::destroy($id);
        return back()->withSuccessMessage("Product Deleted!");
    }
}
