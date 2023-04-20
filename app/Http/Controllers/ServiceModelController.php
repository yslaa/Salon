<?php

namespace App\Http\Controllers;

use App\Models\ServiceModel;
use Illuminate\Http\Request;
use View;

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
        return View::make("service.create" , ["services" => $services]);
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
            'cost'=>'required'
        ]);

        $services = new ServiceModel;

        $supp_id = DB::table('services as s')->join('users as u','u.id', '=', 's.user_id')->value('s.id');

        $services->service = $request->service;
        $services->cost = $request->cost;
        $services->employee_id = $employee_id;
        $services->employee_id = $employee_id;
        dd($services);
        $services->save();
        return redirect()->route('service.index')->with('message', 'Product Added');
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
        // $supplier = Song::pluck('title','id');
        return view('service.edit', compact('services'));
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
        $services = ServiceModel::find($id);
        $supp_id = DB::table('suppliers as s')->join('users as u','u.id', '=', 's.user_id')->value('s.id');
        // if($request->file()) {
        //     $fileName = time().'_'.$request->file('img_path')->getClientOriginalName();
           
        //     // $filePath = $request->file('img_path')->storeAs('uploads', $fileName,'public');
        //     // dd($fileName,$filePath);
           
        //     $path = Storage::putFileAs(
        //         'public/images', $request->file('img_path'), $fileName
        //     );
        //     $artist->img_path = '/storage/images/' . $fileName;
           
        // }
       
        $services->service = $request->service;
        $services->description = $request->description;
        $services->quantity = $request->quantity;
        $services->cost = $request->cost;
        $services->supplier_id = $supp_id;
        $services->save();
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
