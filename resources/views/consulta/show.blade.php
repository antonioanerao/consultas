@extends('layouts.painel.main')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}">
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

                    <div class="col-md-8">
                        <div class="card-box">
                            <h5 class="m-t-0 header-title">Informações Gerais</h5> <hr>
                            <textarea class="form-control" rows="12" disabled>{!! $consulta->conteudoConsulta !!}</textarea>
                        </div>
                    </div>
                </div>

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
@endsection
