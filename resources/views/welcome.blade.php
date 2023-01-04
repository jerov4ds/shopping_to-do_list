@extends('..layout.main')
@section('content')
            <div class="row" style="margin-top: 5em">
                <div class="col-6">
                    <div class="my-8 p-3 bg-white rounded shadow-sm">
                        <h6 class="border-bottom border-gray pb-2 mb-0">My To-do Lists <button class="btn btn-sm btn-primary" title="Create todo list" onclick="createList('todo')" data-toggle="modal" data-target="#createListModal">+</button></h6>
                        @if(!empty($lists->todo->data))
                            @foreach($lists->todo->data as $list)
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card mb-3 card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="overflow-hidden flex-nowrap">
                                                        <h6 class="mb-1">
                                                            <a href="/list/{{ $list->id }}/items" class="text-reset">{{ $list->title }}</a>
                                                            <button class="btn btn-sm btn-warning float-right ml-1" onclick="deleteList('{{ $list->id }}')" id="deleteList{{ $list->id }}"><i class="fa fa-trash"></i></button>
                                                            <button class="btn btn-sm btn-success float-right ml-1"  onclick="createList('todo', '{{ $list->id }}')" data-toggle="modal" data-target="#createListModal"><i class="fa fa-pencil"></i></button>
                                                        </h6>
                                                        <span class="text-muted d-block mb-2 small">{{ \Carbon\Carbon::parse($list->updated_at)->diffForhumans() }}</span>
                                                        <div class="row align-items-center">
                                                            <div class="col-12">
                                                                @if($list->items_count > 0)
                                                                    <div class="row align-items-center g-0">
                                                                        <div class="col-auto">
                                                                                <small class="me-2">{{ ceil(($list->completed/$list->items_count) * 100) }}%</small>
                                                                            </div>
                                                                        <div class="col">
                                                                            <div class="progress bg-tint-success" style="height: 4px;">
                                                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ ceil(($list->completed/$list->items_count) * 100) }}%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <span class="d-block small text-muted">No items added at the moment</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card mb-3 card-body">
                                        <span class="d-block small text-muted">No to-do list added</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <div class="my-8 p-3 bg-white rounded shadow-sm" style="min-height: 50vh">
                        <h6 class="border-bottom border-gray pb-2 mb-0">Shopping Lists <button class="btn btn-sm btn-primary" title="Create todo list" onclick="createList('shopping')" data-toggle="modal" data-target="#createListModal">+</button></h6>
                        @if(!empty($lists->shopping->data))
                            @foreach($lists->shopping->data as $list)
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card mb-3 card-body">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="overflow-hidden flex-nowrap">
                                                        <h6 class="mb-1">
                                                            <a href="/list/{{ $list->id }}/items" class="text-reset">{{ $list->title }}</a>
                                                            <button class="btn btn-sm btn-warning float-right ml-1" onclick="deleteList('{{ $list->id }}')" id="deleteList{{ $list->id }}"><i class="fa fa-trash"></i></button>
                                                            <button class="btn btn-sm btn-success float-right ml-1"  onclick="createList('todo', '{{ $list->id }}')" data-toggle="modal" data-target="#createListModal"><i class="fa fa-pencil"></i></button>
                                                        </h6>
                                                        <span class="text-muted d-block mb-2 small">{{ \Carbon\Carbon::parse($list->updated_at)->diffForhumans() }}</span>
                                                        <div class="row align-items-center">
                                                            <div class="col-12">
                                                                @if($list->items_count > 0)
                                                                    <div class="row align-items-center g-0">
                                                                        <div class="col-auto">
                                                                            <small class="me-2">{{ ceil(($list->completed/$list->items_count) * 100) }}%</small>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="progress bg-tint-success" style="height: 4px;">
                                                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ ceil(($list->completed/$list->items_count) * 100) }}%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <span class="d-block small text-muted">No items added at the moment</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card mb-3 card-body">
                                        <span class="d-block small text-muted">No to-do list added</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- list Modal -->
            <div class="modal fade" id="createListModal" tabindex="-1" role="dialog" aria-labelledby="createListModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" id="modal_content">

                    </div>
                </div>
            </div>
@endsection

@section('pageScript')
    <script>
        $("#alert").fadeTo(5000, 500).slideUp(500, function(){
            $("#alert").slideUp(500);
        });

        function createList(type, list_id = ''){
            $.get( "/lists/modal", { type, list_id } )
                .done(function( data ) {
                    $('#modal_content').html(data)
                });
        }

        function deleteList(list_id){
            var result = confirm("Are you sure you want to delete this list and all its Items?");
            if (result) {
                $('#deleteList' + list_id).prop('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>");
                $.ajax({
                    type: "DELETE",
                    url: '{{ config('app.base_url') }}' + '/lists/' + list_id,
                    dataType: "JSON",
                    success: function (data) {
                        if (data.code == 200) {
                            showAlert('Great!', 'Item deleted', 'success');
                            $('#deleteList' + list_id).prop('disabled', true).html("DELETED, <i class='fa fa-check-circle'></i>");
                            window.location.reload();
                        }
                    },
                    error: function (xhr, status, error) {
                        $('#deleteList' + list_id).prop('disabled', false).html('<i class="fa fa-trash"></i>');
                        showAlert('Error!', 'Something ism\'t right', 'warning');
                    }
                })
            }
        }

        $(document).on('submit', '#createListForm', function (e){
            e.preventDefault();
            $('#create-list-button').prop('disabled', true).html("Creating... <i class='fa fa-spinner fa-spin'></i>");
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
                        showAlert('Great!', 'New list created', 'success');
                        $('#create-list-button').prop('disabled', true).html("LIST CREATED, PLEASE WAIT! <i class='fa fa-check-circle'></i>");
                        window.location.reload();
                    }
                    else {
                        $('#create-list-button').prop('disabled', false).html("Create Account");
                        showAlert('Error!', 'Something ism\'t right', 'warning');
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseJSON);
                    $('#create-list-button').prop('disabled', false).html("Create Account");
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
    </script>
@endsection
