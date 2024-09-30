@extends('layouts.admin')
@section('content')

<h6 class="c-grey-900 bld_hdng_fnt site_font">
    Create Category
</h6>
<div class="mT-30 col-md-6">
    <form id ="categoryform" action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name">Category Name<span class="compulsory">* </span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($category) ? $category->name : '') }}" >
            @if($errors->has('name'))
                <em class="invalid-feedback">
                    {{ $errors->first('name') }}
                </em>
            @endif
            <p class="helper-block">
            </p>
            <label for="image">image<span class="compulsory">* </span></label><br>
            <input type="file" id="name" name="image"  value="{{ old('image', isset($category) ? $category->image : '') }}" >
            @if($errors->has('image'))
                <em class="invalid-feedback">
                    {{ $errors->first('image') }}
                </em>
            @endif
            <p class="helper-block">
            </p>
        </div>
        <div class="mt-3">
            <input class="btn save_btn" type="submit" value="save">
            <a href="{{ url('/admin/category')}}"><input type="button" class="btn cancel_btn" value="cancel"></a>
        </div>
    </form>
</div>
<script>
   
        $("#categoryform").validate({
 
            rules: {
                name: {
                    required: true,
                
                },
            },
            messages: {
                name: {
                    required:  "Category is required",
                },
  
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
 </script>
@endsection
