$(function() {
    /*$("#inputName").keypress(function(event) {
        var inputValue = event.charCode;
        if (!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0) && !(inputValue >= 48 && inputValue <= 57)) {
            event.preventDefault();
        }
    });*/

    getFilesLevelZero(0);
});

function getFilesLevelZero(folderId) {
    let areaId = $("#hiddenAriaId").val();
    proceso();
    $.ajax({
        type: "GET",
        url: `/folder2/${areaId}/${folderId}`,
        dataType: 'json',
        success: function(data) {
            let tablaHTML = ``;

            for (var k in data.folders) {
                let date = new Date(data.folders[k].created_at);

                s = data.folders[k].ruta.split("/");
                let cadena = ""

                for (let i = 0; i < s.length - 1; i++) {
                    if (i == 1 || i == 2) {

                    } else {
                        cadena = cadena + s[i] + "/";
                    }


                }


                tablaHTML += `<tr>
                <td><a href="../${cadena}${data.folders[k].name}" target="_blank">${data.folders[k].name}</a></td>
                <td>${date.toLocaleDateString()}</td>
                <td>`;
                if (areaId == data.area_user || data.area_user == 5) {
                    tablaHTML += `<button type="button" class="btn btn-sm btn-danger" onclick="deleteFile('${data.folders[k].name}', ${data.folders[k].id}, ${data.folders[k].folder_area_id})">
                    <i class="fas fa-times"></i>
                    </button>`;
                }
                tablaHTML += `<a class="btn btn-sm btn-warning" href="/file/download/${data.folders[k].id}/${data.folders[k].folder_area_id}">
                        <i class="fas fa-download"></i>
                    </a>
                </td>
                </tr>`;
            }
            $("#tableFiles").empty().html(tablaHTML);
        }
    });
}

function getFoldersAndFiles(areaId, nivel) {
    let level = nivel + 1;
    let selectTag = `#selectNivel${nivel}`;
    let selectVal = $(selectTag).val();
    let selectTagText = $(`${selectTag} option:selected`).text();
    let botonNameTag = `#btnLevel${nivel}`;
    let botonNameModifyTag = `#btnLevelModify${nivel}`;
    let botonFilesTag = `#files_${areaId}_${nivel}`
    let levels = recorreNiveles();
    borrarDivNiveles(nivel, levels);
    $(botonNameTag).html(`Agregar carpeta dentro de "${selectTagText}"`);
    $(botonNameModifyTag).html(`Cambiar nombre a la carpeta "${selectTagText}"`);
    $(botonNameModifyTag).attr("onclick", `cambiaNombreFolder(${selectVal}, '${selectTagText}')`);
    proceso();
    if (selectVal !== '') {
        $.ajax({
            type: "GET",
            url: `/folder/${areaId}/${level}/${selectVal}`,
            dataType: 'json',
            success: function(data) {
                getFilesLevelZero(selectVal);

                switch (areaId) {
                    case 6: //AREA FINANZAS
                        if (data.idRoleUser == 1 || data.idRoleUser == 7) { //ADMIN, FINANZAS
                            $(botonNameTag).fadeIn();
                            $(botonNameModifyTag).fadeIn();
                            $(botonFilesTag).fadeIn();
                        }
                        break;
                    case 10: //AREA VENTAS
                        if (data.idRoleUser == 1 || data.idRoleUser == 7 || data.idRoleUser == 11) { //ADMIN, FINANZAS, VENTAS
                            $(botonNameTag).fadeIn();
                            $(botonNameModifyTag).fadeIn();
                            $(botonFilesTag).fadeIn();
                        }
                        break;
                    case 7: //AREA INGENIERIA
                        if (data.idRoleUser == 1 || data.idRoleUser == 8) { //ADMIN, FINANZAS
                            $(botonNameTag).fadeIn();
                            $(botonNameModifyTag).fadeIn();
                            $(botonFilesTag).fadeIn();
                        }
                        break;
                    case 4: //AREA COMPRAS
                        if (data.idRoleUser == 1 || data.idRoleUser == 5 || data.idRoleUser == 7) { //ADMIN, FINANZAS, COMPRAS
                            $(botonNameTag).fadeIn();
                            $(botonNameModifyTag).fadeIn();
                            $(botonFilesTag).fadeIn();
                        }
                        break;

                    default:
                        $(botonNameTag).fadeIn();
                        $(botonNameModifyTag).fadeIn();
                        $(botonFilesTag).fadeIn();
                        break;
                }



                if (data.data.length > 0) {
                    let folders = data.data;
                    let selectHTML = `<select id="selectNivel${level}" class="form-control" onchange="getFoldersAndFiles(${areaId}, ${level})">
                                        <option value="">Seleccione</option>`;
                    for (var k in folders) {
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
                } else {
                    if ($(`#divNivel${level}`).length) {
                        $(`#divNivel${level}`).remove();
                    }
                }
            },
            error: function(data) {
                console.log("ERROR en la petición");
                console.log(data);
            }
        });
    } else {
        $(botonNameTag).hide();
        $(botonNameModifyTag).hide();
        $(botonFilesTag).hide();
    }
}

function recorreNiveles() {
    var res = 2;
    for (let level = 2; level < 70; level++) {
        if (!$(`#divNivel${level}`).length) {
            res = level;
            break;
        }
    }
    return res;
}

function borrarDivNiveles(nivelx, nivelxx) {
    levelx = nivelx + 1;
    for (let level = levelx; level <= nivelxx; level++) {
        if ($(`#divNivel${level}`).length) {
            console.log(`se borró el nivel: ${level}`);
            $(`#divNivel${level}`).remove();
        }
    }
}


function newFolder(areaId, nivel) {
    nivel++;
    $("#inputName").val('');
    $("#formFolder").fadeIn();
    $("#divMsge").html('').hide();
    $("#nivelFolder").val(nivel);
    $("#areaIdFolder").val(areaId);
    $('#guardaModal').attr("disabled", false);
    $("#ModalCreateFolder").modal('show');
}

function createFolder() {
    $("#errorFolder").html('');
    let folderName = $("#inputName").val();
    let nivel = $("#nivelFolder").val();
    let level = parseInt(nivel) - 1;
    let areaId = $("#areaIdFolder").val();
    let selectTag = `#selectNivel${nivel}`;
    let selectVal = $(selectTag).val();
    let selectTagText = $(`${selectTag} option:selected`).text();
    if (folderName.trim() !== '') {
        $("#exampleModalLabel").html('Crear nueva carpeta');
        $("#divMsge").html(`<i class="fas fa-circle-notch fa-spin"></i>
        <br><label class="control-label">Creando carpeta</label>`);
        $("#formFolder").fadeOut();
        $('#guardaModal').attr("disabled", true);
        $("#divMsge").fadeIn();
        proceso();
        $.ajax({
                    type: "POST",
                    url: `/folder/create/${areaId}/${nivel}`,
                    data: { "folderName": folderName, "_token": $("input[name=_token]").val(), "idFolder": $(`#selectNivel${level}`).val() },
                    dataType: 'json',
                    success: function(data) {
                            let msje = data.data.msje;
                            $("#ModalCreateFolder").modal('hide');
                            messageAlert("Guardado Correctamente", "success", msje);
                            $.ajax({
                                        type: "GET",
                                        url: `/folder/${areaId}/${nivel}/${$(`#selectNivel${level}`).val()}`,
                        dataType: 'json',
                    success: function(data) {
                        if (data.data.length > 0) {
                            let folders = data.data;
                            let selectHTML = `<select id="selectNivel${nivel}" class="form-control" onchange="getFoldersAndFiles(${areaId}, ${nivel})">
                                        <option value="">Seleccione</option>`;
                        for (var k in folders) {
                            selectHTML += `<option value="${folders[k].id}">${folders[k].name}</option>`;
                        }
                        selectHTML += `</select><br>
                        <button id="btnLevel${nivel}" type="button" class="btn btn-primary form-button" onclick="newFolder(${areaId}, ${nivel})"
                        style="display:none;">Agregar carpeta</button>
                        <button id="btnLevelModify${nivel}" type="button" class="btn btn-info form-button" onclick="cambiaNombreFolder(${selectVal}, '${selectTagText}')"
                        style="display:none;">Cambiar nombre a</button>
                        <input type="file" class="btn btn-warning" id="files_${areaId}_${nivel}" onchange="newFile(${areaId}, ${nivel})" multiple style="display:none;"/>`;
                            if ($(`#divNivel${nivel}`).length) {
                                console.log("se hizo un html al crear la carpeta");
                                $(`#divNivel${nivel}`).html(selectHTML);
                            } else {
                                let pading = 10 * level;
                                $(`#divFolders`).append(`<div id="divNivel${nivel}" style="padding-left: ${pading}px;"><br>${selectHTML}</div>`);
                            }
                            $(selectTag).val(selectVal);
                        } else {
                            console.log("no hay mas carpetas");
                        }
                    },
                    error: function(data) {
                        console.log("ERROR en la petición");
                        console.log(data);
                    }
                });
            },
            error: function(data) {
                console.log("ERROR en la petición");
                console.log(data);
                messageAlert("Ha ocurrido un problema.", "error", "");
            }
        });
    } else {
        $("#errorFolder").html('Debe proporcionar el nombre de la carpeta');
    }
}

function newFile(areaId, nivel){
    let token = $("input[name=_token]").val();
    let tagInputFiles = `#files_${areaId}_${nivel}`;
    var formData = new FormData();
    let TotalFiles = $(tagInputFiles)[0].files.length; //Total files
    let files = $(tagInputFiles)[0];
    for (let i = 0; i < TotalFiles; i++) {
        formData.append('files' + i, files.files[i]);
    }
    formData.append('TotalFiles', TotalFiles);
    formData.append('_token', token);
    for (var pair of formData.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
    }
    let selectNivelTag = `#selectNivel${nivel}`;
    let folderId = (nivel != 0)? $(selectNivelTag).val():0;
    formData.append('folderId', folderId);
    if(TotalFiles > 0){
        $("#exampleModalLabel").html('Subida de archivos');
        $("#divMsge").html(`<i class="fas fa-circle-notch fa-spin"></i>
        <br><label class="control-label">Cargando archivos</label>`);
        $("#formFolder").hide();
        $("#divMsge").show();
        $( "#guardaModal" ).prop( "disabled", true );
        $("#ModalCreateFolder").modal('show');
        proceso();
        $.ajax({
            type:'POST',
            url: `/file/create/${areaId}/${nivel}`,
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: (data) => {
                console.log(data);
                getFilesLevelZero(folderId);
                $(tagInputFiles).val(null);
                $("#ModalCreateFolder").modal('hide');
                $( "#guardaModal" ).prop( "disabled", false );
                messageAlert("Operación exitosa!", "success", data.success);
            },
            error: function(data){
                console.log(data);
                $("#ModalCreateFolder").modal('hide');
                messageAlert("Ha ocurrido un problema.", "error", data.message);
            }
        });
    }
}

function deleteFile(documentName, documentId, folderId){

    Swal.fire({
        title: `¿Está seguro de eliminar "${documentName}"?`,
        text: "Esta operación ya no se podrá deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, borrar!',
        
      }).then((result) => {
          
          if (result.value==true) {
                let token = $("input[name=_token]").val();
                
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
                $.ajax({
                    type:'POST',
                    url: `/file/delete`,
                    data: {'_token':token, 'documentId': documentId, 'idFolder':folderId},
                    dataType: 'json',
                    success: (data) => {
                        getFilesLevelZero(folderId);
                        messageAlert("Operación exitosa!", "success", "Archivo eliminado correctamente");
                    },
                    error: function(data){
                        console.log(data);
                        messageAlert("Ha ocurrido un problema.", "error", "Ocurrió un error al eliminar eliminar el archivo, intente mas tarde.");
                    }
                });
            }
      });
}

function cambiaNombreFolder(folderId, oldName){
    $("#folderIdModFolder").val(folderId);
    $("#folderOldName").val(oldName);
    $("#divMsgeModFolder").html('');
    $("#taitolModify").html(`Cambiar nombre a la carpeta "${oldName}"`);
    $("#buttonsModifyName").show();
    $("#ModalModifyFolder").modal('show');
}

function modifyNameFolder(){
    $("#errorFolderModify").html('');
    let folderId = $("#folderIdModFolder").val();
    let oldName = $("#folderOldName").val();
    let newName = $("#inputNameModify").val();
    let areaId = $("#hiddenAriaId").val();
    if(newName.trim() !== ''){
        $("#formFolderx").hide();
        $("#buttonsModifyName").hide();
        $("#divMsgeModFolder").html(`<i class="fas fa-circle-notch fa-spin"></i>
        <br><label class="control-label">Modificando el nombre la carpeta "${oldName}" por "${newName}"</label>`);
        console.log(`el id del folder que se está modificando es ${folderId}`);
        $("#divMsgeModFolder").fadeIn();
        let token = $("input[name=_token]").val();
        proceso();
        $.ajax({
            type:'POST',
            url: `/folder/update/${folderId}`,
            data: {'_token':token, 'newName': newName, 'areaId':areaId},
            dataType: 'json',
            success: (data) => {
                console.log(data);
                getFilesLevelZero(folderId);
                $("#ModalModifyFolder").modal('hide');
                messageAlert("Operación exitosa!", "success", `Se cambió correctamente el nombre de la carpeta "${oldName}" por el de "${newName}"`);
            },
            error: function(data){
                console.log(data);
                $("#ModalModifyFolder").modal('hide');
                messageAlert("Ha ocurrido un problema.", "error", `Ocurrió un problema al cambiar el nombre de la carpeta "${oldName}" por el de "${newName}"`);
            }
        });
    }else{
        $("#errorFolderModify").html('Debe proporcionar el nombre de la carpeta');
    }
}