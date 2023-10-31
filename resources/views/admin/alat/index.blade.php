@extends("layouts.admin")
@section("content")
    @can("alat_create")
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.alat.create") }}">
                    Tambah Alat
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            List Alat
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Asset">

                    <thead>
                        <tr>
                            <th width="10">
                            </th>
                            <th>
                                {{ trans("cruds.asset.fields.id") }}
                            </th>
                            <th>
                                {{ trans("cruds.asset.fields.name") }}
                            </th>
                            <th>
                                {{ trans("cruds.asset.fields.description") }}
                            </th>
                            <th>
                                Keterangan
                            </th>
                            <th>
                                Image
                            </th>

                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alat as $key => $alat)
                            <tr data-entry-id="{{ $alat->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $alat->id ?? "" }}
                                </td>
                                <td>
                                    {{ $alat->name ?? "" }}
                                </td>
                                <td>
                                    {{ $alat->description ?? "" }}</td>
                                <td>
                                    <span class="badge badge-info">{{ $alat->keterangan }}</span>
                                </td>
                                <td>
                                    @if ($alat->image_path)
                                        <img src="{{ asset($alat->image_path) }}" alt="Asset Image" width="100">
                                    @else
                                        No Image Available
                                    @endif
                                </td>

                                <td>

                                    @can("alat_show")
                                        <a class="btn btn-xs btn-primary" href="{{ route("admin.alat.show", $alat->id) }}">
                                            {{ trans("global.view") }}
                                        </a>
                                    @endcan

                                    @can("alat_edit")
                                        <a class="btn btn-xs btn-info" href="{{ route("admin.alat.edit", $alat->id) }}">
                                            {{ trans("global.edit") }}
                                        </a>
                                    @endcan

                                    @can("alat_delete")
                                        <form action="{{ route("admin.alat.destroy", $alat->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans("global.areYouSure") }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger"
                                                value="{{ trans("global.delete") }}">
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
@section("scripts")
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can("asset_delete")
                let deleteButtonTrans = '{{ trans("global.datatables.delete") }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route("admin.assets.massDestroy") }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans("global.datatables.zero_selected") }}')

                            return
                        }

                        if (confirm('{{ trans("global.areYouSure") }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            $('.datatable-Asset:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })
    </script>
@endsection
