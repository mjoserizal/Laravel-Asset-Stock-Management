@extends('layouts.admin')
@section('content')
    @can('jenisobat_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.jenisobats.create") }}">
                    Add Jenis Obat
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            Jenis Obat
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Permission">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Jenis Obat
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jenisobat as $key => $jenisobat)
                        <tr data-entry-id="{{ $jenisobat->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $jenisobat->name ?? '' }}
                            </td>
                            <td>
                                @can('jenisobat_show')
                                    <a class="btn btn-xs btn-primary"
                                       href="{{ route('admin.jenisobats.show', $jenisobat->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('jenisobat_edit')
                                    <a class="btn btn-xs btn-info"
                                       href="{{ route('admin.jenisobats.edit', $jenisobat->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('jenisobat_delete')
                                    <form action="{{ route('admin.jenisobats.destroy', $jenisobat->id) }}" method="POST"
                                          onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                          style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger"
                                               value="{{ trans('global.delete') }}">
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
            @can('permission_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.permissions.massDestroy') }}",
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
            $('.datatable-Permission:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

    </script>
@endsection
