function saveProject() {
    $.ajax({
        type: "POST",
        url: "projects",
        data: $("#formRegisterProject").serialize(),
        //dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalRegisterUser").modal('hide');

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

function datosTablero(id, name) {
    $("#inputProyectBoard").val(name);
    $("#inputIdProyect").val(id);
}

function saveBoard() {
    $.ajax({
        type: "POST",
        url: "projects/board/createBoard",
        data: $("#formRegisterBoard").serialize(),
        //dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalRegisterUser").modal('hide');

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

function showBoards(tablero) {
    $("#bodyProjectBoards").empty();
    $.ajax({
        type: "GET",
        url: `projects/board/showBoards/${tablero}`,
        data: { "id": tablero },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                let table = "";
                for (const i in data) {
                    for (const j in data[i]) {
                        table += `<tr>
                            <td>${ data[i][j].id }</td>
                            <td>${ data[i][j].name }</td>
                            <td>
                            <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"  onClick="eliminarTablero(${data[i][j].id})">
                                <i class="fas fa-minus-square"></i>
                            </button>
                        </td>
                        </tr>`;
                    }

                }

                $("#bodyProjectBoards").append(table);


                //messageAlert("Guardado Correctamente", "success", "");
                //location.reload();

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

function editProject(id) {
    $("#sltEditTypeProject").empty();
    $("#sltEditCliente").empty();
    $("#inputEditEstatus").empty();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "GET",
        url: "/projects/" + id + "/edit",
        //data: $("#formRegisterUser").serialize(),
        dataType: 'json',
        success: function(data) {
            console.log(data);

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {
                let tipo = "";
                let customerOption = "";
                let statusOption = "";
                if (data.project.type == "PE") {
                    tipo = "<option value='PE' selected>PUESTA EN MARCHA</option>" +
                        "<option value='PO'>OPERACIONAL</option>";
                } else {
                    tipo = "<option value='PE'>PUESTA EN MARCHA</option>" +
                        "<option value='PO' selected>OPERACIONAL</option>";
                }

                for (const i in data.users) {
                    if (data.project.client == data.users[i].id) {
                        customerOption = customerOption + `<option value='${data.users[i].id}' selected>${data.users[i].name}</option>`
                    } else {
                        customerOption = customerOption + `<option value='${data.users[i].id}'>${data.users[i].name}</option>`
                    };
                }

                switch (data.project.status) {
                    case 'Colocado':
                        statusOption = "<option value='Colocado' selected>Colocado</option>" +
                            "<option value='Proceso'>Proceso</option>" +
                            "<option value='Terminado'>Terminado</option>" +
                            "<option value='Cancelado'>Cancelado</option>";
                        break;
                    case 'Proceso':
                        statusOption = "<option value='Colocado'>Colocado</option>" +
                            "<option value='Proceso' selected>Proceso</option>" +
                            "<option value='Terminado'>Terminado</option>" +
                            "<option value='Cancelado'>Cancelado</option>";
                        break;
                    case 'Terminado':
                        statusOption = "<option value='Colocado'>Colocado</option>" +
                            "<option value='Proceso'>Proceso</option>" +
                            "<option value='Terminado' selected>Terminado</option>" +
                            "<option value='Cancelado'>Cancelado</option>";
                        break;
                    case 'Cancelado':
                        statusOption = "<option value='Colocado'>Colocado</option>" +
                            "<option value='Proceso'>Proceso</option>" +
                            "<option value='Terminado'>Terminado</option>" +
                            "<option value='Cancelado' selected>Cancelado</option>";
                        break;

                    default:
                        break;
                }



                $("#hideIdProject").val(data.project.id);
                $("#inputNameProjectEdit").val(data.project.name_project);
                $("#sltEditTypeProject").append(tipo);
                $("#sltEditCliente").append(customerOption);
                $("#inputEditProyecto").val(data.project.name);
                $("#inputEditEstatus").append(statusOption);


            }
            $("#modalEditProyect").modal("show");

            //location.reload();

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

function updateProject() {

    let id = $("#hideIdProject").val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "PUT",
        url: "/projects/" + id,
        data: $("#formEditProject").serialize(),
        //dataType: 'json',
        success: function(data) {
            console.log(data);

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#modalEditProyect").modal("hide");
            }

            messageAlert("Guardado Correctamente", "success", "");

            location.reload();

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

function showProjectFile(id) {
    $("#showProjectFiles").empty();
    $.ajax({
        type: "GET",
        url: `projects/${id}/showFile`,
        //data: { "id": minute },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                let table = "";
                $("#hideModalIdProject").val(id);
                for (const i in data.projectfiles) {
                    table += `<tr>"
                        <td> ${data.projectfiles[i].id}</td> 
                        <td>
                            <a href="storage/Documents/Proyectos/${id}/${data.projectfiles[i].name}" target="_blank">${data.projectfiles[i].name}</a>
                        </td>`;
                        for (const key in data.rolesUser) {
                            if (data.rolesUser[key].id == 1 || data.rolesUser[key].id == 12) {
                                table += `<td>
                                    <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"  onClick="eliminarArchivo(${data.projectfiles[i].id})">
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

                $("#showProjectFiles").append(table);


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

    let id = $("#hideModalIdProject").val();
    let file = $('#fileUploadProjectFile')[0];

    let data = new FormData();
    data.append("id", id);
    data.append("tamanoFiles", file.files.length);
    for (let i = 0; i < file.files.length; i++) {
        data.append('file' + i, file.files[i]);
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: `projects/${id}/uploadFile`,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalShowFilesProject").modal('hide');

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
        url: `projects/${id}/destroyFile`,
        /*data: data,
        cache: false,
        contentType: false,
        processData: false,*/
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalShowFilesProject").modal('hide');

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

function eliminarTablero(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "DELETE",
        url: `projects/${id}/destroyBoard`,
        /*data: data,
        cache: false,
        contentType: false,
        processData: false,*/
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalShowBoard").modal('hide');

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