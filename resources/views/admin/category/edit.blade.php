@extends('layouts.admin')
@section('content')

<h6 class="c-grey-900 bld_hdng_fnt site_font">
    Edit Category
</h6>
<div class="mT-30 col-md-6">
    <form id = "editcategoryform" action="{{ route('admin.category.update', [$category->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name">Name<span class="compulsory">* </span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{$category->name}}" required>
            @if($errors->has('name'))
                <em class="invalid-feedback">
                    {{ $errors->first('name') }}
                </em>
            @endif
            <label for="image">Image<span class="compulsory">* </span></label><br>
            <input type="file" id="name" name="image"  value="image">
            <img src="{{url('/'.$category->thumbnail)}}" alt='image' style="width: 300px; padding-top: 10px;">
            @if($errors->has('image'))
                <em class="invalid-feedback">
                    {{ $errors->first('image') }}
                </em>
            @endif
        </div>
        
        <div class="mt-3 text-center">
            <input class="btn save_btn" type="submit" value="update">
            <a href="{{ url('/admin/category')}}"><input type="button" class="btn cancel_btn" value="cancel"></a>
        </div>
    </form>
</div>


@endsection
