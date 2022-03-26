//RESETEA FORMULARIO
$('[data-toggle="tooltip"]').tooltip();

function resetForm(id) {
    document.getElementById(id).reset();
}

//ventana de carga
function proceso() {
    swal.fire({
        title: 'Procesando...',
        showLoading: true,
        timer: 3000,
    })
}
//ALERTAS
function messageAlert(title, icon, text) {
    let texto = (text === null || text === '') ? '' : text;
    Swal.fire({
        icon: icon,
        title: title,
        text: texto,
    })
}

//GRAFICAR
function grafica(data, div, tipo) {
    var ctx = document.getElementById(div).getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Colocado', 'Proceso', 'Terminado'],
            datasets: [{
                label: '# of Votes',
                data: data,
                backgroundColor: [
                    'red',
                    'blue',
                    'green'

                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)'

                ],
                borderWidth: 1
            }]
        },
        /*options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
                xAxes: []
            }
        }*/
    });
}

//formato de tabla
function table(id) {
    $(id).DataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf'
        ]
    });
}