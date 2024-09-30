@extends('layouts.admin')
@section('content')
<h6 class="c-grey-900 bld_hdng_fnt site_font">
    Show Category
</h6>
<div class="mT-30">
    <div class="mb-2">
        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <th>
                    Id
                </th>
                <td>
                    {{ $category->id }}
                </td>
            </tr>
            <tr>
                <th>
                    Name
                </th>
                <td>
                    {{ $category->name }}
                </td>
            </tr>
            <tr>
                <th>
                    Thumbnail
                </th>
                <td>
                <img src="{{url('/'.$category->thumbnail)}}" alt='image'>
                </td>
            </tr>
            </tbody>
        </table>
        <a class="btn btn-activeclr text-center mt-20" href="{{ url()->previous() }}">
            Back to List
        </a>
    </div>
</div>
@endsection
