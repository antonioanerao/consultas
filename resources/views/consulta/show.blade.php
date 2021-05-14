@extends('layouts.painel.main')

@section('css')
    {{ Html::style('https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css') }}
    {{ Html::script('https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js') }}
    <script type="text/javascript">
        $(document).ready( function () {
            $('#tabelaOcorrencia').DataTable();
        } );
    </script>
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
                    <a href="{{ route('consulta.edit', $consulta->idConsulta) }}">
                        <span class="pull-right badge badge-warning"><span class="fa fa-edit"></span> EDITAR CONSULTA</span>
                    </a>
                </h4>
                <hr> <br>

                <div class="row clearfix">
                    <div class="col-md-8">
                        <div class="card-box">
                            <h5 class="m-t-0 header-title">Informações Gerais</h5> <hr>
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
                            <h5 class="m-t-0 header-title">Sintomas</h5> <hr>
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
@endsection
