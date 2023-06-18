@extends('layouts.main')

@section('container')
    @include('partials.sidebar')
    <div class="alert-container"></div>

    <div class="container">
        <h1>Katalog Pulsa</h1>
        @can('user')
            <div class="row mt-3 g-3">
                <div class="col-md-9">
                    <div class="row g-3">
                        @foreach ($items as $item)
                            <div class="col-md-4">
                                <div class="card card-hover" data-pulsa-id="{{ $item->id }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->provider }}</h5>
                                        <p class="card-text">{{ $item->option }} Price: Rp{{ $item->price }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card" id="">
                        <div class="card-header">
                            <h2>Order</h2>
                        </div>
                        <div class="card-body">
                            <form id="addCartForm" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="dest_number" name="dest_number"
                                        placeholder="Masukkan nomor telepon" required>
                                </div>
                                <div class="row g-2">
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-secondary w-100" id="addToCartBtn">Add to
                                            Cart</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-outline-secondary w-100" id="orderNowBtn">Order
                                            Now</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        @can('admin')
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-create-form">
                <i class="bi bi-plus"></i> Add Katalog
            </button>
            <div class="row g-2 mt-2">
                <div class="col-md-8">
                    <table class="table table-bordered table-hover table-striped" id='table-data'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Provider</th>
                                <th>Option</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-data">
                            @foreach ($items as $item)
                                <tr id="index_{{ $item->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td id="provider">{{ $item->provider }}</td>
                                    <td id="option">{{ $item->option }}</td>
                                    <td id="price">{{ $item->price }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-info"
                                                data-item="{{ $item }}">
                                                <i class="bi bi-info-square" id="btn-info-item"></i>
                                            </button>
                                            <button class="btn btn-warning edit-btn" data-bs-toggle="modal"
                                                data-bs-target="#modal-edit-form" data-item="{{ $item }}"
                                                id="btn-edit-item">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <form action="/items/{{ $item->id }}" method="post"
                                                id="delete-form-{{ $item->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-delete-item"
                                                    data-item-id={{ $item->id }}>
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endcan
    </div>


    @include('partials.modal_info_item')
    @include('partials.modal_edit_item')
    @include('partials.modal_create_item')
    @include('partials.script')
    <script>
        @can('user')

            $(document).ready(function() {
                var selectedPulsaId = null;
                var url = null;
                $('.card-hover').hover(function() {
                    $(this).css('cursor', 'pointer');
                }, function() {
                    $(this).css('cursor', 'default');
                });

                $('.card-hover').click(function(event) {
                    event.preventDefault();
                    $('.card').removeClass('text-bg-secondary');
                    $(this).addClass('text-bg-secondary');
                    selectedPulsaId = $(this).data('pulsa-id');
                });

                $('#addToCartBtn').click(function(e) {
                    e.preventDefault();
                    if (selectedPulsaId !== null && $('#dest_number').val() !== "") {
                        url = '/transaction/addcart/' + selectedPulsaId;
                        $('#addCartForm').attr('action', '/transaction/addcart/' + selectedPulsaId);
                        $('#addCartForm').submit();
                    } else {
                        showAlert('danger', 'Please select a pulsa card and enter the phone number');
                    }
                });

                $('#orderNowBtn').click(function(e) {
                    e.preventDefault();
                    if (selectedPulsaId !== null && $('#dest_number').val() !== "") {
                        $('#addCartForm').attr('action', '/transaction/ordernow/' + selectedPulsaId);
                        $('#addCartForm').submit();
                    } else {
                        showAlert('danger', 'Please select a pulsa card and enter the phone number');
                    }
                });

                function showAlert(type, message) {
                    var alertClass = 'alert-' + type;

                    // Membuat alert menggunakan Bootstrap
                    var alertHTML = '<div class="alert ' + alertClass +
                        ' alert-dismissible fade show" role="alert">';
                    alertHTML += message;
                    alertHTML +=
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    alertHTML += '</div>';

                    // Menampilkan alert di dalam elemen dengan id "alerts-container"
                    $('.alert-container').html(alertHTML);
                }
            });
        @endcan

        @can('admin')
            $(document).ready(function() {

                // edit-form
                $('#modal-edit-form').on('show.bs.modal', function(event) {

                    var button = $(event.relatedTarget); // Tombol atau link yang memicu modal
                    var item = button.data('item');

                    // Mengisi input di dalam modal dengan nilai item_id
                    $('#edit-provider').val(item.provider);
                    $('#edit-option').val(item.option);
                    $('#edit-price').val(item.price);
                    $('#edit-id').val(item.id);

                });

                $('#modal-edit-form').submit(function(e) {
                    e.preventDefault();
                    // Mengirim form secara AJAX
                    let item_id = $('#edit-id').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: `/items/${item_id}`,
                        type: 'patch',
                        data: {
                            provider: $('#edit-provider').val(),
                            option: $('#edit-option').val(),
                            price: $('#edit-price').val(),
                            // _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // Form berhasil dikirim, lakukan tindakan sesuai kebutuhan
                            // Misalnya, tutup modal, muat ulang data, dll.
                            $('#modal-edit-form').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                            }).then(function() {
                                // Muat ulang halaman
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            // Terjadi error saat validasi input
                            if (xhr.status === 422) {
                                // Parse response JSON untuk mendapatkan pesan error
                                var errors = xhr.responseJSON.errors;

                                $('#modal-edit-form .is-invalid').removeClass('is-invalid');
                                $('#modal-edit-form .invalid-feedback').remove();

                                // Tampilkan pesan error di dalam modal
                                $.each(errors, function(key, value) {
                                    var errorHtml = '<div class="invalid-feedback">' +
                                        value[0] + '</div>';

                                    // Mencari elemen input berdasarkan atribut name
                                    var $input = $('input[name="' + key + '"]');

                                    console.log('masuk');
                                    // Field tidak valid, tambahkan atau perbarui pesan error
                                    var errorHtml =
                                        '<div class="invalid-feedback">' +
                                        value[0] + '</div>';

                                    $input.addClass('is-invalid').after(errorHtml);
                                });
                            }
                        }
                    });
                });

                $('#modal-edit-form').on('hidden.bs.modal', function() {
                    // Hapus pesan error dan kelas is-invalid pada semua input di dalam modal
                    $('.invalid-feedback').remove();
                    $('.is-invalid').removeClass('is-invalid');
                });

                //create-form
                $('#modal-create-form').submit(function(e) {
                    e.preventDefault();
                    // Mengirim form secara AJAX

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: `/items`,
                        type: 'post',
                        data: {
                            provider: $('#create-provider').val(),
                            option: $('#create-option').val(),
                            price: $('#create-price').val(),
                        },
                        success: function(response) {
                            console.log('success');
                            // Form berhasil dikirim, lakukan tindakan sesuai kebutuhan
                            // Misalnya, tutup modal, muat ulang data, dll.
                            $('#modal-create-form').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                            }).then(function() {
                                // Muat ulang halaman
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            // Terjadi error saat validasi input
                            if (xhr.status === 422) {
                                // Parse response JSON untuk mendapatkan pesan error
                                var errors = xhr.responseJSON.errors;

                                $('#modal-create-form .is-invalid').removeClass('is-invalid');
                                $('#modal-create-form .invalid-feedback').remove();

                                // Tampilkan pesan error di dalam modal
                                $.each(errors, function(key, value) {
                                    var errorHtml = '<div class="invalid-feedback">' +
                                        value[0] + '</div>';

                                    // Mencari elemen input berdasarkan atribut name
                                    var $input = $('input[name="' + key + '"]');
                                    // Field tidak valid, tambahkan atau perbarui pesan error
                                    $input.addClass('is-invalid').after(errorHtml);
                                });
                            }
                        }
                    });
                });

                $('#modal-create-form').on('hidden.bs.modal', function() {
                    // Hapus pesan error dan kelas is-invalid pada semua input di dalam modal
                    $('.invalid-feedback').remove();
                    $('.is-invalid').removeClass('is-invalid');
                });


                //delete-form

                $('.btn-delete-item').click(function(e) {
                    e.preventDefault();
                    var item_id = $(this).data('item-id');
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
                            $(`#delete-form-${item_id}`).submit();
                        }
                    });
                });


                //info-item
                $('#modal-info').on('show.bs.modal', function(event) {

                    var button = $(event.relatedTarget); // Tombol atau link yang memicu modal
                    var item = button.data('item');

                    // Mengisi input di dalam modal dengan nilai item_id
                    $('#info-item-id').text(item.id);
                    $('#info-item-provider').text(item.provider);
                    $('#info-item-option').text(item.option);
                    $('#info-item-price').text(item.price);

                });

            });
        @endcan
    </script>
@endsection
