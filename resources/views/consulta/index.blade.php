@extends('layouts.painel.main')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('title')
    Cadastrar Consulta
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Minhas Consultas</li>
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
                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" aria-sort="ascending" aria-label="ID" style="max-width: 10px;">
                            Consulta
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" aria-sort="ascending" aria-label="especialidade" style="max-width: 1px;">
                            Especialidade
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" aria-sort="ascending" aria-label="sintomas" style="max-width: 10px;">
                            Sintomas
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" aria-sort="ascending" aria-label="remedios" style="max-width: 10px;">
                            Remédios
                        </th>

                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" aria-sort="ascending" aria-label="editar" style="max-width: 5px;">
                            #
                        </th>
                    </tr>
                    </thead>
                    @foreach($consultas as $consulta)
                        <tbody>
                            <td>
                                #{{ $consulta->dataConsulta->format('Y') . $consulta->idConsulta . ' em ' . $consulta->dataConsulta->format('d/m/Y') . ' às ' . $consulta->dataConsulta->format('H:i') . 'h' }}
                            </td>
                            <td>{{ $consulta->especialidade->nomeEspecialidade }}</td>
                            <td>
                                @foreach($consulta->sintomas as $sintoma)
                                    <span class="badge badge-warning">
                                        {{ $sintoma->nomeSintoma }}
                                    </span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($consulta->remedios as $remedio)
                                    <span class="badge badge-warning">
                                        {{ $remedio->nomeRemedio }}
                                    </span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('consulta.show', $consulta->idConsulta) }}">
                                    <button class="btn btn-sm btn-primary">
                                        <span class="fa fa-eye"></span> Ver Consulta
                                    </button>
                                </a>
                            </td>
                        </tbody>
                    @endforeach
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
@endsection
