var items = [];
let row = 0;


function newRequisition() {
    //limpiaTabla();

    let table = $("#createRequisition").DataTable({
        scrollX: true,
        searching: false,
        paging: false,

        columns: [
            { title: '#', "width": "50%" },
            { title: 'Cant.', "width": "50%" },
            { title: 'Unidad', "width": "70%" },
            { title: 'Descripción', "width": "80%" },
            { title: 'Modelo', "width": "80%" },
            { title: 'Clasificación', "width": "50%" },
            { title: 'Referencia', "width": "80%" },
            { title: 'Nivel de Urgencia', "width": "50%" },
            { title: 'Estatus', "width": "50%" },
            { title: 'Accion', "width": "50%" },


        ]
    });

    //t

}

function addRow() {
    let rowCount = $('#tableBodyCreateRequisition tr').length;
    let table = $('#createRequisition').DataTable();

    //table.data().count()
    if (table.data().count() > 0) {
        row = row + 1;

    } else {
        row = 1;
    }

    items.push(row);

    let rowNode = table
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
            "<button class='btn btn-danger' onclick='deleteRow(this)'>Eliminar</button>"
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
    let table = $('#createRequisition').DataTable({
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
                    return `<textarea id="item_prov1_${row}" class="form-control"></textarea>`;
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
    console.log(items);
    let table = $('#createRequisition').DataTable();
    console.log($(fila).parents("tr")[0].cells[0].innerHTML);
    let itemIndex = $(fila).parents("tr")[0].cells[0].innerHTML - 1;
    console.log(itemIndex);
    items.splice(itemIndex, 1);
    console.log(items)
    table.row($(fila).parents("tr")).remove().draw();
}

function saveRequisition() {
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
        console.log(items[key]);
        formdata.append("area_id", $("#project_id").val());
        formdata.append("item_cantidad_" + i, $("#item_cantidad_" + items[key]).val());
        formdata.append("item_unidad_" + i, $("#item_unidad_" + items[key]).val());
        formdata.append("item_descripcion_" + i, $("#item_descripcion_" + items[key]).val());
        formdata.append("item_modelo_" + i, $("#item_modelo_" + items[key]).val());
        formdata.append("item_clasificacion_" + i, $("#item_clasificacion_" + items[key]).val());
        formdata.append("item_referencia_" + i, $("#item_referencia_" + items[key]).val());
        formdata.append("item_urgencia_" + i, $("#item_urgencia_" + items[key]).val());
        formdata.append("item_status_" + i, $("#item_status_" + items[key]).val());
        formdata.append("item_prov1_" + i, $("#item_prov1_" + items[key]).val());
        formdata.append("item_unitatio1_" + i, $("#item_unitatio1_" + items[key]).val());
        formdata.append("item_subtotal1_" + i, $("#item_subtotal1_" + items[key]).val());
        formdata.append("item_prov2_" + i, $("#item_prov2_" + items[key]).val());
        formdata.append("item_unitario2_" + i, $("#item_unitario2_" + items[key]).val());
        formdata.append("item_subtotal2_" + i, $("#item_subtotal2_" + items[key]).val());
        formdata.append("item_prov3_" + i, $("#item_prov3_" + items[key]).val());
        formdata.append("item_unitario3_" + i, $("#item_unitario3_" + items[key]).val());
        formdata.append("item_subtotal3_" + i, $("#item_subtotal3_" + items[key]).val());
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
            return;
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

    let row = 1;
    let table = $("#createRequisition").DataTable({
        scrollX: true,
        searching: false,
        paging: false,

        columns: [
            { title: '#', "width": "50%" },
            { title: 'Cant.', "width": "50%" },
            { title: 'Unidad', "width": "70%" },
            { title: 'Descripción', "width": "80%" },
            { title: 'Modelo', "width": "80%" },
            { title: 'Clasificación', "width": "50%" },
            { title: 'Referencia', "width": "80%" },
            { title: 'Nivel de Urgencia', "width": "50%" },
            { title: 'Estatus', "width": "50%" },
            { title: 'Proveedor', "width": "50%" },
            { title: 'Unitario', "width": "50%" },
            { title: 'Total', "width": "50%" },
            { title: 'Accion', "width": "50%" },
        ]
    });
    table.clear().draw();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: `requisitions/${id}`,

        success: function(data) {
            console.log(data);
            for (const key in data.detailRequisition) {
                let rowNode = table
                    .row.add([data.detailRequisition[key].id,
                        `<input type="number" class="form-control" id="item_cantidad_${row}" name="item_cantidad_${row}" placeholder="Cantidad" value="0">`,
                        `<select class="form-control" id="item_unidad_${row}"><option value="Pieza">Pieza</option><option value="Servicio">Servicio</option></select>`,
                        `<textarea id="item_descripcion_${row}" class="form-control"></textarea>`,
                        `<input id="item_modelo_${row}" class="form-control"></input>`,
                        `<select id="item_clasificacion_${row}"><option value="1">G202001 HERRAMIENTAS EPP</optin></select>`,
                        `<input type="text" id="item_referencia_${row}" class="form-control"></input>`,
                        `<select id="item_urgencia_${row}"><option value="Alto">Alto</optin><option value="Bajo">Bajo</optin></select>`,
                        `<select id="item_status_${row}"><option value="Proceso">Proceso</optin><option value="Cotizado">Cotizado</optin>` +
                        `<option value="Entregado">Entregado</optin><option value="Devolucion">Devolución</optin>` +
                        `<option value="Cancelada">Cancelada</optin></select>`,
                        `<textarea id="item_prov1_${row}" class="form-control"></textarea>`,
                        `<input type="number" id="item_unitatio1_${row}" onclick='calculaPrecio()' class="form-control"></input>`,
                        `<input type="number" id="item_subtotal1_${row}" class="form-control"></input>`,
                        "<button class='btn btn-danger' onclick='deleteRow(this)'>Eliminar</button>"
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
    $("#createRequisition").dataTable();

    $("#createRequisition").dataTable({
        "bDestroy": true
    }).fnDestroy();
}