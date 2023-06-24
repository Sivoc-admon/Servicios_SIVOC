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
                document.getElementById("formRegisterProject").reset();


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
                        "<option value='PS'>Proyecto de Servicio</option>" +
                        "<option value='GE'>Proyecto General</option>";
                } else {
                    tipo = "<option value='PS' selected>Proyecto de Servicio</option>" +
                        "<option value='GE'>Proyecto General</option>";
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

                        } else {
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
    let folder = $("#hideModalIdFolder").val();

    let data = new FormData();
    data.append("id", id);
    data.append("folder", folder);
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

                showFolders();

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

                showFolders();

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

function consultaProyectoFolder(id) {
    $("#hideModalIdProject").val(id);
}


function consultaFolder(area, id_padre) {
    let proyecto = $("#hideModalIdProjectFolder").val();
    $.ajax({
        type: "GET",
        url: `projects/folder/${area}/${id_padre}`,
        data: { id_proyecto: proyecto },
        //dataType: 'json',
        success: function(data) {
            console.log(data.data);
            let selectHTML = "";
            if (data.data.length == 0) {
                console.log("no hay carpetas");

                selectHTML += `<div class="input-group mb-3">
                <label for="formFile" class="form-label">Nombre de la Carpeta</label>
                <input type="text" class="form-control" id="input_new_folder${id_padre}"/></br></div>`;
                selectHTML += `<button id="btnLevel0" type="button" class="btn btn-primary form-button" onclick="newFolder(${area}, ${id_padre})">Agregar carpeta</button>`;
                /*selectHTML += `<button id="btnLevelModify${level}" type="button" class="btn btn-info form-button" onclick="cambiaNombreFolder(${selectVal}, '${selectTagText}')" style="display:none;">Cambiar nombre a</button>
                <input type="file" class="btn btn-warning" id="files_${areaId}_${level}" onchange="newFile(${areaId}, ${level})" multiple style="display:none;"/>`; */
                $(`#div_folders`).empty();
                $(`#div_folders`).append(selectHTML);
            } else {
                /*
                selectHTML = `<select id="selectNivel${level}" class="form-control" onchange="getFoldersAndFiles(${areaId}, ${level})">
                                    <option value="">Seleccione</option>`;
                for (var k in data.data) {
                    selectHTML += `<option value="${folders[k].id}">${folders[k].name}</option>`;
                }
                selectHTML += `</select><br>
                <button id="btnLevel${level}" type="button" class="btn btn-primary form-button" onclick="newFolder(${areaId}, ${level})"
                style="display:none;">Agregar carpeta</button>
                <button id="btnLevelModify${level}" type="button" class="btn btn-info form-button" onclick="cambiaNombreFolder(${selectVal}, '${selectTagText}')" style="display:none;">Cambiar nombre a</button>
                <input type="file" class="btn btn-warning" id="files_${areaId}_${level}" onchange="newFile(${areaId}, ${level})" multiple style="display:none;"/>`;
                if ($(`#divNivel${level}`).length) {
                    $(`#divNivel${level}`).html(selectHTML);
                } else {
                    let pading = 10 * level;
                    $(`#divFolders`).append(`<div class="row" id="divNivel${level}"><br><div class="col-md">Nivel: ${level}</div><div class="col-md-11">${selectHTML}</div></div>`);
                }
                */
                selectHTML += `<div class="row">
                <label for="formFile" class="form-label">Nombre de la Carpeta</label>
                <input type="text" class="form-control" id="input_new_folder${id_padre}"/></br></div>`;
                selectHTML += `<button id="btnLevel0" type="button" class="btn btn-primary form-button" onclick="newFolder(${area}, ${id_padre})">Agregar carpeta</button>`;
                selectHTML += `<select id="selectNivel${id_padre}" class="form-control" onchange="getFoldersAndFiles(${area}, ${id_padre})">
                <option value="">Seleccione</option>`;
                for (const key in data.data) {
                    selectHTML += `<option value="${data.data[key].id}">${data.data[key].name}</option>`;
                }


                selectHTML += `</select>`;

                $(`#div_folders`).empty();
                $(`#div_folders`).append(`<div class="row" id="divNivel${id_padre}"><br>${selectHTML}</div>`);
            }


            return;

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

function newFolder() {

    let id_padre = $("#hideIDPadreFolder").val();
    let id_project = $("#hideIDProject").val();
    let folderName = $("#inputNewFolder").val();
    folder = folderName.toUpperCase();

    if (folderName.trim() !== '') {

        $.ajax({
            type: "POST",
            url: `projects/folder/create`,
            data: {
                "folder": folderName,
                "id_padre": id_padre,
                "id_proyecto": id_project,
                "_token": $("meta[name='csrf-token']").attr("content")
            },
            success: function(data) {
                $("#ModalShowFoldersProject").modal('hide');
                messageAlert("Carpeta Creada.", "success");
                showFolders();
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

    } else {
        messageAlert("Debe proporcionar el nombre de la carpeta", "info", "");
    }
}

function getFoldersAndFiles(area, id_padre) {
    let folder = $("#selectNivel" + id_padre).val();
    $.ajax({
        type: "GET",
        url: `projects/${folder}/files`,
        data: {
            "id_padre": folder,
            "id_proyecto": $("#hideModalIdProjectFolder").val(),
            "id_area": area,

        },
        success: function(data) {
            console.log("carpetas y archivos");
            console.log(data);
            let selectHTML = ""
            if (data.folders.length > 0) {


                selectHTML += `<select id="selectNivel${folder}" class="form-control" onchange="getFoldersAndFiles(${area}, ${folder})">
                            <option value="">Seleccione</option>`;
                for (const key in data.folders) {
                    selectHTML += `<option value="${data.folders[key].id}">${data.folders[key].name}</option>`;
                }

                selectHTML += `</select>`;
                selectHTML += `<div class="col-md-12">
                <label for="formFile" class="form-label">Nombre de la Carpeta</label>
                <input type="text" class="form-control" id="input_new_folder${folder}"/></br></div>`;
                selectHTML += `<button id="btnLevel0" type="button" class="btn btn-primary form-button" onclick="newFolder(${area}, ${folder})">Agregar carpeta</button>`;



            } else {
                selectHTML += `<div class="col-md-12">
                <label for="formFile" class="form-label">Nombre de la Carpeta</label>
                <input type="text" class="form-control" id="input_new_folder${folder}"/></br></div>`;
                selectHTML += `<button id="btnLevel0" type="button" class="btn btn-primary form-button" onclick="newFolder(${area}, ${folder})">Agregar carpeta</button>`;

            }

            if ($(`#divNivel${folder}`).length) {
                console.log("se hizo un html al crear la carpeta");
                $(`#divNivel${folder}`).html(selectHTML);
            } else {

                $(`#div_folders`).append(`<div class="row" id="divNivel${folder}"><br>${selectHTML}</div>`);
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

function showFolders() {
    let idProject = $("#slt_projectFolder").val();
    console.log(idProject);
    $.ajax({
        type: "GET",
        url: `projects/folder/${idProject}`,
        /*data: {
            "folder": folderName,
            "id_padre": id_padre,
            "id_proyecto": $("#hideModalIdProjectFolder").val(),
            "id_area": area,
            "_token": $("meta[name='csrf-token']").attr("content")
        },*/
        success: function(data) {

            $("#myULFolder").empty();
            $("#myULFolder").append(data.data);

            let toggler = document.getElementsByClassName("caret");
            let i;
            for (i = 0; i < toggler.length; i++) {
                toggler[i].addEventListener("click", function() {
                    this.parentElement.querySelector(".nested").classList.toggle("active");
                    this.classList.toggle("caret-down");
                });
            }
            return;


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

function showModal(modal, idFolder, idProject, tipo) {
    if (tipo == "file") {
        $("#hideModalIdFolder").val(idFolder);
        $("#hideModalIdProject").val(idProject);
    } else {
        $("#hideIDPadreFolder").val(idFolder);
        $("#hideIDProject").val(idProject);
        $("#inputNewFolder").val("");
    }


    $("#" + modal).modal("show");
}

function tipoProyecto(tipo) {
    let date = new Date();
    let year = date.getFullYear().toString().substr(2, 2);
    let tipoProyecto = $("#sltTypeProject").val();
    $.ajax({
        type: "GET",
        url: `projects/total`,
        data: {
            "tipo_proyecto": tipoProyecto,
            "year": year

        },
        success: function(data) {
            console.log(data);
            let consecutivo = data.totalProyectos.toString().padStart(3, 0);

            if (tipo == "nuevo") {
                $("#inputNameProject").val(tipoProyecto + "-" + year + "-" + consecutivo);
                $("#divAdicional").hide();
            } else {
                $("#inputNameProject").val("");
                $("#divAdicional").show();

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

function creaAdiccional() {
    let id_project = $("#sltProjectAditional").val();

    $.ajax({
        type: "GET",
        url: `projects/folder/adicional/${id_project}`,
        /*data: {
            "folder": folderName,
            "id_padre": id_padre,
            "id_proyecto": $("#hideModalIdProjectFolder").val(),
            "id_area": area,
            "_token": $("meta[name='csrf-token']").attr("content")
        },*/
        success: function(data) {
            console.log(data);

            $("#inputNameProject").val(data.project);
            $("#adicionalProject").val(data.totalAdicional);



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

//filtro por año
function filtroAno() {
    let ano = $("#sltAnoProyecto").val();

    if (!ano || ano <= 0) {
        return;
    }
    $.ajax({
        type: "GET",
        url: `projects/filtro/${ano}`,
        /*data: {
            "folder": folderName,
            "id_padre": id_padre,
            "id_proyecto": $("#hideModalIdProjectFolder").val(),
            "id_area": area,
            "_token": $("meta[name='csrf-token']").attr("content")
        },*/
        success: function(data) {

            $("#tableProjects").DataTable({
                dom: 'Bfrtip',
                bDestroy: true,
                data: data.projects,
                buttons: [
                    'csv', 'excel', 'pdf'
                ],
                responsive: {
                    details: {
                        type: 'column',
                        target: -1
                    }
                },
                columnDefs: [{
                    className: 'control',
                    orderable: false,
                    targets: -1
                }]
            });


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