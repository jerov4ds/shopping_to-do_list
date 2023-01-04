@extends('..layout.main')

@section('content')
    <style>
        /*body {*/
        /*    overflow-y: hidden;*/
        /*}*/
        .items-area {
            position: relative;
            height: 380px;
            overflow-y: auto

        }
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius:10px;
        }
    </style>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-12 col-xl-10">

                    <div class="card">
                        <div class="card-header p-3">
                            <h5 class="mb-0"><i class="fa fa-tasks me-2"></i> {{ $list->title }}</h5>
                        </div>
                        <div class="card-body items-area">
                            @if(!empty($list->items))
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Image</th>
                                            <th scope="col">Task</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Updated</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($list->items as $item)
                                            <tr class="fw-normal">
                                                <th>
                                                    <img src="{{ ($item->image)? asset('img/'. $item->image): asset('img/no_image.jpg') }}"
                                                         class="shadow-1-strong rounded-circle" alt="{{ $item->title }}"
                                                         style="width: 55px; height: auto;">
                                                </th>
                                                <td class="align-middle">
                                                    <a href="#" title="view details" onclick="fetchItemDetails('{{ $item->id }}')" data-toggle="modal" data-target="#itemsDetailsModal"><span>{{ $item->title }}</span></a>
                                                </td>
                                                <td class="align-middle">
                                                    <h6 class="mb-0">
                                                        <span class="badge @if($item->is_complete) bg-success @else bg-warning @endif">{{ ($item->is_complete)? 'Completed': 'Pending' }}</span>
                                                    </h6>
                                                </td>
                                                <td class="align-middle">
                                                    <h6 class="mb-0">{{ \Carbon\Carbon::parse($item->updated_at)->diffForhumans() }}</h6>
                                                </td>
                                                <td class="align-middle">
                                                    @if(!$item->is_complete)
                                                    <a href="#!" data-mdb-toggle="tooltip" title="Mark as complete" id="complete{{ $item->id }}" onclick="markComplete('{{ $item->id }}')"><i
                                                            class="fa fa-check text-success me-3"></i></a>
                                                    @endif
                                                    <a href="#!" data-mdb-toggle="tooltip" title="Edit task" onclick="fetchModalContent('{{ $item->id }}')" data-toggle="modal" data-target="#itemsFormModal"><i
                                                            class="fa fa-pencil text-info me-3"></i></a>
                                                    <a href="#!" data-mdb-toggle="tooltip" title="Remove" id="deleteItem{{ $item->id }}" onclick="deleteItem('{{ $item->id }}')"><i
                                                            class="fa fa-trash text-danger"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                No items have been added to this list
                            @endif

                        </div>
                        <div class="card-footer text-end p-3">
                            <a href="/" class="me-2 btn btn-link">Return</a>
                            <button class="btn btn-primary float-right" onclick="fetchModalContent()" data-toggle="modal" data-target="#itemsFormModal">Add Item</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Item Modal -->
    <div class="modal fade" id="itemsFormModal" tabindex="-1" role="dialog" aria-labelledby="itemsFormModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modal_content">

            </div>
        </div>
    </div>

    <!-- Item Modal -->
    <div class="modal fade" id="itemsDetailsModal" tabindex="-1" role="dialog" aria-labelledby="itemsDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="DetailsContent">

            </div>
        </div>
    </div>
@endsection

@section('pageScript')
    <script>
        function fetchModalContent(item_id = ''){
            $.get( "/list/items/modal", { item_id, category_id : '{{ $list->id }}' } )
                .done(function( data ) {
                    $('#modal_content').html(data)
                });
        }
        function fetchItemDetails(item_id){
            $.get( "/list/items/" + item_id )
                .done(function( data ) {
                    $('#DetailsContent').html(data)
                });
        }

        function markComplete(item_id){
            var result = confirm("Are you about to mark this item as complete?");
            if (result) {
                $('#complete' + item_id).prop('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>");
                $.ajax({
                    type: "PATCH",
                    url: '{{ config('app.base_url') }}' + '/items/' + item_id,
                    dataType: "JSON",
                    success: function (data) {
                        if (data.code == 200) {
                            showAlert('Great!', 'Item marked as completed', 'success');
                            $('#complete' + item_id).prop('disabled', true).html("DONE, <i class='fa fa-check-circle'></i>");
                            window.location.reload();
                        }
                    },
                    error: function (xhr, status, error) {
                        $('#complete' + item_id).prop('disabled', false).html('<i class="fa fa-trash"></i>');
                        showAlert('Error!', 'Something ism\'t right', 'warning');
                    }
                })
            }
        }

        function deleteItem(item_id){
            var result = confirm("Are you sure you want to remove this item from the list?");
            if (result) {
                $('#deleteItem' + item_id).prop('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>");
                $.ajax({
                    type: "DELETE",
                    url: '{{ config('app.base_url') }}' + '/items/' + item_id,
                    dataType: "JSON",
                    success: function (data) {
                        if (data.code == 200) {
                            showAlert('Great!', 'Item deleted', 'success');
                            $('#deleteItem' + item_id).prop('disabled', true).html("DELETED, <i class='fa fa-check-circle'></i>");
                            window.location.reload();
                        }
                    },
                    error: function (xhr, status, error) {
                        $('#deleteItem' + item_id).prop('disabled', false).html('<i class="fa fa-trash"></i>');
                        showAlert('Error!', 'Something ism\'t right', 'warning');
                    }
                })
            }
        }

        $(document).on('submit', '#itemForm', function (e){
            e.preventDefault();
            $('#add-item-button').prop('disabled', true).html("Creating... <i class='fa fa-spinner fa-spin'></i>");
            $('#error').html('');
            var url = '{{ config('app.base_url') }}' + '/' + $(this).attr('action');
            var method = $(this).attr('method');
            var formData = $(this).serialize();

            $.ajax({
                type: method,
                url: url,
                data: formData,
                dataType: "JSON",
                success: function (data) {
                    if (data.code == 200) {
                        showAlert('Great!', 'New Item Added', 'success');
                        $('#add-item-button').prop('disabled', true).html("Item Added, PLEASE WAIT! <i class='fa fa-check-circle'></i>");
                        window.location.reload();
                    }
                    else {
                        $('#add-item-button').prop('disabled', false).html("Create Account");
                        showAlert('Error!', 'Something ism\'t right', 'warning');
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseJSON);
                    $('#add-item-button').prop('disabled', false).html("Create Account");
                    if (xhr.code==500)
                    {
                        showAlert('Error!', 'Something ism\'t right', 'warning');
                    }
                    else {
                        var errors = processError(xhr.responseJSON.message);
                        $('#error').html(errors);
                    }
                }
            })
        });

        function getBaseUrl ()  {
            var file = document.querySelector('input[type=file]')['files'][0];
            var reader = new FileReader();
            var baseString;
            reader.onloadend = function () {
                baseString = reader.result;
                console.log(baseString);
                $('#image').val(baseString);
            };
            reader.readAsDataURL(file);
        }
    </script>
@endsection
