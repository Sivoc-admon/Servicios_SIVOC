function saveImg(){
    let name = $("#inputImage").val();
    let file = $('#fileImage')[0];
    proceso();
    let data = new FormData();
    data.append("name", name);
    data.append("tamanoFiles", file.files.length);
    for (let i = 0; i < file.files.length; i++) {
        data.append('file' + i, file.files[i]);
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "../inicio/uploadImage",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'JSON',
        success: function(data) {
            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalRegisterImage").modal('hide');

                messageAlert("Guardado Correctamente", "success", "");

                location.reload();

            }

        },
        error: function(data) {
            if (data.responseJSON.message == "The given data was invalid.") {
                messageAlert("Datos incompletos.", "warning");
            } else {
                messageAlert("Ha ocurrido un problema.", "error", "");
            }
            messageAlert("Datos incompletos", "error", `${data.responseJSON.errors.apellido_paterno}` + "\n" + `${data.responseJSON.errors.name}`);
        }
    });
}

function eliminarImage(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "DELETE",
        url: `../inicio/${id}/destroyImage`,
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                messageAlert("Archivo Eliminado", "success", "");

                location.reload();

            }

        },
        error: function(data) {
            console.log(data.responseJSON);
            if (data.responseJSON.message == "The given data was invalid.") {
                messageAlert("Datos incompletos.", "warning");
            } else {
                messageAlert("Ha ocurrido un problema.", "error", "");
            }
        }
    });
}

function currentImg(img) {
    $('#preview').attr('src', location.origin+'/'+img.path+'/'+img.id+'-'+img.name);
}


