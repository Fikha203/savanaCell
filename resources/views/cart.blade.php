@extends('layouts.main')

@section('container')
    @include('partials.sidebar')
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Provider</th>
                            <th>Option</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $cr)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $cr->item->provider }}</td>
                                <td>{{ $cr->item->option }}</td>
                                <td>{{ $cr->item->price }}</td>
                                <td>

                                    <form action="/transaction/deletecart/{{ $cr->id }}" method="post"
                                        class="delete-form">
                                        @csrf
                                        <button class="btn btn-danger delete-btn">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Order</h4>
                    </div>
                    <div class="card-body">
                        @if (empty($cart) || $cart->isEmpty())
                            <h5 class="card-text">Total: Rp.0</h5>
                            <br>
                            <a class="btn btn-secondary w-100 disabled" href="/transaction/checkout/''"
                                role="button">CheckOut</a>
                        @else
                            <h5 class="card-text">Total: Rp.{{ $transaction->total_price }}</h5>
                            <br>
                            <a class="btn btn-secondary w-100" href="/transaction/checkout/{{ $transaction->id }}"
                                role="button">CheckOut</a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('partials.script')
    <script>
        $(document).ready(function() {
            $('.delete-btn').click(function(e) {
                e.preventDefault();
                var itemId = $(this).data('item-id');

                Swal.fire({
                    title: 'Delete Item!',
                    text: 'Are you sure you want to delete?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('.delete-form').submit();
                    }
                });
            });
        });
    </script>
@endsection
