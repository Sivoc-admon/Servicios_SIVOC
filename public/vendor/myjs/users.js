function saveUser() {

    /*$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });*/

    //e.preventDefault();

    $.ajax({
        type: "POST",
        url: "users",
        data: $("#formRegisterUser").serialize(),
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

function editUser(id) {
    $("#sltAreaEditUser").empty();
    $("#inputRoleEditUser").empty();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "GET",
        url: "/users/edit/" + id,
        //data: $("#formRegisterUser").serialize(),
        dataType: 'json',
        success: function(data) {
            console.log(data.roleUser[0].id);

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#inputNameEditUser").val(data.user.name);
                $("#inputLastNameEditUser").val(data.user.last_name);
                $("#inputMotherLastNameEditUser").val(data.user.mother_last_name);
                $("#inputEmailEditUser").val(data.user.email);
                $("#idUser").val(data.user.id);

                let optionAreas = "<option value='0'>Seleccione</option>";
                let optionRoles = "<option value='0'>Seleccione</option>";
                for (const i in data.areas) {
                    if (data.user.area_id == data.areas[i].id) {
                        optionAreas += `<option value='${data.areas[i].id}' selected>${data.areas[i].name}</option>`
                    } else {
                        optionAreas += `<option value='${data.areas[i].id}'>${data.areas[i].name}</option>`;
                    }

                }

                for (const i in data.roles) {
                    if (data.roleUser.role_id == data.roles[i].id) {
                        optionRoles += `<option value='${data.roles[i].id}' selected>${data.roles[i].name}</option>`
                    } else {
                        optionRoles += `<option value='${data.roles[i].id}'>${data.roles[i].name}</option>`;
                    }

                }

                $("#sltAreaEditUser").append(optionAreas);
                $("#inputRoleEditUser").append(optionRoles);

                $("#ModalEditUser").modal('show');

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

function updateUser() {

    /*$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });*/

    //e.preventDefault();
    let id = $("#idUser").val();
    $.ajax({
        type: "PUT",
        url: "users/" + id,
        data: $("#formEditUser").serialize(),
        //dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalEditUser").modal('hide');

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

function updateRH() {

    /*$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });*/

    //e.preventDefault();

    let id = $("#hIdRh").val();

    $.ajax({
        type: "PUT",
        url: "rh/" + id,
        data: $("#formEditUserRh").serialize(),
        //dataType: 'json',
        success: function(data) {


            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalEditUserRh").modal('hide');

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

function editRh(id) {

    $("#sltAreaRh").empty();
    $("#inputRoleRh").empty();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "GET",
        url: "rh/" + id + "/edit",
        //data: $("#formRegisterUser").serialize(),
        dataType: 'json',
        success: function(data) {
            console.log(data.user);

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#inputNameRh").val(data.user.name);
                $("#inputLastNameRh").val(data.user.last_name);
                $("#inputMotherLastNameRh").val(data.user.mother_last_name);
                $("#inputEmailRh").val(data.user.email);
                $("#inputProfesion").val(data.user.profession);
                $("#inputEdad").val(data.user.age);
                $("#inputEstadoCivil").val(data.user.marital_status);
                $("#inputNSS").val(data.user.nss);
                $("#inputRFC").val(data.user.rfc);
                $("#inputCURP").val(data.user.curp);
                $("#inputDireccion").val(data.user.street);
                $("#inputTelefono").val(data.user.telefono);
                $("#inputCURP").val(data.user.curp);
                $("#inputContacto").val(data.user.contacto);

                $("#inputEstudios option[value='" + data.user.grade + "']").attr("selected", true);
                $("#sltGenero option[value='" + data.user.gender + "']").attr("selected", true);

                $("#hIdRh").val(data.user.id);

                let optionAreas = "<option value='0'>Seleccione</option>";
                let optionRoles = "<option value='0'>Seleccione</option>";
                for (const i in data.areas) {
                    if (data.user.area_id == data.areas[i].id) {
                        optionAreas += `<option value='${data.areas[i].id}' selected>${data.areas[i].name}</option>`
                    } else {
                        optionAreas += `<option value='${data.areas[i].id}'>${data.areas[i].name}</option>`;
                    }

                }


                for (const j in data.roles) {
                    if (data.roleUser[0].id == data.roles[j].id) {
                        optionRoles += `<option value='${data.roles[j].id}' selected>${data.roles[j].name}</option>`
                    } else {
                        optionRoles += `<option value='${data.roles[j].id}'>${data.roles[j].name}</option>`;
                    }

                }

                $("#sltAreaRh").append(optionAreas);
                $("#inputRoleRh").append(optionRoles);

                $("#ModalEditUserRh").modal('show');

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

function showRHFile(id) {
    $("#bodyRHFiles").empty();
    $.ajax({
        type: "GET",
        url: `rh/${id}/files`,
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
                            <a href="storage/Documents/RH/${id}/${data.files[i].name}" target="_blank">${data.files[i].name}</a>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar"  onClick="eliminarArchivo(${data.files[i].id})"><i class="fas fa-minus-square"></i></button>
                            </div>
                        </td>"
                    </tr>`;

                }
                $("#hideRHId").val(id);

                $("#bodyRHFiles").append(table);


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

function masDocumentosRH() {

    let empleado = $("#hideRHId").val();
    let file = $('#fileUploadRHFile')[0];

    let data = new FormData();
    data.append("empleado", empleado);
    data.append("tamanoFiles", file.files.length);
    for (let i = 0; i < file.files.length; i++) {
        data.append('file' + i, file.files[i]);
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: `rh/${empleado}/uploadFile`,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalShowRHFiles").modal('hide');

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
        url: `rh/${id}/destroyFile`,
        /*data: data,
        cache: false,
        contentType: false,
        processData: false,*/
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalShowRHFiles").modal('hide');

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