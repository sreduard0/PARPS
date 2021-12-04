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
        url:'/record/visitor',
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

//================================[ADICIONAR EMPRESA]================================//
function add_enterprise() {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });


    var data = {
        enterprise: enterprise.value,
        phone: phone.value,
        street: street.value,
        number: number.value,
        district: district.value,
        city: city.value
    };


    if (
        data.enterprise == "" ||
        data.phone == "" ||
        data.street == "" ||
        data.number == "" ||
        data.district == "" ||
        data.city == ""
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
        url: '/enterprise/add',
        type: 'POST',
        data: data,
        dataType: 'text',
        success: function (data) {

            if (data == "error") {

                Toast.fire({
                icon: 'error',
                title: '&nbsp&nbsp Essa empresa já está cadastrada.'
             });
            } else {

                $("#register").modal('hide');
                $("#table").DataTable().clear().draw(6);
                Toast.fire({
                    icon: 'success',
                    title: '&nbsp&nbsp Empresa cadastrada com sucesso.'
                });

                $('#form-enterprise')[0].reset();

            }

        },

        error: function (data) {
             Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro ao cadastrar.'
                    });
        }
    });
}

//================================[DELETAR EMPRESA]================================//
function confirm_delete(id) {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });

    bootbox.confirm({
        title: ' Deseja excluir essa empresa?',
        message: '<strong>Essa operação não pode ser desfeita!</strong>',
        callback: function(confirmacao) {

            if (confirmacao)
            $.ajax({
                url:  "/enterprise/delete/"+id,
                type: "GET",
                success: function(data) {
                   $("#table").DataTable().clear().draw(6);
                    Toast.fire({
                        icon: 'success',
                        title: '&nbsp&nbsp Empresa excluida.'
                    });

                },
                 error: function(data) {
                    Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro excluir.'
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
                label: 'Excluir',
                className: 'btn-danger'
            }

        }
    });
}

//================================[ADICIONAR VISITANTE]================================//
function add_visitor() {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });


    var data = {
        image_profile: image_profile.value,
        name: name_visitor.value,
        cpf: cpf.value,
        phone: phone.value,
        cnh: cnh.value,
        enterprise_id: enterprise_id.value,
    };


    if (
        data.image_profile == "" ||
        data.cpf == "" ||
        data.phone == "" ||
        data.cnh == "" ||
        data.enterprise_id == "" ||
        data.name == ""
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
        url: '/visitor/add',
        type: 'POST',
        data: data,
        dataType: 'text',
        success: function (data) {

            if (data == "error") {

                Toast.fire({
                icon: 'error',
                title: '&nbsp&nbsp Esse(a) visitante já está cadastrada.'
             });
            } else {

                $("#register").modal('hide');
                $("#table").DataTable().clear().draw(6);
                Toast.fire({
                    icon: 'success',
                    title: '&nbsp&nbsp Visitante cadastrado(a) com sucesso.'
                });

                $('#form-visitor')[0].reset();
                $(".select2").val('').trigger('change');

            }

        },

        error: function (data) {
             Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro ao cadastrar.'
                    });
        }
    });
}

//================================[DELETAR VISITANTE]================================//
function delete_visitor(id) {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });

    bootbox.confirm({
        title: ' Deseja excluir esse(a) visitante?',
        message: '<strong>Essa operação não pode ser desfeita!</strong>',
        callback: function(confirmacao) {

            if (confirmacao)
            $.ajax({
                url:  "/visitor/delete/"+id,
                type: "GET",
                success: function(data) {
                   $("#table").DataTable().clear().draw(6);
                    Toast.fire({
                        icon: 'success',
                        title: '&nbsp&nbsp Visitante excluido.'
                    });

                },
                 error: function(data) {
                    Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro ao excluir.'
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
                label: 'Excluir',
                className: 'btn-danger'
            }

        }
    });
}

//================================[EDITAR EMPRESA]================================//
function edit_enterprise() {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });


    var data = {
        id: id.value,
        new_name: newName.value,
        new_phone: newPhone.value,
        new_address: newAddress.value,
    };


    if ( data.new_name == "" || data.new_phone == "" || data.new_address == ""  ){

        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Todos os campos devem estar preenchidos.'
        });

        return false;
    }

    if (data.new_phone.replace(/\D+/g, "").length < 11)
    {
        Toast.fire({
            icon: 'error',
            title: '&nbsp&nbsp Número de telefone incorreto.'
        });
        return false;
    }




    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/enterprise/edit',
        type: 'POST',
        data: data,
        dataType: 'text',
        success: function (data) {
            if (data == "error") {

                Toast.fire({
                icon: 'error',
                title: '&nbsp&nbsp Uma empresa com este nome já está cadastrada.'
             });
            } else {

                $("#enterprise_edit").modal('hide');
                $("#table").DataTable().clear().draw(6);
                Toast.fire({
                    icon: 'success',
                    title: '&nbsp&nbsp Empresa alterada com sucesso.'
                });

                $('#form-enterprise')[0].reset();

            }
        },

        error: function (data) {
             Toast.fire({
                        icon: 'error',
                        title: '&nbsp&nbsp Erro ao cadastrar.'
                    });
        }
    });
}






