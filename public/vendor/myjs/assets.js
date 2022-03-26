function saveAsset() {

    let description = $("#inputDescriptionAsset").val();
    let costo = $("#inputCostoAsset").val();
    let buy = $("#inputBuyAsset").val();
    let check = 0;
    let dayCalibration = $("#inputCalibrationDayAsset").val();
    let calibrationFile = $('#fileAssetCalibration')[0];
    let generalFile = $('#fileAsset')[0];

    let data = new FormData();
    data.append("description", description);
    data.append("costo", costo);
    data.append("buy", buy);

    if ($("#checkAsset").is(':checked')) {
        check = 1;
        data.append("check", check);
    } else {
        check = 0;
        data.append("check", check);
    }
    data.append("dayCalibration", dayCalibration);
    data.append("lengthCalibration", calibrationFile.files.length);
    data.append("lengthGeneral", generalFile.files.length);

    for (let i = 0; i < calibrationFile.files.length; i++) {
        data.append('calibrationFile' + i, calibrationFile.files[i]);
    }

    for (let j = 0; j < generalFile.files.length; j++) {
        data.append('generalFile' + j, generalFile.files[j]);
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "assets",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalRegisterAsset").modal('hide');

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

function muestraOculta(check, div, file) {
    let calibration = $("#" + check).val();
    console.log($("#" + check).checked);
    if ($("#" + check).is(':checked')) {
        $("#" + div).show();
    } else {
        $("#" + div).hide();
        $(file).val("");
    }
}

function editAsset(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "GET",
        url: `assets/${id}/edit`,
        //data: $("#formRegisterUser").serialize(),
        dataType: 'json',
        success: function(data) {
            console.log(data);

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#inputEditDescriptionAsset").val(data.asset.description);
                $("#inputEditCostoAsset").val(data.asset.clasification);
                $("#hidAsset").val(data.asset.id);
                $("#inputEditBuyAsset").val(data.asset.day_buy);
                if (data.asset.calibration == 1) {
                    $('#checkEditAsset').prop('checked', true);
                    $('#divEditCalibration').show();
                }


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

function updateAsset() {

    let id = $("#hidAsset").val();


    $.ajax({
        type: "PUT",
        url: `assets/${id}`,
        data: $("#formEditAsset").serialize(),

        //dataType: 'json',
        success: function(data) {


            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalEditAsset").modal('hide');

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

function showAssetFile(asset, tipo) {
    console.log(tipo);
    $("#showAssetFiles").empty();
    $.ajax({
        type: "GET",
        url: `assets/showAssetFiles/${asset}`,
        data: { "tipo": tipo },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                let table = "";
                let carpeta = "";
                $("#hideModalIdAsset").val(asset);
                $("#tipoFile").val(tipo);
                for (const i in data.assetfiles) {
                    if (data.assetfiles[i].type == "General") {
                        carpeta = "General";
                    } else {
                        carpeta = "Calibracion";
                    }
                    table += `<tr>"
                        <td> ${data.assetfiles[i].id}</td> 
                        <td>
                            <a href="storage/Documents/Activos/${asset}/${carpeta}/${data.assetfiles[i].name}" target="_blank">${data.assetfiles[i].name}</a>
                        </td>"
                    </tr>`;

                }

                $("#showAssetFiles").append(table);


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

    let asset = $("#hideModalIdAsset").val();
    let file = $('#fileUploadAssetFile')[0];
    let tipo = $("#tipoFile").val();

    let data = new FormData();
    data.append("asset", asset);
    data.append("tamanoFiles", file.files.length);
    data.append("tipo", tipo);
    for (let i = 0; i < file.files.length; i++) {
        data.append('file' + i, file.files[i]);
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: `assets/${asset}/uploadFile`,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalShowFilesAsset").modal('hide');

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