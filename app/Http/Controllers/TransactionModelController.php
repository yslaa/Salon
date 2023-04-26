<?php

namespace App\Http\Controllers;

use App\Models\TransactionModel;
use App\Models\ServiceModel;
use Illuminate\Http\Request;
use App\Trans;
use Session;
use DB;

class TransactionModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**  
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionModel  $transactionModel
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionModel $transactionModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransactionModel  $transactionModel
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionModel $transactionModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransactionModel  $transactionModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionModel $transactionModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionModel  $transactionModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionModel $transactionModel)
    {
        //
    }

    public function getServices(Request $request){
        $services = DB::table('services as s')
                    ->join('service_employee as se', 'se.service_id', '=', 's.id')
                    ->join('employees as e', 'se.employee_id', '=', 'e.id')
                    ->join('products as p', 's.product_id', '=', 'p.id')
                    ->join('users as u', 'e.user_id', '=', 'u.id')
                    ->get();

        $oldTrans = Session::has('trans') ? Session::get('trans'): null;
        $transac = new Trans($oldTrans);

            if ($transac->count == 1) {
                $disableButton = true; // Disable the button
                $transac->count = 0;
            }else {
                $disableButton = false; // Enable the button
            }

        return view('transaction.index', ['services' => $services, 'disableButton' => $disableButton]);
    }


    public function addAvail($id){

        $service = ServiceModel::find($id);
        $oldTrans = Session::has('trans') ? Session::get('trans'): null;
        $transac = new Trans($oldTrans);
        $transac->add($service, $service->id);
        Session::put('trans', $transac);

        return redirect()->route('getServices');
    }

    public function getAvailed() {

        if (!Session::has('trans')) {
            return view('transaction.availed-services');
        }

        $oldTrans = Session::get('trans');

        $transac = new Trans($oldTrans);

        return view('transaction.availed-services', ['services' => $transac->services, 'totalPrice' => $transac->totalPrice]);

    }

    public function removeService($id){

        $oldTrans = Session::has('trans') ? Session::get('trans') : null;

        $trans = new trans($oldTrans);

        $trans->removeService($id);

        if (count($trans->services) > 0) {
            Session::put('trans',$trans);
            Session::save();
        }else{
            Session::forget('trans');
        }

         return redirect()->route('getAvailed');

    }



}
