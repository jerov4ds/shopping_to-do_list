$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function processError(errors) {
    var errorString = '<ul class="alert alert-danger">';
    $.each( errors, function( key, value) {
        errorString += '<li>' + value + '</li>';
    });
    errorString += '</ul>';
    return errorString;
}

function showAlert(title, message, type) {
    swal({
        title: title,
        text: message,
        icon: type,
        button: {
            text: "Alright",
            value: true,
            visible: true,
            className: "btn btn-"+type
        }
    })
}

function fill_form(d) {
    for(var k in d){
        $('[name="'+k+'"]').val(d[k]);
    }
}

$(document).on("keyup", ".only_numeric", function() {
    this.value = this.value.replace(/[^0-9\.]/g, "");
});
