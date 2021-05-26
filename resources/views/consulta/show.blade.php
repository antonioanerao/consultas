@extends('layouts.painel.main')

@section('css')
    {{ Html::style('https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css') }}
    {{ Html::script('https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js') }}
    <script type="text/javascript">
        $(document).ready( function () {
            $('#tabelaOcorrencia').DataTable();
        } );
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
@endsection

@section('title')
    Consulta #{{ $consulta->idConsulta }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('consulta.index') }}">Minhas Consultas</a></li>
    <li class="breadcrumb-item active">Consula #{{ $consulta->created_at->format('Y') . $consulta->idConsulta }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title">
                    Consulta com #{{ $consulta->especialidade->nomeEspecialidade }}
                </h4>
                <hr> <br>

                <div class="row clearfix">
                    <div class="col-md-8">
                        <div class="card-box">
                            <h5 class="m-t-0 header-title">
                                Informações Gerais
                                <button type="button" class="btn btn-warning btn-sm badge" data-toggle="modal" data-target="#update-info-gerais">
                                    <i class="fa fa-edit"></i> [EDITAR]
                                </button>

                                <div id="update-info-gerais" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                {{ Form::open(['route'=>['consulta.update', $consulta->idConsulta]]) }}
                                                <label>Dados da consulta</label>
                                                <textarea name="conteudoConsulta" class="form-control" rows="12">{!! $consulta->conteudoConsulta !!}</textarea>

                                                <label></label>
                                                <button class="btn btn-primary btn-lg btn-block">
                                                    <i class="fa fa-refresh"></i> SALVAR ALTERAÇÕES
                                                </button>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.modal -->
                            </h5> <hr>
                            <textarea class="form-control" rows="12" disabled>{!! $consulta->conteudoConsulta !!}</textarea>
                        </div>

                        <div class="card-box">
                            <h5 class="m-t-0 header-title">Complementos da Consulta</h5> <hr>
                            <table class="table align-center table-bordered table-striped table-hover js-basic-example dataTable display" id="tabelaOcorrencia" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                <tr role="row">
                                    <th>Complemento</th>
                                    <th>Data de cadastro</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($consulta->complementos as $complemento)
                                    <tr>
                                        <td>{{ $complemento->conteudoComplementoConsulta }}</td>
                                        <td>{{ $complemento->created_at->format('d/m/Y à\s h:i:s') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#remover-complemento-{{ $complemento->id }}">
                                                <i class="fa fa-trash-o"></i> Remover
                                            </button>
                                            <div id="remover-complemento-{{ $complemento->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title">
                                                                Remover Complemento
                                                            </h4>
                                                        </div>

                                                        <div class="modal-body">

                                                            <div class="alert alert-danger text-center">
                                                                <h5>
                                                                    {!! nl2br($complemento->conteudoComplementoConsulta) !!}
                                                                </h5>
                                                            </div>

                                                            <form action="{{ route('consulta.complemento.destroy', $complemento->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="form-group">
                                                                    {{ Form::button('<i class="fa fa-trash-o"></i> REMOVER', ['class'=>'btn btn-danger btn-lg btn-block', 'type'=>'submit'])  }}
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- /.modal -->
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <br>

                            <form method="post" action="{{ route('complemento.store', $consulta->idConsulta) }}">
                                {{ csrf_field() }} {{ method_field('POST') }}

                                <div class="form-group">
                                    <label>Novo Complemento</label>
                                    {!! Form::textarea('conteudoComplementoConsulta', null,  ['required', 'class' => 'form-control', 'id'=>'conteudoComplementoConsulta' ]) !!}
                                    @if($errors->has('conteudoComplementoConsulta'))
                                        <br><span class="help-block has-error"><span style="color: red; ">Informe o conteudo da consulta</span></span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary btn-lg btn-block text-center">
                                        <i class="fa fa-plus"></i> Cadastrar Complemento
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card-box">
                            <h5 class="m-t-0 header-title">
                                Sintomas
                                <button type="button" class="btn btn-success btn-sm badge" data-toggle="modal" data-target="#adicionar-sintomas">
                                    <i class="fa fa-plus"></i> [ADICIONAR]
                                </button>

                                <!-- Modal Adicionar Sintoms -->
                                <div id="adicionar-sintomas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Adicionar Novo Sintoma</h4>
                                            </div>


                                                <div class="modal-body">
                                                    <form  id="add-sintoma">
                                                        {{ csrf_field() }} {{ method_field('POST') }}

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="field-1" class="control-label">NOVO SINTOMA</label>
                                                                    <input type="text" required name="nomeSintoma" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Adicionar</button>

                                                    </form>

                                                    <hr>

                                                    {!! Form::open(['route'=>['associarSintomaConsulta', $consulta->idConsulta]]) !!}
                                                    <div class="form-group">
                                                        <b>{{ Form::label('idSintoma', 'Escolha ao menos um sintoma') }}</b>

                                                        {!! Form::select('idSintoma[]', $sintomas, null,  ['required', 'class' => 'form-control selectpicker dropup', 'multiple' => 'true', 'data-size'=>'8', 'data-live-search'=>'true', 'data-dropup-auto'=>'false', 'id'=>'idSintoma']) !!}
                                                        @if($errors->has('idSintoma'))
                                                            <br><span class="help-block has-error"><span style="color: red; ">Escolha ao menos um sintoma</span></span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-primary btn-lg btn-block text-center">
                                                            <i class="fa fa-plus"></i> CADASTRAR SINTOMAS
                                                        </button>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>


                                            <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Fechar</button>
                                                </div>

                                        </div>
                                    </div>
                                </div><!-- /.modal -->
                            </h5> <hr>
                            @foreach($consulta->sintomas as $sintomas)
                                <span class="badge badge-primary">{{ $sintomas->nomeSintoma }}</span>
                            @endforeach <hr> <br>

                            <h5 class="m-t-0 header-title">Remédios</h5> <hr>
                            @foreach($consulta->remedios as $remedios)
                                <span class="badge badge-warning">{{ $remedios->nomeRemedio }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Custom Js -->
    <script src="{{ url('assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ url('assets/plugins/tables/jquery-datatable.js') }}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('dashboard/assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-pt_BR.min.js"></script>

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
