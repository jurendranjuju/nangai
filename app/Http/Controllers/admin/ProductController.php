<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MassDestroyProductRequest;
use App\Product;
use App\Category;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products = Product::where('status',1)->whereNull('deleted_at')->get();
        $categorys = Category::where('status',1)->whereNull('deleted_at')->get();
        // echo "<pre>";
        // print_r($Product->toArray());exit;
     
        return view('admin.Product.index', compact('products','categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        $product = Product::where('status',1)->whereNull('deleted_at')->get();
        $category = Category::where('status',1)->whereNull('deleted_at')->get();
       
        return view('admin.product.create',compact('product','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(empty($request['update_id'])){
            $Productinfs = new Product();
        }else{
            $Productinfs = Product::where('id',$request['update_id'])->first();
        }
        $Productinfs->Product_name = $request['name'];
        $Productinfs->category_id  = $request['category'];
        $Productinfs->amount  = $request['price'];
        $Productinfs->availability="";
        $Productinfs->Product_type = 1;
        if($Productinfs->save()){
            Session::flash('success', 'Product added successfully');
            return redirect()->route('admin.Product.index');
        }else{
            Session::flash('danger', 'Something went wrong');
        }
    }
    public function update(request $request,id $id){
        if(empty($request['update_id'])){
            $Productinfs = new Product();
        }else{
            $Productinfs = Product::where('id',$request['update_id'])->first();
        }
        $Productinfs->Product_name = $request['name'];
        $Productinfs->category_id  = $request['category'];
        $Productinfs->amount  = $request['price'];
        $Productinfs->availability="";
        $Productinfs->Product_type = 1;
        if($Productinfs->save()){
           
            
            Session::flash('success', 'Product added successfully');
            return redirect()->route('admin.Product.index');
        }else{
            Session::flash('danger', 'Something went wrong');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $Product = Product::with(['categoryinfos'=>function($q){
            $q->select('id','name');
        }])->where('id',$id)->first();



        return view('admin.Product.show', compact('Product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         
        
        $Product = Product::with(['categoryinfos'=>function($q){
            $q->select('id','name');
        }])->where('id',$id)->first();

        $category = Category::where('status',1)->whereNull('deleted_at')->get();

        return view('admin.Product.edit', compact('Product','category'));
    }
    

   
    public function search(Request $request){
       
        $categoryval = $request->input('category');
        
        
        
        Session::put('category',$categoryval);
        
        $Products = Product::with(['categoryinfos'=>function($q){
            $q->select('id','name');
        }])->where('Product_type',1)->whereNull('deleted_at');

        if(!empty($request->input('category'))){
            $Products->where('category_id',$request->input('category'));
        }
        
        
        $Product =$Products->paginate(10);
      
        $categorys = Category::where('status',1)->whereNull('deleted_at')->get();
       // $settingscountrys = CountrySettings::select('id','slug')->get();
        return view('admin.Product.index', compact('Product','categorys'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Product::where('id',$id)->update(['deleted_at'=> date('Y-m-d H:i:s')]);

        Session::flash('success', 'Product deleted successfully');

        return back();
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        Product::whereIn('id', request('ids'))->update(['deleted_at'=> date('Y-m-d H:i:s')]);

        Session::flash('success', 'Product deleted successfully');

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function showCustomerInfos($id){
        $custreg = RegisteredProduct::with(['userdet','countrydet'])->where('Product_id',$id)->get();
        return view('admin.Product.customerdet', compact('custreg'));
    }
    public function status($status_id,$Product_id){
        $data['status']=$status_id;
        $data['Product']=$Product_id;
        Product::where('id',$data['Product'])->update(['status' => $data['status']]);
        $data="sucess fully updated the status";
        return \response()->json([
            'success'=>true,
            'data'=>$data,
        ]);
    }
}
