@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Detail Alat
        </div>

        <div class="card-body">
            <div class="form-group">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Asset">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.asset.fields.id') }}
                        </th>
                        <td>
                            {{ $alat->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.asset.fields.name') }}
                        </th>
                        <td>
                            {{ $alat->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.asset.fields.description') }}
                        </th>
                        <td>
                            {{ $alat->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Keterangan
                        </th>
                        <td>
                            {{ $alat->keterangan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Image
                        </th>
                        <td>
                            @if($alat->image_path)
                                <img src="{{ asset($alat->image_path) }}" alt="Asset Image" width="100">
                            @else
                                No Image Available
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Barcode
                        </th>
                        @if ($alat->getBarcodeContentAttribute())
                            <td>{!! \Milon\Barcode\DNS1D::getBarcodeHTML($alat->getBarcodeContentAttribute(), 'C128') !!}</td>
                        @else
                            <td>No Asset Code Available</td>
                        @endif

                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.alat.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('asset_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.assets.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).nodes(), function (entry) {
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
                            data: {ids: ids, _method: 'DELETE'}
                        })
                            .done(function () {
                                location.reload()
                            })
                    }
                }
            }
            dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                order: [[1, 'desc']],
                pageLength: 100,
            });
            $('.datatable-Asset:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

    </script>
@endsection
