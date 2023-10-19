@extends('layouts.admin')
@section('content')
    @can('stock_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12 mt-2">
                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.stock.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Stock">
                    <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.stock.fields.asset') }}
                        </th>
                        @admin
                        <th>
                            Hospital
                        </th>
                        @endadmin
                        @admin
                        <th>
                            Stok Sekarang
                        </th>
                        @endadmin
                        @user
                        <th>
                            Stok Tersedia
                        </th>
                        @enduser
                        @admin
                        <th>
                            Tambah Stok
                        </th>
                        @endadmin
                        @user
                        <th>
                            Pesan
                        </th>
                        @enduser
                        @admin
                        <th>
                            Kurangi Stok
                        </th>
                        @endadmin
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stocks as $key => $stock)
                        <tr>
                            <td>
                                {{ $stock->disposable->name ?? '' }}
                            </td>
                            @admin
                            <td>
                                {{ $stock->team->name }}
                            </td>
                            @endadmin
                            <td>
                                {{ $stock->current_stock ?? '' }}
                            </td>
                            @can('stock_create')
                                <td>
                                    <form
                                        action="{{ route('admin.transactionsDisposable.storeStockDisposable', $stock->id) }}"
                                        method="POST" style="display: inline-block;" class="form-inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="action" value="add">
                                        <input type="number" name="stock" class="form-control form-control-sm col-4"
                                               min="1">
                                        <input type="submit" class="btn btn-xs btn-danger" value="TAMBAH">
                                    </form>
                                </td>
                            @endcan
                            @can('stock_delete')
                                <td>
                                    <form
                                        action="{{ route('admin.transactionsDisposable.storeStockDisposable', $stock->id) }}"
                                        method="POST" style="display: inline-block;" class="form-inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="action" value="remove">
                                        <input type="number" name="stock" class="form-control form-control-sm col-4"
                                               min="1">
                                        <input type="submit" class="btn btn-xs btn-danger" value="REMOVE">
                                    </form>
                                </td>
                            @endcan

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

            $.extend(true, $.fn.dataTable.defaults, {
                order: [[1, 'desc']],
                pageLength: 100,
                columnDefs: [{
                    orderable: true,
                    className: '',
                    targets: 0
                }]
            });
            $('.datatable-Stock:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

    </script>
@endsection
