function saveTypeIndicator() {
    $.ajax({

        type: "POST",
        url: "/indicators/create/typeIndicator",
        data: $("#formRegisterTypeIndicador").serialize(),
        //dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalRegisterTypeIndicador").modal('hide');

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

function saveIndicator() {
    let idArea = $("#sltArea").val();
    let typeIndicator = $("#inputIndicatorType").val();
    let valorOptenido = $("#inputValue").val();
    let fechaRegistro = $("#inputreRegistrationDate").val();
    let data = new FormData();
    let file = $('#fileIndicador')[0];
    data.append("file", file.files[0]);
    data.append("idArea", idArea);
    data.append("typeIndicator", typeIndicator);
    data.append("valorOptenido", valorOptenido);
    data.append("fechaRegistro", fechaRegistro);
    console.log(data);

    //data.append("file", $('#fileIndicador')[0]);
    //$("#formRegisterIndicador").serialize()
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/indicators/create",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        //dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalRegisterIndicator").modal('hide');

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

function minMax() {
    let indicatorType = $("#inputIndicatorType").val();

    /*$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });*/
    console.log(indicatorType);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/indicators/create/minMax",
        data: { "indicatorType": indicatorType, _token: $('meta[name="csrf-token"]').attr('content') },
        //dataType: 'json',
        success: function(data) {
            console.log(data);

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#minimo").val(data.minMax[0].min);

                $("#maximo").val(data.minMax[0].max);

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

function graficaIndicador() {
    $("#bodyIndicatorsDos").empty();
    $('#bar').html(''); //remove canvas from container
    $('#bar').html("<canvas id='chartIndicator'></canvas>");
    $.ajax({
        type: "POST",
        url: "/indicators/grafica",
        data: $("#formGraficaIndicador").serialize(),
        //dataType: 'json',
        success: function(data) {
            console.log(data.indicatorsGraph);

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {
                let valores = [];
                let table = "";

                //datos de graficacion
                for (const i in data.indicatorsGraph) {
                    table += `<tr>"
                        <td> ${data.indicatorsGraph[i].area}</td>
                        <td> ${data.indicatorsGraph[i].tipo_indicador}</td>
                        <td> ${data.indicatorsGraph[i].value}</td>
                        <td>
                            <a href="storage/Documents/Indicadores/${data.indicatorsGraph[i].file_name}" target="_blank">${data.indicatorsGraph[i].file_name}</a>
                        </td>"
                        <td> ${data.indicatorsGraph[i].registration_date}</td>
                    </tr>`;

                }

                $("#bodyIndicatorsDos").append(table);
                $("#tableIndicatorsDos").show();




                //datos para graficar
                for (let i = 0; i < 11; i++) {
                    if (i < data.grafica.length) {
                        if (i == data.grafica[i].month - 1) {
                            valores[i] = data.grafica[i].value;
                        } else {
                            if (valores[i] == "") {
                                valores[i] = 0;
                            }

                            valores[data.grafica[i].month - 1] = data.grafica[i].value;


                        }

                    } else {
                        valores.push(0);
                    }


                }
                //maximos
                let objetivos = {
                    type: 'line',
                    label: 'Valor Objetivo',
                    data: [data.minMax.max,
                        data.minMax.max,
                        data.minMax.max,
                        data.minMax.max,
                        data.minMax.max,
                        data.minMax.max,
                        data.minMax.max,
                        data.minMax.max,
                        data.minMax.max,
                        data.minMax.max,
                        data.minMax.max,
                        data.minMax.max
                    ],
                    order: 2,
                    fill: false,
                    pointRadius: 5,
                    pointBackgroundColor: 'rgba(0, 99, 132, 1)',
                    //backgroundColor: 'rgba(0, 0, 0, 0.6)',
                    borderColor: 'rgba(0, 99, 132)',
                    //yAxisID: "y-axis-density"
                };
                //minimos
                let min = {
                    type: 'line',
                    label: 'Valor Minimo',
                    data: [data.minMax.min,
                        data.minMax.min,
                        data.minMax.min,
                        data.minMax.min,
                        data.minMax.min,
                        data.minMax.min,
                        data.minMax.min,
                        data.minMax.min,
                        data.minMax.min,
                        data.minMax.min,
                        data.minMax.min,
                        data.minMax.min
                    ],
                    order: 1,
                    fill: false,
                    pointRadius: 5,
                    pointBackgroundColor: 'rgba(255, 0, 0, 1)',
                    //backgroundColor: 'rgba(0, 0, 0, 0.6)',
                    borderColor: 'rgba(255, 0, 0)',
                    //yAxisID: "y-axis-density"
                };

                let obtenidos = {
                    label: 'Valor Obtenido',
                    data: valores,
                    order: 0,
                    backgroundColor: 'rgba(99, 152, 0, 0.5)',
                    borderColor: 'rgba(99, 152, 0, 1)',
                    borderWidth: 1,
                    //yAxisID: "y-axis-gravity"
                };

                let indicators = {
                    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    datasets: [obtenidos, objetivos, min]
                };


                $("#ModalGraficaIndicator").modal('hide');

                let ctx = document.getElementById('chartIndicator').getContext('2d');


                let grafica = new Chart(ctx, {
                    type: 'bar',
                    data: indicators,
                    //options: chartOptions
                });

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