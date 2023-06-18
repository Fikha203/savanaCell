@extends('layouts.main')

@section('container')
    @include('partials.sidebar')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            @can('admin')
                                <th>ID User</th>
                            @endcan
                            <th>Waktu Transaksi</th>
                            <th>Total Harga</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $tr)
                            <tr>
                                <td>{{ $tr->id }}</td>
                                @can('admin')
                                    <td>{{ $tr->user_id }}</td>
                                @endcan
                                <td>{{ $tr->transaction_time }}</td>
                                <td>{{ $tr->total_price }}</td>
                                <td>
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-info"
                                        data-transaction='@json($tr->transactionDetail)'>
                                        <i class="bi bi-info-square" id="btn-info-item"></i>
                                    </button>
                                    {{-- <a href="/transactionDetail/{{ $tr->id }}" class="btn btn-secondary">Details</a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('partials.modal_info_transaction')
    @include('partials.script')

    <script>
        $(document).ready(function() {
            $('#modal-info').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var transactionDetail = button.data('transaction');
                // var item = button.data('item');
                // console.log(item);
                var modal = $(this);

                // Mengosongkan isi tabel sebelum melakukan loop
                modal.find('tbody').empty();

                // Melakukan loop pada transactionDetail dan menambahkan baris ke dalam tabel
                if (transactionDetail) {
                    transactionDetail.forEach(function(detail) {
                        var row = '<tr>' +
                            '<td>' + detail.item.provider + '</td>' +
                            '<td>' + detail.item.option + '</td>' +
                            '<td>' + detail.item.price + '</td>' +
                            '<td>' + detail.dest_number + '</td>' +
                            '</tr>';

                        modal.find('tbody').append(row);
                    });
                }
            });
        });
    </script>
@endsection
