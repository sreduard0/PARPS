@extends('layout')
@section('title', 'Empresas')
@section('register_open', 'menu-open')
@section('register', 'active')
@section('enterprise', 'active')
@section('title-header', 'Empresas')
@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection
@section('content')
    <section class="col ">
        <div class="card">
            <div class="card-header">
                <button class="float-r btn btn-success" data-toggle="modal" data-target="#register">Nova
                    empresa</button>

            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="15">#</th>
                            <th>Nome</th>
                            <th width="100">telefone</th>
                            <th>Endereço</th>
                            <th width="25">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>CAT</td>
                            <td>(51) 3479-2000</td>
                            <td>Av. Santa Rita, N° 555, Nova Santa Rita, RS</td>
                            <td>
                                <button class="btn btn-danger" title="Excluir empresa"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

    </section>
@endsection
@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="registerLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerLabel">Cadastrar empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#">
                        <div class="row">

                            <div class="form-group col">
                                <label>Empresa</label>
                                <input type="text" class="form-control" name="enterprise" id="enterprise"
                                    placeholder="Nome da empresa">
                            </div>

                            <div class="col-md-3 form-group ">
                                <label for="phone">Telefone</label>
                                <input type="text" class="form-control" data-inputmask="'mask': ['(99) 9 9999-9999']"
                                    inputmode="text" data-mask="" id="phone" name="phone" placeholder="Telefone" value="">
                            </div>
                        </div>
                        <hr>
                        <label class="fs-23">Endereço</label>
                        <div class="row">
                            <div class="form-group col">
                                <label for="street">Logradouro</label>
                                <input type="text" class="form-control" id="street" name="street" placeholder="Logradouro"
                                    value="">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="house_number">Nº</label>
                                <input type="text" class="form-control" id="number" name="number" placeholder="Nº">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="district">Bairro</label>
                                <input type="text" id="district" name="district" class="form-control"
                                    placeholder="Bairro">
                            </div>
                            <div class="form-group col">
                                <label for="city">Cidade</label>
                                <input type="text" id="city" name="city" class="form-control" placeholder="Cidade">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('plugins')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/numeric-comma.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/list_portuguese.js') }}"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2({
                dropdownParent: $("#register")
            });
            $('[data-mask]').inputmask()
        })
    </script>
@endsection
