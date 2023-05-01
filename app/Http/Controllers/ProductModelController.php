<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Auth;
use DB;

class ProductModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductModel::all();
        // dd($products);
        return view("product.index", ["products" => $products]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = ProductModel::all();
        return View::make("product.create" , ["products" => $products]);
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
            'product'=>'required|max:50',
            'description'=>'required|max:100',
            'quantity'=>'required|min:1|max:50',
        ]);

        $products = new ProductModel;

        $supp_id = DB::table('suppliers as s')->join('users as u','u.id', '=', 's.user_id')->value('s.id');

        $products->product = $request->product;
        $products->description = $request->description;
        $products->quantity = $request->quantity;
        $products->supplier_id = $supp_id;
        // dd($products);
        $products->save();
        return redirect()->route('product.index')->with('message', 'Product Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function show(ProductModel $productModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        $products = ProductModel::find($id);
        // $supplier = Song::pluck('title','id');
        return view('product.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $products = ProductModel::find($id);
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
       
        $products->product = $request->product;
        $products->description = $request->description;
        $products->quantity = $request->quantity;
        $products->supplier_id = $supp_id;
        $products->save();
        return redirect()->route('product.index')->withSuccessMessage("Product Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductModel::destroy($id);
        return back()->withSuccessMessage("Product Deleted!");
    }
}
