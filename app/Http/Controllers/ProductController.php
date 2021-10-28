<?php

namespace App\Http\Controllers;

use App\DataTables\ProductsDataTable;
use Yajra\DataTables\DataTables;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProduct;
use App\Models\ProductStock;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('product.product');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator =Validator::make($request->all(),[
                    'product_name' => 'required|min:2|max:50',
                    'product_description' => 'required|min:5|max:200',
                    'product_price' => 'required|numeric|min:1',
                    'product_photo'=>  'image|mimes:jpg,jpeg,png|max:6000', ///kb
                    'opening_stock' => 'required|numeric|min:1',
                    'captcha' => "required|captcha:'. request('captcha') . '",
                    ]);

        if($validator->fails()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{

            $product = new Product();
            $product->product_name= $request->input('product_name');
            $product->product_description= $request->input('product_description');
            $product->product_price= $request->input('product_price');
            if($request->hasFile('product_photo')){
                 $path = $request->file('product_photo')->store('product_photo');
                 $product->product_photo= $path;
                //  $path = 'product_photo/';
                //  $file = $request->file('product_photo');
                //  $file_name =time().'_'.$file->getClientOriginalName();
                //  //    $upload = $file->storeAs($path, $file_name);
                //  $upload = $file->storeAs($path, $file_name, 'public');
                //  $product->product_photo= $file_name;
            }
            $product->save();
            $productStock = new ProductStock();
            $productStock->opening_stock=$request->input('opening_stock');
            $query = $product->productStock()->save($productStock);
            if(!$query){
                return response()->json(['code'=>0,'msg'=>'Something went Wrong']);
            }else{
                return response()->json(['code'=>1,'msg'=>'New Product has been successfully saved']);
            }

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('productStock')->findOrFail($id);

        return view('product.edit',['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $validator =Validator::make($request->all(),[
            'product_name' => 'required|min:2|max:50',
            'product_description' => 'required|min:5|max:200',
            'product_price' => 'required|numeric|min:1',
            'product_photo'=>  'image|mimes:jpg,jpeg,png|max:6000', ///kb
            'opening_stock' => 'required|numeric|min:1',
            'captcha' => "required|captcha:'. request('captcha') . '",
            ]);

        if($validator->fails()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
        $product = Product::findOrFail($id);
        $product->product_name= $request->input('product_name');
        $product->product_description= $request->input('product_description');
        $product->product_price= $request->input('product_price');
        if($request->hasFile('product_photo')){
            $path = $request->file('product_photo')->store('product_photo');
            if($product->product_photo){
                Storage::delete($product->product_photo);
                $product->product_photo= $path;
            }else{
                $product->product_photo= $path;
            }
        }
        $product->productStock->opening_stock=$request->input('opening_stock');
        $query =$product->push();
        if(!$query){
            return response()->json(['code'=>0,'msg'=>'Something went Wrong']);
        }else{
            return response()->json(['code'=>1,'msg'=>'Product has been successfully Update']);
        }

    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        abort_if(!$request->ajax(),404);

        $product = Product::findOrFail($request->id);
        Storage::delete($product->product_photo);
        $product->delete();
        return true;
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
