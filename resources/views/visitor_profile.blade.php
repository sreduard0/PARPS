@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('script')
    <script src="{{ asset('js/croppie.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/croppie.css') }}" />
@endsection
{{-- Perfil usuario --}}
<div class="modal fade" id="visitor_profile" tabindex="-1" role="dialog" aria-labelledby="visitor_profile"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="visitor_profileLabel">Perfil do visitante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <section class="content">
                    <div class="container-fluid">
                        <div class="card card-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header text-white"
                                style="background: url('{{ asset('img/bg-visitors.png') }}') center center;background-size:100%">
                            </div>
                            <div class="widget-user-image">
                                <img id="edit_img" class="img-circle" src="{{ asset('img/people.png') }}"
                                    alt="User Avatar">
                                <div class="panel-body">
                                    <label for="upload_new_image" class="btn btn-success edit-img-profile"><i
                                            class="fa fa-pen"></i></label>
                                    <input type="file" class="btn btn-success input-img-profile" name="upload_new_image"
                                        id="upload_new_image" accept="image/png,image/jpg,image/jpeg" />
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="description-block">
                                    <h3 id="visitor_name" class="widget-user-desc text-center">
                                        Nome</h3>
                                    <h4 id="enterprise_name" class="widget-user-username text-center text-muted">
                                        Empresa </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title card-title-background "> <i
                                                    class="fas fa-user mr-1"></i>
                                                Informações pessoais</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-body">
                                                <input type="hidden" id="id" value="">
                                                <input type="hidden" id="enterprise_id" value="">
                                                <div class="  float-l col-md-6">
                                                    <strong> Nome completo</strong>

                                                    <p id="fullname" class="text-muted"></p>

                                                    <hr>

                                                    <strong>CNH</strong>

                                                    <p id="cnh" class="text-muted"></p>

                                                </div>
                                                <div class=" float-r col-md-6">
                                                    <strong>CPF</strong>

                                                    <p id="cpf" class="text-muted"></p>

                                                    <hr>

                                                    <strong>Contato</strong>

                                                    <p id="phone_visitor" class="text-muted"></p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title card-title-background "> <i
                                                    class="fas fa-user mr-1"></i>
                                                Empresa</h3>
                                            <button class="btn c-w float-r" onclick="return editenterprise()"><i
                                                    class="fa fa-pen"></i></button>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-body">
                                                <div class="  float-l col-md-6">

                                                    <strong> Nome</strong>

                                                    <p id="enterprise" class="text-muted"></p>
                                                    <hr>
                                                    <strong>Contato</strong>

                                                    <p id="enterprise_phone" class="text-muted"></p>


                                                </div>
                                                <div class=" float-r col-md-6">
                                                    <strong>Endereço</strong>

                                                    <p id="enterprise_address" class="text-muted"></p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal de envio de imagem --}}
<div id="uploanewdimage" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajustar imagem</h4>
            </div>
            <div class="modal-body">
                <div id="image_prev"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button class="btn btn-success crop_new_image">Enviar</button>
            </div>
        </div>
    </div>
</div>
{{-- SCRIPTS --}}
<script>
    $('#visitor_profile').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        if (id == undefined) {
            id = $('#id').val();
        }

        var modal = $(this);
        var url = '/get_profile/' + id;
        $.get(url, function(result) {
            modal.find('#edit_img').attr("src", result.photo)
            modal.find('#visitor_name').text(result.name)
            modal.find('#enterprise_name').text(result.enterprise.name)
            modal.find('#fullname').text(result.name)
            modal.find('#cpf').text(result.cpf)
            modal.find('#phone_visitor').text(result.phone)
            modal.find('#enterprise_address').text(result.enterprise.address)
            modal.find('#enterprise_phone').text(result.enterprise.phone)
            modal.find('#enterprise').text(result.enterprise.name)
            document.getElementById("id").value = id
            document.getElementById("enterprise_id").value = result.enterprise.id
            if (result.cnh == 1) {
                modal.find('#cnh').text('Este motorista tem CNH')
            } else {
                modal.find('#cnh').text('Este motorista não tem CNH')
            }
        })
    });
</script>

<script>
    function editenterprise() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000
        });

        var url = '/enterprises_json';
        var enterprise_id = $('#enterprise_id').val();
        $('#visitor_profile').modal('hide');
        $.get(url, function(result) {
            bootbox.prompt({
                title: "Selecione a empresa.",
                inputType: 'select',
                centerVertical: true,
                value: enterprise_id,
                buttons: {
                    confirm: {
                        label: 'Editar',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'cancelar',
                        className: 'btn-secondary'
                    }
                },
                inputOptions: result,
                callback: function(result) {
                    if (result) {
                        var data = {
                            id: $('#id').val(),
                            enterprise_id: result
                        };
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/edit_enterprise_visitor',
                            type: 'POST',
                            data: data,
                            dataType: 'text',
                            success: function(data) {
                                $("#table").DataTable().clear().draw(6);
                                Toast.fire({
                                    icon: 'success',
                                    title: '&nbsp&nbsp Empresa alterad com sucesso.'
                                });
                                $('#visitor_profile').modal('show');
                            },

                            error: function(data) {
                                Toast.fire({
                                    icon: 'error',
                                    title: '&nbsp&nbsp Erro ao alterar.'
                                });
                            }
                        });
                    }

                }
            });

        })
    }
</script>
<script src="{{ asset('js/crop-img-profile.js') }}"></script>
