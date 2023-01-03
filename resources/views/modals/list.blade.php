<div class="modal-header">
    <h5 class="modal-title" id="titleModalLabel"> @if(!empty($list)) Update list title @else Create a {{ $type }} List @endif </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form method="{{ (empty($list))? 'POST': 'PATCH' }}" action="lists{{ (!empty($list))? '/'. $list->id : '' }}" id="createListForm">
    <div class="modal-body">
        <div class="form-group">
            <label for="title">List title</label>
            <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelp" @if(!empty($list)) value="{{ $list->title }}" @endif>
            <input type="hidden" id="type" name="type" value="{{ $type }}">
            <small id="titleHelp" class="form-text text-muted">Please give your list a title</small>
        </div>
        <div id="error"></div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="create-list-button">@if(!empty($list)) Update @else Create @endif List</button>
    </div>
</form>
