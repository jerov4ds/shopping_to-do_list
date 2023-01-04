<div class="modal-header">
    <h5 class="modal-title" id="titleModalLabel"> {{ (!empty($item))? "Update" : "Add" }} Item </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form method="{{ (empty($item))? 'POST': 'PUT' }}" action="items{{ (!empty($item))? '/'. $item->id : '' }}" id="itemForm">
    <div class="modal-body">
        <div class="form-group">
            <label for="title">List title</label>
            <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelp" @if(!empty($item)) value="{{ $item->title }}" @endif>
            <small id="titleHelp" class="form-text text-muted">Please give your list a title</small>
        </div>
        <div class="form-group">
            <label for="title">Image</label>
            <input type="file" class="form-control" name="img" id="img" onchange="getBaseUrl()" aria-describedby="imageHelp" accept="image/apng, image/gif, image/jpeg, image/png" >
            <input type="hidden" name="image" id="image">
            <small id="imageHelp" class="form-text text-muted">Upload an image for this item</small>
        </div>
        <input type="hidden" id="category_id" name="category_id" value="{{ $cat_id }}">
        <div class="form-group">
            <label for="description">Further Details</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $item->description ?? '' }}</textarea>
        </div>
        <div id="error"></div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="add-item-button">@if(!empty($item)) Update @else Add @endif Item</button>
    </div>
</form>
