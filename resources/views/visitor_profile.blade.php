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
                                <img id="img_profile" class="img-circle" src="{{ asset('img/people.png') }}">
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

                                                    <p id="phone" class="text-muted"></p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title card-title-background "> <i
                                                    class="fas fa-user mr-1"></i>
                                                Empresa</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-body">
                                                <div class="  float-l col-md-6">

                                                    <strong> Nome</strong>

                                                    <p id="enterprise" class="text-muted"></p>
                                                    <hr>
                                                    <strong>Endereço</strong>

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
<script>
    $('#visitor_profile').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        var url = location + 'get_profile/' + id;
        $.get(url, function(result) {
            modal.find('#img_profile').attr("src", result.photo)
            modal.find('#visitor_name').text(result.name)
            modal.find('#enterprise_name').text(result.enterprise.name)
            modal.find('#fullname').text(result.name)
            modal.find('#cpf').text(result.cpf)
            modal.find('#phone').text(result.phone)
            modal.find('#enterprise_address').text(result.enterprise.address)
            modal.find('#enterprise_phone').text(result.enterprise.phone)
            modal.find('#enterprise').text(result.enterprise.name)
            if (result.cnh == 1) {
                modal.find('#cnh').text('Este motorista tem CNH')
            } else {
                modal.find('#cnh').text('Este motorista não tem CNH')
            }
        })
    });
</script>
