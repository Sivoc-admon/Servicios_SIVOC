function saveCustomer() {

    /*$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });*/

    //e.preventDefault();

    $.ajax({
        type: "POST",
        url: "customers/store",
        data: $("#formRegisterCustomer").serialize(),
        dataType: 'json',
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

function editCustomer(id) {

    $.ajax({
        type: "GET",
        url: `customers/${id}/edit`,
        dataType: 'json',
        success: function(data) {
            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {
                console.log(data);
                $("#id_customer_edit").val(id);
                $("#inputNameCustomerEdit").val(data.customer.name);
                $("#inputCodeCustomerEdit").val(data.customer.code);
                $("#inputAddressCustomerEdit").val(data.customer.address);
                $("#inputPhoneCustomerEdit").val(data.customer.phone);
                $("#inputEmailCustomerEdit").val(data.customer.email);

                $("#ModalEditCustomer").modal('show');
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

function updateCustomer() {
    let id = $("#id_customer_edit").val();
    $.ajax({
        type: "PUT",
        url: `customers/${id}`,
        data: $("#formEditCustomer").serialize(),
        dataType: 'json',
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
