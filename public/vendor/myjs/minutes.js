function saveMinute() {

    let minute = $("#inputDescriptionMinute").val();
    let internalParticipant = $("#sltParticipantesInternos").val();
    let type = $("#sltMinuteType").val();
    let status = $("#inputStatusMinute").val();
    let externalParticipant = $("#inputExternalParticipant").val();
    let file = $('#fileMinute')[0];

    let data = new FormData();
    data.append("minuteDescription", minute);
    data.append("internalParticipant", internalParticipant);
    data.append("type", type);
    data.append("status", status);
    data.append("externalParticipant", externalParticipant);
    data.append("tamanoFiles", file.files.length);
    for (let i = 0; i < file.files.length; i++) {
        data.append('file' + i, file.files[i]);
    }

    proceso();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "minutes",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalRegisterMinute").modal('hide');

                messageAlert("Guardado Correctamente", "success", "");

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
            //messageAlert("Datos incompletos", "error", `${data.responseJSON.errors.apellido_paterno}` + "\n" + `${data.responseJSON.errors.name}`);
        }
    });
}

function datosMinute(minute) {
    $("#inputIdMinute").val(minute);
}

function saveAgreement(minute) {
    $.ajax({
        type: "POST",
        url: `minutes/agreement`,
        data: $("#formRegisterAgreement").serialize(),
        //dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalRegisterAgreement").modal('hide');

                messageAlert("Guardado Correctamente", "success", "");

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
            //messageAlert("Datos incompletos", "error", `${data.responseJSON.errors.apellido_paterno}` + "\n" + `${data.responseJSON.errors.name}`);
        }
    });
}

function showAgreement(minute) {
    $("#showAgreement").empty();
    $.ajax({
        type: "GET",
        url: `minutes/showAgreements/${minute}`,
        //data: { "id": minute },
        //data: $("#formRegisterAgreement").serialize(),
        dataType: 'json',
        success: function(data) {


            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                let table = "";
                for (const i in data) {
                    for (const j in data[i]) {

                        table += "<tr>" +
                            "<td>" + data[i][j].id + "</td>" +
                            "<td>" + data[i][j].description + "</td>" +
                            "</tr>";

                    }
                }

                $("#showAgreement").append(table);


            }

        },
        error: function(data) {
            console.log(data.responseJSON);
            if (data.responseJSON.message == "The given data was invalid.") {
                messageAlert("Datos incompletos.", "warning");
            } else {
                messageAlert("Ha ocurrido un problema.", "error", "");
            }
            //messageAlert("Datos incompletos", "error", `${data.responseJSON.errors.apellido_paterno}` + "\n" + `${data.responseJSON.errors.name}`);
        }
    });
}

function showMinuteFile(minute) {
    $("#showMinuteFiles").empty();
    $.ajax({
        type: "GET",
        url: `minutes/showMinuteFiles/${minute}`,
        //data: { "id": minute },
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {
                
                
                let table = "";
                $("#hideModalId").val(minute);
                for (const i in data.minutefiles) {
                    table += `<tr>"
                        <td> ${data.minutefiles[i].id}</td> 
                        <td>
                            <a href="storage/Documents/Minutas/${minute}/${data.minutefiles[i].file}" target="_blank">${data.minutefiles[i].file}</a>
                        </td>`;
                    for (const key in data.rolesUser) {
                        if (data.rolesUser[key].id == 1 || data.rolesUser[key].id == 12) {

                            table += `<td>
                                <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"  onClick="eliminarArchivo(${data.minutefiles[i].id})">
                                    <i class="fas fa-minus-square"></i>
                                </button>
                            </td>`;
                        }else{
                            table += `<td>
                                
                            </td>`;
                        }
                        
                    }
                        
                    table += `</tr>`;
                    

                }

                $("#showMinuteFiles").append(table);

            }

        },
        error: function(data) {
            console.log(data.responseJSON);
            if (data.responseJSON.message == "The given data was invalid.") {
                messageAlert("Datos incompletos.", "warning");
            } else {
                messageAlert("Ha ocurrido un problema.", "error", "");
            }
            //messageAlert("Datos incompletos", "error", `${data.responseJSON.errors.apellido_paterno}` + "\n" + `${data.responseJSON.errors.name}`);
        }
    });
}

function masDocumentos() {

    let minute = $("#hideModalId").val();
    let file = $('#fileUploadMinuteFile')[0];

    let data = new FormData();
    data.append("minute", minute);
    data.append("tamanoFiles", file.files.length);
    for (let i = 0; i < file.files.length; i++) {
        data.append('file' + i, file.files[i]);
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: `minutes/${minute}/uploadFile`,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalShowFiles").modal('hide');

                messageAlert("Guardado Correctamente", "success", "");

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
            //messageAlert("Datos incompletos", "error", `${data.responseJSON.errors.apellido_paterno}` + "\n" + `${data.responseJSON.errors.name}`);
        }
    });
}

function editMinute(id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "GET",
        url: `minutes/${id}/edit`,
        //data: $("#formRegisterUser").serialize(),
        dataType: 'json',
        success: function(data) {
            console.log(data);

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#inputEditDescriptionMinute").val(data.minute.description);
                $("#sltEditParticipantesInternos").val(data.minute.participant);
                $("#inputEditExternalParticipant").val(data.minute.external_participant);
                $("#hIdMinute").val(id);
                $("#sltEditMinuteType option[value='"+ data.minute.type +"']").attr("selected",true);


            }

        },
        error: function(data) {
            console.log(data.responseJSON);
            if (data.responseJSON.message == "The given data was invalid.") {
                messageAlert("Datos incompletos.", "warning");
            } else {
                messageAlert("Ha ocurrido un problema.", "error", "");
            }
            //messageAlert("Datos incompletos", "error", `${data.responseJSON.errors.apellido_paterno}` + "\n" + `${data.responseJSON.errors.name}`);
        }
    });
}

function updateMinute() {

    let id = $("#hIdMinute").val();
    $.ajax({
        type: "PUT",
        url: `minutes/${id}`,
        data: $("#formEditMinute").serialize(),
        //dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalEditMinute").modal('hide');

                messageAlert("Guardado Correctamente", "success", "");

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
            //messageAlert("Datos incompletos", "error", `${data.responseJSON.errors.apellido_paterno}` + "\n" + `${data.responseJSON.errors.name}`);
        }
    });
}

function eliminarArchivo(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "DELETE",
        url: `minutes/${id}/destroyFile`,
        /*data: data,
        cache: false,
        contentType: false,
        processData: false,*/
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalShowFiles").modal('hide');

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
            //messageAlert("Datos incompletos", "error", `${data.responseJSON.errors.apellido_paterno}` + "\n" + `${data.responseJSON.errors.name}`);
        }
    });
}
