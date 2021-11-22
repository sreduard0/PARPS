//================================[RESGISTRANDO ENTRADA]================================//
function register() {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });


    var data = {
        visitor_id: visitor_id.value,
        drive: drive.value,
        phone: phone.value,
        destination_id: destination_id.value,
        reason_id: reason_id.value,
        badge: badge.value
    };


    if (
        data.visitor_id == "" ||
        data.drive == "" ||
        data.phone == "" ||
        data.destination_id == "" ||
        data.reason_id == "" ||
        data.badge == ""
    ){

        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Todos os campos devem estar preenchidos.'
        });

        return false;
    }

    if (data.phone.replace(/\D+/g, "").length < 11)
    {
        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Número de telefone incorreto.'
        });
        return false;
    }



    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: location+'record/visitor',
        type: 'POST',
        data: data,
        dataType: 'text',
        success: function (data) {

            if (data == "error") {

                Toast.fire({
                icon: 'error',
                title: '&nbsp&nbsp O visitante não possui CNH ou já esta registrado.'
             });
            } else {

                $("#register").modal('hide');
                $("#table").DataTable().clear().draw(6);
                Toast.fire({
                    icon: 'success',
                    title: '&nbsp&nbsp Entrada registrada com sucesso.'
                });

                $('#form-register')[0].reset();
                $(".select2s").val('').trigger('change');
                $(".select2").val('').trigger('change');

            }

        },

        error: function (data) {
             Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro ao registrar.'
                    });
        }
    });
}

//================================[RESGISTRANDO SAIDA]================================//
function confirm_exit(id) {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });

    bootbox.confirm({
        title: ' Deseja encerrar esta visita ?',
        message: '<strong>Essa operação não pode ser desfeita!</strong> <br> Lembre-se de recolher o cracha do visitante e verificar se o mesmo não esqueceu nada nas dependencias da OM.',
        callback: function(confirmacao) {

            if (confirmacao)
            $.ajax({
                url:  location+"record/finish/"+id,
                type: "GET",
                success: function(data) {
                   $("#table").DataTable().clear().draw(6);
                    Toast.fire({
                        icon: 'success',
                        title: '&nbsp&nbsp Visita encerrada com sucesso.'
                    });

                },
                 error: function(data) {
                    Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro ao encerrar visita'
                    });

                }
            });
        },
        buttons: {
            cancel: {
                label: 'Cancelar',
                className: 'btn-default'
            },
            confirm: {
                label: 'Encerrar',
                className: 'btn-success'
            }

        }
    });
}





