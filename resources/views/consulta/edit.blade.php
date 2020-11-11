@extends('layouts.painel.main')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
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

            </div>
        </div>
    </div>
@endsection

@section('js')
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
