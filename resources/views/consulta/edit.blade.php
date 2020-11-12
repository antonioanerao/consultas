@extends('layouts.painel.main')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('title')
    Cadastrar Consulta
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('consulta.index') }}">Consultas</a></li>
    <li class="breadcrumb-item active">Cadastrar</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title">Lista de Fatos</h4>
                <br>
                <table class="table align-center table-bordered table-striped table-hover js-basic-example dataTable" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" aria-sort="ascending" aria-label="ID" style="width: 20px;">
                            Consulta
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" aria-sort="ascending" aria-label="ID" style="width: 10px;">
                            Especialidade
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" aria-sort="ascending" aria-label="ID" style="width: 10px;">
                            Sintomas
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" aria-sort="ascending" aria-label="ID" style="width: 10px;">
                            Remédios
                        </th>

                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" aria-sort="ascending" aria-label="ID" style="width: 10px;">
                            #
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                        <td>{{ $consulta->conteudoConsulta }}</td>
                        <td>{{ $consulta->especialidade->nomeEspecialidade }}</td>

                        <td>
                            @foreach($consulta->sintomas as $sintoma)
                                {{ $sintoma->nomeSintoma }}
                            @endforeach
                        </td>

                        <td>
                            @foreach($consulta->remedios as $remedios)
                                {{ $remedios->nomeRemedio }} /
                            @endforeach
                        </td>

                        <td></td>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-pt_BR.min.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('dashboard/assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ asset('dashboard/assets/bundles/mainscripts.bundle.js') }}"></script>

    <script type="text/javascript">
        //Adicionar Especialidade
        $(document).ready(function () {
            $('#add-especialidade').on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('especialidade.store') }}",
                    data: $('#add-especialidade').serialize(),
                    success: function (response) {
                        console.log(response)
                        $('#adicionar-especialidade').modal('hide');
                        limparCampoEspecialidade();
                        alert("Especialidade adicionada com sucesso");
                    },
                    error: function(error){
                        console.log(error)
                        if(error.status == 422) {
                            alert('Essa especialidade já foi adicionada')
                        } else {
                            alert('Erro. Fale com o administrador')
                        }
                    }
                });
            });
            function limparCampoEspecialidade(){
                jQuery(function($){
                    $.get("{{ route('listaEspecialidadeJson') }}", function(data) {
                        console.log(data);
                        $("#idEspecialidade").empty();
                        for (index in data) {
                            $('#idEspecialidade').append('<option value="'+data[index].idEspecialidade+'">'+data[index].nomeEspecialidade+'</option>');
                        }
                        $("#idEspecialidade").selectpicker('refresh');
                    });
                });
            }
        });

        //Adicionar Sintoma
        $(document).ready(function () {
            $('#add-sintoma').on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('sintoma.store') }}",
                    data: $('#add-sintoma').serialize(),
                    success: function (response) {
                        console.log(response)
                        $('#adicionar-sintoma').modal('hide');
                        limparCampoSintoma();
                        alert("Sintoma adicionado com sucesso");
                    },
                    error: function(error){
                        console.log(error)
                        if(error.status == 422) {
                            alert('Esse sintoma já foi adicionado')
                        } else {
                            alert('Erro. Fale com o administrador')
                        }
                    }
                });
            });
            function limparCampoSintoma(){
                jQuery(function($){
                    $.get("{{ route('listaSintomaJson') }}", function(data) {
                        console.log(data);
                        $("#idSintoma").empty();
                        for (index in data) {
                            $('#idSintoma').append('<option value="'+data[index].idSintoma+'">'+data[index].nomeSintoma+'</option>');
                        }
                        $("#idSintoma").selectpicker('refresh');
                    });
                });
            }
        });

        //Adicionar Remédio
        $(document).ready(function () {
            $('#add-remedio').on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('remedio.store') }}",
                    data: $('#add-remedio').serialize(),
                    success: function (response) {
                        console.log(response)
                        $('#adicionar-remedio').modal('hide');
                        limparCampoRemedio();
                        alert("Remédio adicionado com sucesso");
                    },
                    error: function(error){
                        console.log(error)
                        if(error.status == 422) {
                            alert('Esse remédio já foi adicionado')
                        } else {
                            alert('Erro. Fale com o administrador')
                        }
                    }
                });
            });
            function limparCampoRemedio(){
                jQuery(function($){
                    $.get("{{ route('listaRemedioJson') }}", function(data) {
                        console.log(data);
                        $("#idRemedio").empty();
                        for (index in data) {
                            $('#idRemedio').append('<option value="'+data[index].idRemedio+'">'+data[index].nomeRemedio+'</option>');
                        }
                        $("#idRemedio").selectpicker('refresh');
                    });
                });
            }
        });
    </script>
@endsection
