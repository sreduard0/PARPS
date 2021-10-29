@extends('layout')
@section('title', 'Relatórios')
@section('reports_open', 'menu-open')
@section('reports', 'active')
@section('reports_date', 'active')
@section('title-header', 'Relatório por datas')
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
                <div class="row">
                    <div class="col">
                        {{-- Date inicial --}}
                        <div class="form-group ">
                            <label>Data inicial:</label>
                            <div class="input-group date" id="date1" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#date1" />
                                <div class="input-group-append" data-target="#date1" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        {{-- date --}}
                    </div>
                    <div class="col">
                        {{-- Date final --}}
                        <div class="form-group">
                            <label>Data final:</label>
                            <div class="input-group date" id="date2" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#date2" />
                                <div class="input-group-append" data-target="#date2" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                        {{-- date --}}
                    </div>
                    <div class="col">
                        <button class="m-t-32 btn btn-success"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="15">#</th>
                            <th>Nome</th>
                            <th>Empresa</th>
                            <th>Destino</th>
                            <th width="">Motivo</th>
                            <th width="20">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Jose Pinto</td>
                            <td>CAT</td>
                            <td>Não</td>
                            <td>cia</td>
                            <td>
                                <button class="btn btn-primary" title="Ver perfil do visitante"><i
                                        class="fa fa-user"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Lula Innacio</td>
                            <td>CAT</td>
                            <td>cia</td>
                            <td>Sim</td>
                            <td>
                                <button class="btn btn-primary" title="Ver perfil do visitante"><i
                                        class="fa fa-user"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

    </section>
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
    <!-- InputMask -->
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script>
        $(function() {
            //Date picker
            $('#date1').datetimepicker({
                format: 'L'
            });

            $('#date2').datetimepicker({
                format: 'L'
            });
        })
    </script>


@endsection
