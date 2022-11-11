var items = [];
let row = 0;

//Elements Provider
let currentDetail;
let currentQuantity = 0;
let tableProviders = $('#provderTable').DataTable({
    columns: [
        { data: "name" },
        { data: "unit_price" },
        {
            data: "id_detail_requisition",
            render: function(data, type, row, meta) {
                return '<span>' + (row.unit_price * currentQuantity) + '</span>'
            },
        },
        {
            data: "id",
            render: function(data, type, row, meta) {
                return '<button class="btn btn-danger" onclick="deleteProvider(' + data + ', ' + meta.row + ')"><i class="fas fa-trash" /></button>'
            },
        },
    ]
});


function newRequisition() {


    $('#project_id').val('');
    $('#name_project').val('');
    $('#edit_req').hide();
    $('#save_req').show();
    $("#btn_new_item").show();
    let table = $("#createRequisition").DataTable();
    //table.columns.adjust().draw();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: `requisitions/newRequisition`,
        /*data: formdata,
        processData: false,
        contentType: false,*/
        success: function(data) {
            $('#name_project').val("R-" + data.newRequisition);
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

function addRow() {
    //let rowCount = $('#tableBodyCreateRequisition tr').length;
    let rowCount = $('#createRequisition').DataTable().rows().data().length;
    let statusRow = $("#input_status").val();
    let statusOptionItem = "";


    if (rowCount > 0) {
        row = rowCount + 1;

    } else {
        row = 1;
    }
    switch (statusRow) {
        case "Creada":
            statusOptionItem = '<option value="Creada">Creada</option>';
            break;
        case "Procesada":
            statusOptionItem = '<option value="Procesada">Procesada</option>';
            break;
        case "Cotizada":
            statusOptionItem = '<option value="Cotizada">Cotizada</option>';
            break;
        case "Aprobada":
            statusOptionItem = '<option value="Aprobada">Aprobada</option>';
            break;
        case "Entregada":
            statusOptionItem = '<option value="Entregada">Entregada</option>';
            break;
        case "Devolucion":
            statusOptionItem = '<option value="Devolucion">Devolución</option>';
            break;
        case "Cancelada":
            statusOptionItem = '<option value="Cancelada">Cancelada</option>';
            break;
    }

    items.push(row);

    let rowNode = $('#createRequisition').DataTable()
        .row.add([row,
            `<input type="number" class="form-control" id="item_cantidad_${row}" name="item_cantidad_${row}" placeholder="Cantidad" min="1" value="1">`,
            `<select class="form-control" id="item_unidad_${row}">` +
            `<option value="Pieza">Pieza</option>` +
            `<option value="Servicio">Servicio</option>` +
            `</select>`,
            `<textarea id="item_descripcion_${row}" class="form-control"></textarea>`,
            `<textarea id="item_modelo_${row}" class="form-control"></textarea>`,
            `<select id="item_clasificacion_${row}"><option value="1">HERRAMIENTAS EPP</option>` +
            `<option value="2">PAPELERÍA Y ARTICULOS DE OFICINA</option>` +
            `<option value="3">EQUIPO DE CÓMPUTO </option>` +
            `<option value="4">MTTO Y CONSERVACIÓN</option>` +
            `<option value="5">SEGURIDAD E HIGIENE</option>` +
            `<option value="6">VIÁTICOS</option>` +
            `<option value="7"> MOBILIARIO Y EQUIPO</option>` +
            `<option value="8">PROPAGANDA Y PUBLICIDAD</option>` +
            `<option value="9">CAFETERÍA</option>` +
            `<option value="10">EQUIPO DE TRANSPORTE</option>` +
            `<option value="11">EVENTOS INTERNOS</option>` +
            `<option value="12">PAGO DE IMPUESTOS</option>` +
            `<option value="13">VIGILANCIA</option>` +
            `<option value="14">GASTOS FIJOS</option>` +
            `<option value="15">CAFETERIA Y CONSUMIBLES</option>` +
            `<option value="16">LIMPIEZA</option>` +
            `<option value="17">UNIFORMES</option>` +
            `<option value="18">GASTOS GENERALES</option>` +
            `<option value="19">NA</option>` +
            `</select>`,
            `<textarea id="item_referencia_${row}" class="form-control"></textarea>`,
            `<select id="item_urgencia_${row}"><option value="Alto">Alto</option><option value="Bajo">Bajo</option></select>`,
            `<select id="item_status_${row}">${statusOptionItem}</select>`,
            `<div><button class='btn btn-danger' data-toggle="tooltip" data-placement="top" title="Eliminar" onclick='deleteRow(this)'><i class="fas fa-trash"></i></button>`
        ])
        .draw()
        .node();
    /*$("#tableBodyCreateRequisition").append(
        cell
    ); */

}

function calculaPrecio() {

}

function addProvider() {
    let table = $('#createProvider').DataTable({
        "columns": [
            { "data": "name" },
            { "data": "place" },
            { "data": "email" },
            { "data": "phone" },
            {
                "data": null,
                "name": "buttonColumn",
                "render": function(data, type, row) {
                    return '<button>Add Extra</button>';
                }
            },
            {
                "data": null,
                "name": "buttonColumn",
                "render": function(data, type, row) {
                    return `<textarea id="item_prov1" class="form-control"></textarea>`;
                }
            }
        ],

    });

    let rowNode = table
        .row.add([row,
            `<input type="number" class="form-control" id="item_cantidad_${row}" name="item_cantidad_${row}" placeholder="Cantidad" value="0">`,
            `<select class="form-control" id="item_unidad_${row}"><option value="Pieza">Pieza</option><option value="Servicio">Servicio</option></select>`,
            `<textarea id="item_descripcion_${row}" class="form-control"></textarea>`,
            `<textarea id="item_modelo_${row}" class="form-control"></textarea>`,
            `<select id="item_clasificacion_${row}"><option value="1">G202001 HERRAMIENTAS EPP</optin></select>`,
            `<textarea type="text" id="item_referencia_${row}" class="form-control"></textarea>`,
            `<select id="item_urgencia_${row}"><option value="Alto">Alto</optin><option value="Bajo">Bajo</optin></select>`,
            `<select id="item_status_${row}"><option value="Proceso">Proceso</optin><option value="Cotizado">Cotizado</optin>` +
            `<option value="Entregado">Entregado</optin><option value="Devolucion">Devolución</optin>` +
            `<option value="Cancelada">Cancelada</optin></select>`,
            `<textarea id="item_prov1_${row}" class="form-control"></textarea>`,
            `<input type="number" id="item_unitatio1_${row}" class="form-control"></input>`,
            `<input type="number" id="item_subtotal1_${row}" onclick='calculaPrecio()' class="form-control"></input>`,
            "<button class='btn btn-danger' onclick='deleteRow(this)'>Eliminar</button>"
        ])
        .draw()
        .node();

}

function deleteRow(fila, num) {
    let table = $('#createRequisition').DataTable();
    let itemIndex = $(fila).parents("tr")[0].cells[0].innerHTML - 1;
    console.log(num);
    items.splice(num - 1, 1);
    console.log(items)
    table.row($(fila).parents("tr")).remove().draw();
}

function saveRequisition(action = null) {
    let table = $('#createRequisition').DataTable();
    let data = table.rows().data();
    let formdata = new FormData();

    if ($("#project_id").val() == 0) {
        messageAlert("Debe seleccionar el area.", "warning");
        return;
    }

    if (items.length <= 0) {
        console.log("No hay items");
        messageAlert("No hay items.", "warning");
        return;
    }
    let noRequisition = $("#name_project").val();
    formdata.append("noRequisition", noRequisition);
    let i = 1;
    for (const key in items) {
        formdata.append("area_id", $("#project_id").val());
        formdata.append("item_cantidad_" + i, $("#item_cantidad_" + items[key]).val());
        formdata.append("item_unidad_" + i, $("#item_unidad_" + items[key]).val());
        formdata.append("item_descripcion_" + i, $("#item_descripcion_" + items[key]).val());
        formdata.append("item_modelo_" + i, $("#item_modelo_" + items[key]).val());
        formdata.append("item_clasificacion_" + i, $("#item_clasificacion_" + items[key]).val());
        formdata.append("item_referencia_" + i, $("#item_referencia_" + items[key]).val());
        formdata.append("item_urgencia_" + i, $("#item_urgencia_" + items[key]).val());
        formdata.append("item_status_" + i, $("#item_status_" + items[key]).val());
        i++;
    }
    formdata.append("totalItems", i - 1);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: `requisitions`,
        data: formdata,
        processData: false,
        contentType: false,
        success: function(data) {
            messageAlert("Requisición creada.", "success");
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

function showRequisition(id) {
    var table = $('#createRequisition').DataTable();

    table.clear().draw();


    $('#save_req').hide();
    $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: `requisitions/${id}`,

                success: function(data) {
                        $('#project_id').val(data.id_area);
                        $('#name_project').val(data.no_requisition);
                        $('#requisition_').val(data.requisition);
                        console.log(data);
                        items = [];
                        for (const key in data.detailRequisition) {
                            items.push(parseInt(key) + 1);
                            let unit = (data.detailRequisition[key].unit === 'Servicio') ? 2 : 1;
                            let clasification = data.detailRequisition[key].id_classification;
                            let status = data.detailRequisition[key].status;
                            let isValid;
                            let isVisible;
                            console.log(data.edit);
                            if (data.edit == true) {
                                isValid = false;
                                $('#edit_req').show();

                            } else {
                                isValid = true;
                                $('#edit_req').hide();
                            }
                            //si la partida esta cancelada no se podra editar
                            if (status == "Cancelada" || status == "Aprobada") {
                                isValid = true;
                            }

                            //let isValid = (data.currentUser === data.id_user) ? false : true;
                            let row = parseInt(key) + 1;
                            let statusRequisition = data.requisition_status;
                            //se muestra u oculta el boton para agregar items
                            if (data.requisition_status == "Creada") {
                                $("#btn_new_item").show();
                            } else {
                                $("#btn_new_item").hide();
                            }
                            if (statusRequisition == "Cancelada") {
                                $('#edit_req').hide();
                            }
                            if (statusRequisition == "Creada") {
                                isVisible = "style = 'display:block'";
                            } else {
                                isVisible = "style = 'display:none'";
                            }

                            let statusOptionItem = "";
                            switch (status) {
                                case "Creada":
                                    statusOptionItem = '<option value="Creada">Creada</option>';
                                    break;
                                case "Procesada":
                                    statusOptionItem = `<option value="Procesada" selected>Procesada</option><option value="Cotizada">Cotizada</option>`;
                                    break;
                                case "Cotizada":
                                    statusOptionItem = '<option value="Cotizada" selected>Cotizada</option><option value="Cancelada">Cancelada</option>';
                                    break;
                                case "Aprobada":
                                    statusOptionItem = '<option value="Aprobada">Aprobada</option>';
                                    break;
                                case "Entregada":
                                    statusOptionItem = '<option value="Entregada">Entregada</option>';
                                    break;
                                case "Devolucion":
                                    statusOptionItem = '<option value="Devolucion">Devolución</option>';
                                    break;
                                case "Cancelada":
                                    statusOptionItem = '<option value="Cancelada">Cancelada</option>';
                                    break;
                            }

                            let rowNode = $("#createRequisition").DataTable()
                                .row.add([
                                        `<input type="text" style="display:none" disabled class="form-control" id="item_id_${row}" name="item_id_${row}"  value="${data.detailRequisition[key].id}">
                        <input type="text" disabled class="form-control" value="${data.detailRequisition[key].num_item}">`,
                                        `<input type="number" ${(isValid) ? 'disabled' : ''}  class="form-control" id="item_cantidad_${row}" name="item_cantidad_${row}" placeholder="Cantidad" value="${data.detailRequisition[key].quantity}">`,
                                        `<select ${(isValid) ? 'disabled' : ''}   class="form-control" id="item_unidad_${row}"><option value="Pieza" ${(unit === 1)? 'selected' : ''}>Pieza</option><option value="Servicio" ${(unit === 2)? 'selected' : ''}>Servicio</option></select>`,
                                        `<textarea ${(isValid) ? 'disabled' : ''}   id="item_descripcion_${row}" class="form-control" cols="40">${data.detailRequisition[key].description}</textarea>`,
                                        `<input ${(isValid) ? 'disabled' : ''}   id="item_modelo_${row}" class="form-control"  value="${data.detailRequisition[key].model}"></input>`,
                                        `<select ${(isValid) ? 'disabled' : ''}   id="item_clasificacion_${row}">` +
                                        `<option value="1" ${(clasification === 1) ? 'selected' : ''}>HERRAMIENTAS EPP</option>` +
                                        `<option value="2" ${(clasification === 2) ? 'selected' : ''}>PAPELERÍA Y ARTICULOS DE OFICINA</option>` +
                                        `<option value="3" ${(clasification === 3) ? 'selected' : ''}>EQUIPO DE CÓMPUTO </option>` +
                                        `<option value="4" ${(clasification === 4) ? 'selected' : ''}>MTTO Y CONSERVACIÓN</option>` +
                                        `<option value="5" ${(clasification === 5) ? 'selected' : ''}>SEGURIDAD E HIGIENE</option>` +
                                        `<option value="6" ${(clasification === 6) ? 'selected' : ''}>VIÁTICOS</option>` +
                                        `<option value="7" ${(clasification === 7) ? 'selected' : ''}>MOBILIARIO Y EQUIPO</option>` +
                                        `<option value="8" ${(clasification === 8) ? 'selected' : ''}>PROPAGANDA Y PUBLICIDAD</option>` +
                                        `<option value="9" ${(clasification === 9) ? 'selected' : ''}>CAFETERÍA</option>` +
                                        `<option value="10" ${(clasification === 10) ? 'selected' : ''}>EQUIPO DE TRANSPORTE</option>` +
                                        `<option value="11" ${(clasification === 11) ? 'selected' : ''}>EVENTOS INTERNOS</option>` +
                                        `<option value="12" ${(clasification === 12) ? 'selected' : ''}>PAGO DE IMPUESTOS</option>` +
                                        `<option value="13" ${(clasification === 13) ? 'selected' : ''}>VIGILANCIA</option>` +
                                        `<option value="14" ${(clasification === 14) ? 'selected' : ''}>GASTOS FIJOS</option>` +
                                        `<option value="15" ${(clasification === 15) ? 'selected' : ''}>CAFETERIA Y CONSUMIBLES</option>` +
                                        `<option value="16" ${(clasification === 16) ? 'selected' : ''}>LIMPIEZA</option>` +
                                        `<option value="17" ${(clasification === 17) ? 'selected' : ''}>UNIFORMES</option>` +
                                        `<option value="18" ${(clasification === 18) ? 'selected' : ''}>GASTOS GENERALES</option>` +
                                        `<option value="19" ${(clasification === 9) ? 'selected' : ''}>NA</option>` +
                                        `</select>`,
                                        `<input ${(isValid) ? 'disabled' : ''}   type="text" id="item_referencia_${row}" class="form-control" value="${data.detailRequisition[key].preference}"></input>`,
                                        `<select ${(isValid) ? 'disabled' : ''}   id="item_urgencia_${row}"><option value="Alto" ${(data.detailRequisition[key].urgency === 'Alto') ? 'selected' : ''}>Alto</optin><option value="Bajo" ${(data.detailRequisition[key].urgency === 'Bajo') ? 'selected' : ''}>Bajo</optin></select>`,
                                        `<select ${(isValid) ? 'disabled' : ''}   id="item_status_${row}">${statusOptionItem}</select>`,
                                        `<div><button ${isVisible} ${(isValid) ? 'disabled' : ''}
                        class='btn btn-danger' data-toggle='tooltip' data-placement='top' title='Eliminar' onclick='deleteRow(this, ${row})'><i class="fas fa-trash"></i></button>
                        ${(data.permission === 3) ? `<span ${(status === 'Cancelada') ? 'style="display:none"' : 'style="display:block"'} data-toggle='modal' data-target='#modalProvider' data-backdrop='static'><button class='btn btn-primary' onclick='showProvider(${data.detailRequisition[key].id},${data.detailRequisition[key].quantity})' data-toggle='tooltip' data-placement='top' title='Agregar Proveedores'><i class='fas fa-box' /></button></span>` : ''}</div>`
                    ])
                    .draw()
                    .node();
            }
            console.log(items);
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



    /*ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: `requisitions/${id}`,
        success: function(data) {
            console.log(data);
        }
    });*/


}

function limpiaTabla() {
    $("#createRequisition").DataTable()
        .clear()
        .draw();
    $('#modalCreateRequisition').modal('hide');
}

//Provider Functions
function showProvider(detail, quantity) {
    currentDetail = detail;
    currentQuantity = quantity;
    $("#modalCreateRequisition").modal("hide");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: `requisitions/${detail}/providers`,
        success: function(response) {
            if (response.data.length > 0) {
                let temp = [];
                for (const d of response.data) {
                    let item = {
                        id: d.id,
                        id_detail_requisition: d.id_detail_requisition,
                        name: d.name,
                        unit_price: d.unit_price,
                    }
                    temp.push(item);
                }
                $('#provderTable').dataTable().fnClearTable();
                $('#provderTable').dataTable().fnAddData(temp);
            }
        },
        error: function(data) {
            console.log(data.responseJSON);
        }
    });
}
//Editar Requisicion
function editRequisition() {
    let formdata = new FormData();

    if ($("#project_id").val() == 0) {
        messageAlert("Debe seleccionar el area.", "warning");
        return;
    }

    if (items.length <= 0) {
        messageAlert("No hay items.", "warning");
        return;
    }
    let noRequisition = $("#name_project").val();
    let requisition_ = $("#requisition_").val();
    formdata.append("noRequisition", noRequisition);
    formdata.append("id", requisition_);
    let i = 1;

    for (const key in items) {
        console.log(key);
        formdata.append("area_id", $("#project_id").val());
        formdata.append("item_id_" + i, ($("#item_id_" + items[key]).val()) === undefined ? null : $("#item_id_" + items[key]).val());
        formdata.append("item_cantidad_" + i, $("#item_cantidad_" + items[key]).val());
        formdata.append("item_unidad_" + i, $("#item_unidad_" + items[key]).val());
        formdata.append("item_descripcion_" + i, $("#item_descripcion_" + items[key]).val());
        formdata.append("item_modelo_" + i, $("#item_modelo_" + items[key]).val());
        formdata.append("item_clasificacion_" + i, $("#item_clasificacion_" + items[key]).val());
        formdata.append("item_referencia_" + i, $("#item_referencia_" + items[key]).val());
        formdata.append("item_urgencia_" + i, $("#item_urgencia_" + items[key]).val());
        formdata.append("item_status_" + i, $("#item_status_" + items[key]).val());
        i++;

    }

    formdata.append("totalItems", items.length);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: `requisitions/${requisition_}/customUpdate`,
        data: formdata,
        processData: false,
        contentType: false,
        success: function(data) {
            messageAlert("Requisición Editada.", "success");
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

function saveProvider() {
    let count = $('#provderTable').DataTable().rows().data().length;

    let data = {
        id_detail_requisition: currentDetail,
        num_item: count + 1,
        name: $('#name').val(),
        unit_price: $('#unit_price').val(),
    }

    if (data.name === '' || data.unit_price === '') {
        messageAlert("Datos incompletos.", "warning");
        return;
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        data: data,
        url: `requisitions/providers`,
        success: function(data) {
            if (data.error === false) {
                let item = {
                    id: data.provider.id,
                    id_detail_requisition: data.provider.id_detail_requisition,
                    name: data.provider.name,
                    unit_price: data.provider.unit_price,
                }

                $('#provderTable').dataTable().fnAddData([item]);
                $('#totalProvider').empty();
                $('#totalProvider').append(`<h5>Total: ${(currentQuantity * data.provider.unit_price)}</h5>`);

                $('#num_item').val('');
                $('#name').val('');
                $('#unit_price').val('');
            }
        },
        error: function(data) {
            console.log(data.responseJSON);
        }
    });
}

function deleteProvider(id, index) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: `requisitions/providers/${id}`,
        success: function(data) {
            if (data.error === false) {
                $('#provderTable').dataTable().fnDeleteRow(index);
            }
        },
        error: function(data) {
            console.log(data.responseJSON);
        }
    });
}

function closeModalProvider() {
    $('#provderTable').dataTable().fnClearTable();
    $('#modalProvider').modal('hide');
    $("#modalCreateRequisition").modal("show");
}



function uploadFiles(tipo) {
    let id = $("#hiddeIdRequisicion").val();
    let file;
    if (tipo == "normal") {
        file = $('#inputFile')[0];
    } else {
        file = $('#inputFileFactura')[0];
    }

    let data = new FormData();
    data.append("id", id);
    data.append("tipo", tipo);
    data.append("tamanoFiles", file.files.length);
    for (let i = 0; i < file.files.length; i++) {
        data.append('file' + i, file.files[i]);
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: `requisitions/${id}/uploadFile`,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

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

function showModalFile(id) {
    $("#hiddeIdRequisicion").val(id);
    $("#bodyFiles").empty();
    $("#divFactura").hide();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: `requisitions/${id}/files`,
        /*data: data,
        cache: false,
        contentType: false,
        processData: false,*/
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {
                console.log(data.userAdmin);
                let html = "";
                var url = "{{asset('')}}";
                console.log(data);
                if (data.totalFacturas <= 0) {
                    $("#divFactura").show();
                }
                for (const key in data.requisitionFiles) {
                    html += `<tr>` +
                        `<td>${data.requisitionFiles[key].id}</td>` +
                        `<td><a href="${data.requisitionFiles[key].ruta}/${data.requisitionFiles[key].name}" target="_blank">${data.requisitionFiles[key].name}</a></td>`+
                        `<td><textarea name ="txt_comentario_${data.requisitionFiles[key].id}" id="txt_comentario_${data.requisitionFiles[key].id}">${data.requisitionFiles[key].comment}</textarea></td>`+
                        `<td>`;
                    if (data.userCompras == true) {
                        html += `<span>`+
                        `<button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Guardar Comentario" onclick="saveComment(${data.requisitionFiles[key].id})">`+
                            `<i class="fas fa-check"></i>`+
                        `</button>`+
                        `</span>`;
                    }
                    if (data.userAdmin == true) {
                        html += `<span >` +
                            `<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Cancelar" onclick="deleteFile(${data.requisitionFiles[key].id})">` +
                            `<i class="fas fa-minus-square"></i>` +
                            `</button>` +
                            `</span>`;
                    }
                    html += `</td></tr>`;

                }
                $("#bodyFiles").append(html);
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

function aprobar(id, status) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: `requisitions/${id}/updateStatusRequisition`,
        data: { "status": status },
        /*cache: false,
        contentType: false,
        processData: false,*/
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {
                messageAlert(data.msg, "success", "");
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

function deleteFile(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "DELETE",
        url: `requisitions/${id}/deleteFile`,
        /*cache: false,
        contentType: false,
        processData: false,*/
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {
                messageAlert(data.msg, "success", "");
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

function saveComment(idFile) {
    let comentario = $("#txt_comentario_"+idFile).val();
    console.log(idFile);
    console.log($("#txt_comentario_"+idFile).val());
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: `requisitions/${idFile}/comment`,
        data: {"comment": comentario},
        /*cache: false,
        contentType: false,
        processData: false,*/
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {
                messageAlert("Comentario Guardado.", "success");

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