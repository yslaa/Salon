<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\DataTables\AdminTransDataTable;
use App\Models\TransactionModel;
use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\ServiceModel;
use Illuminate\Http\Request;
use App\Trans;
use Session;
use Auth;
use DB;

class TransactionModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminTransDataTable $dataTable)
    {
        return $dataTable->render('customer.history');
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
                    ->join('employees as e', 's.employee_id', '=', 'e.id')
                    ->join('products as p', 's.product_id', '=', 'p.id')
                    ->join('users as u', 'e.user_id', '=', 'u.id')
                    ->get(['s.id', 's.service', 's.cost', 'u.name',  'p.product']);

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

    public function payment(Request $request){

        if (!Auth::check()){
            return redirect()->route('user.signIns');
        }

        if (!Session::has('trans')) {
            return redirect()->route('getServices');
        }

        $oldTrans = Session::get('trans');

        $transac = new Trans($oldTrans);
        // dd($cart);
        
        try {
            DB::beginTransaction();

            $customer =  CustomerModel::where('user_id','=', Auth::id())->first();

            $avail = new TransactionModel();

            $avail->customer_id = $customer->id;
            $avail->date_placed = now();
            // $avail->shipvia = 1;
            $avail->status = 'Pending';
            $avail->save();

            foreach($transac->services as $service){

                $id = $service['service']['id'];

                $idProd = DB::table('services as s')
                ->join('products as p', 's.product_id', '=', 'p.id')
                ->where('s.id', $id)
                ->value('p.id');

                // dd($idProd);

                DB::table('transaction_line')->insert(
                    ['service_id' => $id, 
                     'transaction_id' => $avail->id,
                    ]
                );

                // $order->services()->attach($id,['quantity'=>$services['qty']]);
                $stock = ProductModel::find($idProd);
                $stock->quantity = $stock->quantity - 1;
                $stock->save();
            }
            // dd($order);
        }
        catch (\Exception $e) {
            // dd($e);
            DB::rollback();
            // dd($order);
            return redirect()->route('getAvailed')->with('error', $e->getMessage());
        }

        DB::commit();

        Session::forget('trans');

        return redirect()->route('getServices')->with('success','Successfully Purchased Your Products!!!');
    }

    public function transac(AdminTransDataTable $dataTable){

        if(Auth::check() && Auth::user()->role != 'admin') {
            return redirect()->back()->with('warning', 'not authorized');
        }
        return $dataTable->render('transaction.transac');

    }

    public function serviceDetails($id) {
        $customer = DB::table('customers as c')
        ->join('transactions as t','t.customer_id', '=', 'c.id')
        ->join('users as u','u.id', '=', 'c.user_id')
        ->where('t.id', $id)
        ->select('u.name', 'u.email', 't.id', 't.Status','t.date_placed')
        ->first();
    // dd($customer);

    $avails = DB::table('customers as c')
        ->join('transactions as t','t.customer_id', '=', 'c.id')
        ->join('transaction_line as tl','tl.transaction_id', '=', 't.id')
        ->join('services as s','tl.service_id', '=', 's.id')
        ->where('t.id', $id)
        ->select('s.service', 's.cost')
        ->get();
    //   dd($avails);  

        $total = $avails->map(function ($service, $key) {
             return $service->cost;
        });
        // $total = $orders->map(function ($item, $key) {
        //      return $item->sell_price * $item->quantity;
        // })->sum();
        //    dd($total->sum());
    return view('customer.transaction', compact('customer', 'avails', 'total'));

    }

    public function serviceProcess($id) {
        $customer = DB::table('customers as c')
            ->join('transactions as t','t.customer_id', '=', 'c.id')
            ->join('users as u','u.id', '=', 'c.user_id')
            ->where('t.id', $id)
            ->select('u.name', 'u.email', 't.id', 't.Status','t.date_placed')
            ->first();
        // dd($customer);

        $avails = DB::table('customers as c')
            ->join('transactions as t','t.customer_id', '=', 'c.id')
            ->join('transaction_line as tl','tl.transaction_id', '=', 't.id')
            ->join('services as s','tl.service_id', '=', 's.id')
            ->where('t.id', $id)
            ->select('s.service', 's.cost')
            ->get();
        //   dd($avails);  

            $total = $avails->map(function ($service, $key) {
                 return $service->cost;
            });
            // $total = $orders->map(function ($item, $key) {
            //      return $item->sell_price * $item->quantity;
            // })->sum();
            //    dd($total->sum());
        return view('transaction.serviceProcess', compact('customer', 'avails', 'total'));
    }

    public function transacUpdate(Request $request, $id) {
        // dd($request);
        TransactionModel::where('id', $id)
             ->update(['Status' => $request->status]);
        return redirect()->route('transactionAll');
    }

    public function sendEmail($id){

        $mail = DB::table('customers as c')
        ->join('transactions as t','t.customer_id', '=', 'c.id')
        ->join('users as u','u.id', '=', 'c.user_id')
        ->join('transaction_line as tl','t.id', '=', 'tl.transaction_id')
        ->join('services as s','s.id', '=', 'tl.service_id')
        ->where('t.id', $id)
        ->select('u.name', 't.date_placed', 'u.email',  DB::raw('SUM(s.cost) as total'))
        ->groupBy('u.name', 't.date_placed', 'u.email')
        ->get();

        $mailData = [
            "names" => $mail->pluck('name')->first(),
            "dates" => $mail->pluck('date_placed')->first(),
            "totals" => $mail->pluck('total')->first(),
        ];

        Mail::to('serenitysalon395@gmail.com')->send(new SendEmail($mailData));


        return redirect()->back()->with('success', 'Email sent successfully.');
    }

}
