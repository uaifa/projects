function changeImage() {
    $('#image').trigger('click');
}

function uploadImage() {
    var form = $('#adminSideImage')[0];
    data = new FormData(form);
    $.ajax({
        type: "post",
        url: base_url + 'upload-image',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            if (response.status == 200) {
                NioApp.Toast(response.message, 'success', {
                    position: 'top-right'
                });
                setInterval(() => {
                    location.reload();
                }, 1300);
            } else {
                NioApp.Toast(response.message, 'error', {
                    position: 'top-right'
                });
            }
        }
    });
}

function ajax(type = 'get', url, data, dataType = 'json', position = 'top-right') {

}