<?php

namespace App\Http\Controllers;

use App\DataTables\ServiceDataTable;
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
    public function index(ServiceDataTable $dataTable)
    {
        return $dataTable->render('service.index');
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

        DB::table('services')->insert([
            'service' => $request->service,
            'cost' => $request->cost,
            'product_id' => $request->product,
            'employee_id' =>  $request->employee,
            'created_at' => now(),
            'updated_at' => now(),
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
            'employee_id' => $request->employee,
            'updated_at' => now()
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

    // public function restore(Request $request, $id)
    // {
    //     $service = Service::withTrashed()->findOrFail($id);

    //     $service->restore();

    //     return redirect()->route('service.index')
    //                     ->with('success','Service has been restored successfully.');
    // }
}
