@extends('layouts.admin')
@section('content')
@foreach (['danger', 'warning', 'success', 'info'] as $key)
 @if(Session::has($key))
        <p class="alert alert-{{ $key }}">{{ Session::get($key) }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </p>
 @endif
@endforeach

<div class="mT-10">
    @can('category_create')
        <div class="row mB-20">
            <div class="col-lg-6">
                <h6 class="c-grey-900 bld_hdng_fnt site_font">
                    Category List
                </h6>
            </div>
            <div class="col-lg-6">
                <a class="btn site_btn float-right" href="{{ route('admin.category.create') }}">
                    Add Category
                </a>
            </div>
        </div>
    @endcan
    <div class="table-responsive">
        <table class=" table table-bordered table-striped table-hover datatable datatable-Category">
            <thead>
            <tr>
                <th width="10">

                </th>
                <th>
                    Id
                </th>
                <th>
                    Name
                </th>
                <th>
                    Thumbnail
                </th>
                <th>
                    Status
                </th>
                <th>
                    &nbsp;Action
                </th>
            </tr>
            </thead>
            <tbody>
            @php
                $i = 1
            @endphp
            @if(count($category) > 0)
            @foreach($category as $key => $categories)
                <tr data-entry-id="{{ $categories->id }}">
                    <td>

                    </td>
                    <td>
                        {{ $i++ }}
                    </td>
                    <td>
                        {{ $categories->name ?? '' }}

                    </td>
                    <td>
                        <img src="{{url('/'.$categories->thumbnail)}}" alt='image' width="75" height="75">

                    </td>
                    
                    <td>
                        <input id="toggle-trigger" class="toggle-class" data-id="{{$categories->id}}" data-value="category" type="checkbox" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="activeclr" data-offstyle="inactiveclr" {{ $categories->status ? 'checked' : '' }}>
                    </td>
                    <td>
                    
                        <a class="btn" href="{{ route('admin.category.show', $categories->id) }}">
                            <i class="fa fa-eye fa-lg site_drk_clr"></i>
                        </a>
                    
                        <a class="btn" href="{{ route('admin.category.edit', $categories->id) }}">
                            <i class="fa fa-edit fa-lg site_drk_clr"></i>
                        </a>
        
                        <form action="{{ route('admin.category.destroy', $categories->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="display-inline-block">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn" type="submit" value=""><i class="fa fa-trash fa-lg site_drk_clr"></i></button>
                        </form>
                   
                    </td>

                </tr>
            @endforeach
            @else
                <tr>
                    <td class="text-center no-select-checkbox" colspan="8"> No Category Found</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('category_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.categories.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'asc' ]],
    pageLength: 10,
    columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0

    }], 
    select: {
      style:    'multi+shift',
      selector: 'td:first-child'
    },
  });
  $('.datatable-Category:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
