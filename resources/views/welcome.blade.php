<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Beeproger Assignment</title>

        <!-- Meta -->
        <meta name="description" content="To-do and shopping list">
        <meta name="author" content="Jeremiah Ovabor">

        <!-- vendor css -->
        <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('lib/typicons.font/typicons.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/sweetalert2.css')}}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>

        <script src="{{asset('lib/jquery/jquery.min.js')}}"></script>
    </head>
    <body class="bg-light">

        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
            <a class="navbar-brand mr-auto mr-lg-0" href="#">Beeproger shopping Assignment</a>
            <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>

        <main role="main" class="container mt-8">

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
        </main>

        <!-- create list Modal -->
        <div class="modal fade" id="createListModal" tabindex="-1" role="dialog" aria-labelledby="createListModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="modal_content">

                </div>
            </div>
        </div>

        <script src="{{asset('lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <script src="{{asset('lib/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
        <script src="{{asset('lib/parsleyjs/parsley.min.js')}}"></script>
        <script src="{{asset('js/sweetalert.js')}}"></script>
        <script src="{{asset('js/custom.js')}}"></script>

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
                                showAlert('Great!', 'New list created', 'success');
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
    </body>
</html>
