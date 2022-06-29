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
    let table = $("#createRequisition").DataTable();

}

function addRow() {
    //let rowCount = $('#tableBodyCreateRequisition tr').length;
    let rowCount = $('#createRequisition').DataTable().rows().data().length;

    if (rowCount > 0) {
        row = rowCount + 1;

    } else {
        row = 1;
    }

    items.push(row);

    let rowNode = $('#createRequisition').DataTable()
        .row.add([row,
            `<input type="number" class="form-control" id="item_cantidad_${row}" name="item_cantidad_${row}" placeholder="Cantidad" value="0">`,
            `<select class="form-control" id="item_unidad_${row}">` +
            `<option value="Pieza">Pieza</option>` +
            `<option value="Servicio">Servicio</option>` +
            `</select>`,
            `<textarea id="item_descripcion_${row}" class="form-control"></textarea>`,
            `<textarea id="item_modelo_${row}" class="form-control"></textarea>`,
            `<select id="item_clasificacion_${row}">` +
            `<option value="1">G202001 HERRAMIENTAS EPP</option>` +
            `</select>`,
            `<textarea id="item_referencia_${row}" class="form-control"></textarea>`,
            `<select id="item_urgencia_${row}"><option value="Alto">Alto</option><option value="Bajo">Bajo</option></select>`,
            `<select id="item_status_${row}"><option value="Proceso">Proceso</option><option value="Cotizado">Cotizado</option>` +
            `<option value="Entregado">Entregado</option><option value="Devolucion">Devolución</option>` +
            `<option value="Cancelada">Cancelada</option></select>`,
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

function deleteRow(fila) {
    let table = $('#createRequisition').DataTable();
    console.log($(fila).parents("tr")[0].cells[0].innerHTML);
    let itemIndex = $(fila).parents("tr")[0].cells[0].innerHTML - 1;
    console.log(itemIndex);
    items.splice(itemIndex, 1);
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

function showRequisition(id) {
    $('#edit_req').show();
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
            for (const key in data.detailRequisition) {
                items.push(parseInt(key) + 1);
                let unit = (data.detailRequisition[key].unit === 'Servicio') ? 2 : 1;
                let clasification = data.detailRequisition[key].id_classification;
                let status = data.detailRequisition[key].status;
                let isValid = (data.currentUser === data.id_user) ? false : true;
                let row = parseInt(key) + 1;
                let rowNode = $("#createRequisition").DataTable()
                    .row.add([
                        `<input type="text" disabled class="form-control" id="item_id_${row}" name="item_id_${row}"  value="${data.detailRequisition[key].id}">`,
                        `<input type="number" ${(isValid) ? 'disabled' : ''}  class="form-control" id="item_cantidad_${row}" name="item_cantidad_${row}" placeholder="Cantidad" value="${data.detailRequisition[key].quantity}">`,
                        `<select ${(isValid) ? 'disabled' : ''}   class="form-control" id="item_unidad_${row}"><option value="Pieza" ${(unit === 1)? 'selected' : ''}>Pieza</option><option value="Servicio" ${(unit === 2)? 'selected' : ''}>Servicio</option></select>`,
                        `<input ${(isValid) ? 'disabled' : ''}   id="item_descripcion_${row}" class="form-control" value="${data.detailRequisition[key].description}"></input>`,
                        `<input ${(isValid) ? 'disabled' : ''}   id="item_modelo_${row}" class="form-control"  value="${data.detailRequisition[key].model}"></input>`,
                        `<select ${(isValid) ? 'disabled' : ''}   id="item_clasificacion_${row}"><option value="1" ${(clasification === 1) ? 'selected' : ''}>G202001 HERRAMIENTAS EPP</option></select>`,
                        `<input ${(isValid) ? 'disabled' : ''}   type="text" id="item_referencia_${row}" class="form-control" value="${data.detailRequisition[key].preference}"></input>`,
                        `<select ${(isValid) ? 'disabled' : ''}   id="item_urgencia_${row}"><option value="Alto">Alto</optin><option value="Bajo">Bajo</optin></select>`,
                        `<select ${(isValid) ? 'disabled' : ''}   id="item_status_${row}"><option value="Proceso" ${(status === 'Proceso') ? 'selected' : ''}>Proceso</option><option value="Cotizado" ${(status === 'Cotizado') ? 'selected' : ''}>Cotizado</optin>` +
                        `<option value="Entregado" ${(status === 'Entregado') ? 'selected' : ''}>Entregado</optin><option value="Devolucion" ${(status === 'Devolucion') ? 'selected' : ''}>Devolución</optin>` +
                        `<option value="Cancelada" ${(status === 'Cancelada') ? 'selected' : ''}>Cancelada</optin></select>`,
                        `<div><button ${(isValid) ? 'disabled' : ''}
                        class='btn btn-danger' data-toggle="tooltip" data-placement="top" title="Eliminar" onclick='deleteRow(this)'><i class="fas fa-trash"></i></button>
                        ${(data.permission === 3) ? "<span data-toggle='modal' data-target='#modalProvider' data-backdrop='static'><button class='btn btn-primary' onclick='showProvider("+data.detailRequisition[key].id+","+data.detailRequisition[key].quantity+")' data-toggle='tooltip' data-placement='top' title='Agregar Proveedores'><i class='fas fa-box' /></button></span>" : ''}</div>`
                    ])
                    .draw()
                    .node();
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
    formdata.append("totalItems", i - 1);

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
}



function uploadFiles() {
    let id = $("#hiddeIdRequisicion").val();
    let file = $('#inputFile')[0];

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
                let html = "";
                var url = "{{asset('')}}";
                for (const key in data.requisitionFiles) {
                    html = `<td>${data.requisitionFiles[key].id}</td>` +
                        `<td><a href="${data.requisitionFiles[key].ruta}/${data.requisitionFiles[key].name}" target="_blank">${data.requisitionFiles[key].name}</a></td>`;
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


