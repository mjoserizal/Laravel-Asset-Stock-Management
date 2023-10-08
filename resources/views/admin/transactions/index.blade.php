@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Transaksi
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Transaction">
                    <thead>
                    <tr>
                        <th>
                            Waktu
                        </th>
                        <th>
                            Nama Obat
                        </th>
                        <th>
                            {{ trans('cruds.transaction.fields.user') }}
                        </th>
                        <th>
                            Stok
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $key => $transaction)
                        <tr data-entry-id="{{ $transaction->id }}">
                            <td>
                                {{ $transaction->created_at}}
                            </td>
                            <td>
                                {{ $transaction->asset->name ?? '' }}
                            </td>
                            <td>
                                {{ $transaction->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $transaction->stock ?? '' }}
                            </td>
                            <td>
                                @if ($transaction['is_transaction'] == 1)
                                    <a class="btn btn-xs btn-success"
                                       href="{{ route('admin.transactions.statusTransaction', $transaction->id) }}">
                                        Sudah Diambil
                                    </a>
                                @else
                                    <a class="btn btn-xs btn-warning"
                                       href="{{ route('admin.transactions.statusTransaction', $transaction->id) }}">
                                        Belum Diambil
                                    </a>
                                @endif

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

            $.extend(true, $.fn.dataTable.defaults, {
                order: [[0, 'desc']],
                pageLength: 100,
                columnDefs: [{
                    orderable: true,
                    className: '',
                    targets: 0
                }]
            });
            $('.datatable-Transaction:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

    </script>
@endsection
