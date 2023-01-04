<div class="modal-header">
    <h5 class="modal-title" id="titleModalLabel"> {{ $item->title }} </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <table class="table">
        <tr>
            <td>Image</td>
            <td>
                <img src="{{ ($item->image)? asset('img/'. $item->image): asset('img/no_image.jpg') }}"
                     class="shadow-1-strong img-responsive" alt="avatar 1"
                     style="width: 200px; height: auto;">
            </td>
        </tr>
        <tr>
            <td>Task title</td>
            <td><strong>{{ $item->title }}</strong></td>
        </tr>
        <tr>
            <td>Completion Status</td>
            <td>
                <h6 class="mb-0">
                    <span class="badge @if($item->is_complete) bg-success @else bg-warning @endif">{{ ($item->is_complete)? 'Completed': 'Pending' }}</span>
                </h6>
            </td>
        </tr>
        <tr>
            <td>Task details</td>
            <td><strong>{{ $item->description }}</strong></td>
        </tr>
        <tr>
            <td>Date Created</td>
            <td><strong>{{ date('d/M/Y h:i:s', strtotime($item->created_at)) }}</strong></td>
        </tr>
        <tr>
            <td>Date Created</td>
            <td><strong>{{ date('d/M/Y h:i:s', strtotime($item->updated_at ))}}</strong></td>
        </tr>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
