function saveSgc() {

    let area = $("#sltArea").val();
    let procedimiento = $("#sltSGC").val();
    let codigo = $("#inputCodigo").val();
    let description = $("#inputDescription").val();
    let fechaCreacion = $("#inputCreate").val();
    let fechaActualizacion = $("#inputUpdate").val();
    let responsable = $("#inputResponsable").val();
    let file = $('#fileSgc')[0];

    let data = new FormData();
    data.append("area", area);
    data.append("procedimiento", procedimiento);
    data.append("codigo", codigo);
    data.append("description", description);
    data.append("fechaCreacion", fechaCreacion);
    data.append("fechaActualizacion", fechaActualizacion);
    data.append("responsable", responsable);

    data.append("tamanoFiles", file.files.length);
    for (let i = 0; i < file.files.length; i++) {
        data.append('file' + i, file.files[i]);
    }


    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "sgc",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalRegisterInternalAudit").modal('hide');

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

function showSgcFile(id) {
    $("#bodySgcFiles").empty();
    $.ajax({
        type: "GET",
        url: `sgc/${id}/files`,
        //data: { "id": minute },
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                let table = "";
                for (const i in data.files) {
                    table += `<tr>"
                        <td> ${data.files[i].id}</td> 
                        <td>
                            <a href="storage/Documents/SGC/${id}/${data.files[i].name}" target="_blank">${data.files[i].name}</a>
                        </td>`;
                    if ((data.files.length - 1) == i) {
                        table += `<td>
                            <input type="number" id="inputRevision_${i}" value="${data.files[i].revision}"></input>
                        </td>
                        `;
                    } else {
                        table += `<td></td>`;
                    }

                    if (data.eliminaArchivo == true) {
                        table += `<td>
                            <div class="btn-group">`;

                        if ((data.files.length - 1) == i) {
                            table += `<button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar" onclick="editFile(${data.files[i].id}, ${i});">
                                <i class="fas fa-edit"></i>
                            </button>`;
                        } else {

                        }
                        table += `<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"  onClick="eliminarArchivo(${data.files[i].id})">
                                    <i class="fas fa-minus-square"></i>
                                </button>
                            </div>`;

                    } else {
                        table += `<td>`;

                    }
                    table += ` </td></tr>`;


                }
                $("#hideSgcId").val(id);

                $("#bodySgcFiles").append(table);


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

function masDocumentosSgc() {

    let sgc = $("#hideSgcId").val();
    let file = $('#fileUploadSgcFile')[0];

    let data = new FormData();
    data.append("sgc", sgc);
    data.append("tamanoFiles", file.files.length);
    for (let i = 0; i < file.files.length; i++) {
        data.append('file' + i, file.files[i]);
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: `sgc/${sgc}/uploadFile`,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalShowSgcFiles").modal('hide');

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

function editSgc(id) {
    $("#sltEditAreaSgc").empty();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "GET",
        url: `sgc/${id}/edit`,
        //data: $("#formRegisterUser").serialize(),
        dataType: 'json',
        success: function(data) {
            console.log(data);

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#inputEditResponsable").val(data.user.name + " " + data.user.last_name + " " + data.user.mother_last_name);
                $("#inputEditCodigoSgc").val(data.sgc.code);
                $("#inputEditDescriptionSgc").val(data.sgc.description);
                $("#hIdSgc").val(id);
                $("#inputEditResponsable option[value='" + data.user.id + "']").attr("selected", true);


                let optionAreas = "<option value='0'>Seleccione</option>";

                for (const i in data.areas) {
                    if (data.sgc.area_id == data.areas[i].id) {
                        optionAreas += `<option value='${data.areas[i].id}' selected>${data.areas[i].name}</option>`
                    } else {
                        optionAreas += `<option value='${data.areas[i].id}'>${data.areas[i].name}</option>`;
                    }

                }



                $("#sltEditAreaSgc").append(optionAreas);

                $("#ModalEditSGC").modal('show');

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

function updateSgc() {
    let id = $("#hIdSgc").val();
    $.ajax({
        type: "PUT",
        url: `sgc/${id}`,
        data: $("#formEditSgc").serialize(),
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

function eliminarArchivo(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "DELETE",
        url: `sgc/${id}/destroyFile`,
        /*data: data,
        cache: false,
        contentType: false,
        processData: false,*/
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalShowSgcFiles").modal('hide');

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

function editFile(id, consecutivo) {
    let revision = $("#inputRevision_" + consecutivo).val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "PUT",
        url: `sgc/${id}/updateFile`,
        data: { "revision": revision },
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                messageAlert("Actualizacion Exitosa.", "success");
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