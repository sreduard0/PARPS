{{-- Perfil usuario --}}
<div class="modal fade" id="edit_app" tabindex="-1" role="dialog" aria-labelledby="add_app" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_userLabel">Editar aplicação</h5>
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
                                style="background: url('') center center;background-size:100%">
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle" src="{{ asset("$user_data->photoUrl") }}"
                                    alt="User Avatar">
                            </div>
                            <div class="card-footer">
                                <div class="description-block">
                                    <h3 class="widget-user-desc text-center"> {{ $user_data->rank->rankAbbreviation }}
                                        {{ $user_data->professionalName }}</h3>
                                    <h4 class="widget-user-username text-center text-muted">
                                        {{ $user_data->departament->name }}</h4>
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
                                                Informações basicas</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-body">
                                                <div class="  float-l col-md-6">
                                                    <strong> Nome completo</strong>

                                                    <p class="text-muted">
                                                        teste
                                                    </p>

                                                    <hr>

                                                    <strong> Militar</strong>

                                                    <p class="text-muted">
                                                        {{ $user_data->rank->rankAbbreviation }}
                                                        {{ $user_data->militaryId }}
                                                        {{ $user_data->professionalName }}
                                                    </p>

                                                    <hr>

                                                    <strong>CIA</strong>

                                                    <p class="text-muted">
                                                        {{ $user_data->company->name }}
                                                    </p>


                                                </div>
                                                <div class=" float-r col-md-6">
                                                    <strong>IDT Militar</strong>

                                                    <p class="text-muted">
                                                        {{ $tools->mask('#########-#', $user_data->idt_mil) }}
                                                    </p>

                                                    <hr>

                                                    <strong>Dada de nascimento</strong>

                                                    <p class="text-muted">
                                                        {{ date('d/m/Y', strtotime($user_data->born_at)) }}
                                                    </p>

                                                    <hr>
                                                    <strong>Filiação</strong>

                                                    <p class="text-muted">
                                                        <strong>MÃE:</strong> {{ $user_data->motherName }} <br>
                                                        <strong>PAI:</strong> {{ $user_data->fatherName }}
                                                    </p>

                                                </div>




                                            </div>
                                        </div>
                                    </div>
                                    <div class="card ">
                                        <div class="card-header">
                                            <h3 class="card-title card-title-background"> <i
                                                    class="fas fa-map-marker-alt mr-1"></i>
                                                Endereço</h3>
                                        </div>

                                        <div class="card-body">
                                            <div class=" float-l col-md-6">
                                                <strong>Logradouro</strong>

                                                <p class="text-muted">
                                                    {{ $user_data->street . ', N°' . $user_data->house_number }}
                                                </p>

                                                <hr>

                                                <strong> Bairro</strong>

                                                <p class="text-muted">
                                                    {{ $user_data->district }}
                                                </p>

                                            </div>
                                            <div class=" float-r col-md-6">

                                                <strong>Cidade</strong>

                                                <p class="text-muted">
                                                    @if (isset($user_data->city->name) && isset($user_data->city->state))
                                                        {{ $user_data->city->name . ', ' . $user_data->city->state }}
                                                    @endif
                                                </p>

                                                <hr>

                                                <strong>CEP</strong>

                                                <p class="text-muted">
                                                    {{ $user_data->cep }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title card-title-background"> <i
                                                    class="fas fa-id-badge mr-1"></i>
                                                Contato</h3>
                                        </div>

                                        <div class="card-body">

                                            <div class=" float-l col-md-6">
                                                <strong>Telefone</strong>

                                                <p class="text-muted">
                                                    <strong>Fone 1</strong>
                                                    {{ $tools->mask('(##) # ####-####', $user_data->phone1) }}<br>
                                                    <strong>Fone 2</strong>
                                                    {{ $tools->mask('(##) # ####-####', $user_data->phone2) }}
                                                </p>

                                            </div>
                                            <div class=" float-r col-md-6">

                                                <strong>E-mail</strong>

                                                <p class="text-muted">
                                                    {{ $user_data->email }}
                                                </p>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button onclick="" class="btn btn-success">Atualizar</button>

            </div>
        </div>
    </div>
</div>
<script>
    $('#edit_app').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        var url = 'http://sistao.3bsup.eb.mil.br/apps/info/5';
        $.get(url, function(result) {
            modal.find('.modal-title').text('Editar ' + result.name)
            modal.find('#id').val(result.id)
            modal.find('#abbreviationApp').val(result.name)
            modal.find('#fullname').val(result.fullName)
            modal.find('#applink').val(result.link)
            modal.find('#input_user').val(result.inputUser)
            modal.find('#input_pass').val(result.inputPass)
            if (result.special == 1) {
                $("#pspecial1").prop("checked", true);
            } else if (result.special == 2) {
                $("#pspecial2").prop("checked", true);
            } else if (result.special == null) {
                $("#pspecial3").prop("checked", true);
            } else if (result.special == 3) {
                $("#pspecial4").prop("checked", true);
            }
        })
    });
</script>
