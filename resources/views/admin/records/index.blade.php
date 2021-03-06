@extends('layouts.admin')
@section('content')
@can('record_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.records.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.record.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.record.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Record">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.record.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.record.fields.doctor') }}
                        </th>
                        <th>
                            {{ trans('cruds.record.fields.start') }}
                        </th>
                        <th>
                            {{ trans('cruds.record.fields.end') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $key => $record)
                        <tr data-entry-id="{{ $record->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $record->id ?? '' }}
                            </td>
                            <td>
                                {{ $record->doctor->name ?? '' }}
                            </td>
                            <td>
                                {{ $record->start ?? '' }}
                            </td>
                            <td>
                                {{ $record->end ?? '' }}
                            </td>
                            <td>
                                @can('record_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.records.show', $record->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('record_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.records.edit', $record->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('record_delete')
                                    <form action="{{ route('admin.records.destroy', $record->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('record_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.records.massDestroy') }}",
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
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Record:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection