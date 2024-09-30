<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\MassDestroyCategoryRequest;
use Illuminate\Support\Facades\Auth;
use Session;

use App\Category;
use Illuminate\Support\Facades\Validator;
use Image;
use File;
use Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $category = Category::all();

        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $catexist = Category::where('name', $request['name'])->whereNull('deleted_at')->first();
        if (!$catexist) {
            $this->validate($request,[
                'name'=>'required|string|max:255',
                'image'=>'required|unique:category,image|mimes:jpeg,jpg,png,gif|max:20000',
               ]);
            $imagefile = $request->file('image');
            
        $imagename=$imagefile->getClientOriginalName();
        $imageextension=$imagefile->getClientOriginalExtension();
        $imagefilename=rand(100,999999).time().'.'.$imageextension; 
        
        $imagefile->move(public_path().'/category_image/image/', $imagefilename);
        $imagefile2=file::get(public_path().'/category_image/image/'.$imagefilename);
        $resizedImg = Image::make($imagefile2)->resize(340,261);

        $resizedImg->save(public_path().'/category_image/thumbnail/' .$imagefilename,100);
           
           
            
            
    

            $data['name']=$request['name'];
            $data['image'] ='category_image/image/'.$imagefilename;
           $data['thumbnail'] ='category_image/thumbnail/'.$imagefilename;
            
           Category::create($data);
            Session::flash('success', 'Category added successfully');
        }else{
            Session::flash('danger', 'Category already exist');
        }
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        abort_if(Gate::denies('category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( UpdateCategoryRequest $request, $id)
    {
        $category=Category::find($id);
        if( Category::where('name', '!=', $request['name'])->whereNotIn('name',[$category])){
        
            $this->validate($request,[
                'name'=>'required|string|max:255|unique:category,name,'.$id,
                ]);

                    if($request['image']!=" "){
                        if(isset($request['image'])) {
                        $Validator = Validator::make($request->all(),[
                            'image'=>'mimes:jpeg,jpg,png,gif|max:20000',]);
                            if ($Validator->fails()) {
    
                                return redirect()
                                    ->back();
                            }
                            $imagefile = $request->file('image');
            
                            $imagename=$imagefile->getClientOriginalName();
                            $imageextension=$imagefile->getClientOriginalExtension();
                            $imagefilename=rand(100,999999).time().'.'.$imageextension; 
        
                            $imagefile->move(public_path().'/category_image/image/', $imagefilename);
                            $imagefile2=file::get(public_path().'/category_image/image/'.$imagefilename);
                            $resizedImg = Image::make($imagefile2)->resize(340,261);

                            $resizedImg->save(public_path().'/category_image/thumbnail/' .$imagefilename,100);
                            $data['image'] ='category_image/image/'.$imagefilename;
                            $data['thumbnail'] ='category_image/thumbnail/'.$imagefilename;
                            $category['image']=$data['image'];
                            $category['thumbnail']=$data['thumbnail'];
                            $category->save();
                        }
                    }
                        $category['name']=$request['name'];
                        $category->save();
            Session::flash('success', 'Category updated successfully');
                }else{
                    Session::flash('success', 'Category already exist');
                }
            return redirect()->route('admin.category.index');
    }

    public function destroy(Category $category)
    {
        abort_if(Gate::denies('category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category->delete();

        Session::flash('success', 'Category deleted successfully');

        return back();

    }

    public function massDestroy(MassDestroyCategoryRequest $request)
    {
        Category::whereIn('id', request('ids'))->delete();

        Session::flash('success', 'Category deleted successfully');

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
