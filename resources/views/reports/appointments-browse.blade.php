@extends('voyager::master')

@section('page_title', 'Reporte de Agenda Eventos')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="voyager-logbook"></i> Reporte de Agenda Eventos
                </h1>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form id="form-report" name="fomr" action="{{ route('reports.appointments.generate') }}" method="POST">
                            @csrf
                            <input type="hidden" name="pdf">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Datos del reporte</label>
                                    <select name="assistant_id" class="form-control select2">
                                        <option value="">Todos los asistentes</option>
                                        @foreach (\App\Models\Assistant::where('deleted_at', NULL)->get() as $item)
                                            <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    {{-- <label>Rango de tiempo</label> --}}
                                    <div class="input-group">
                                        <input type="date" name="start" class="form-control" value="{{ date('Y-m-d') }}" required>
                                        <span class="input-group-btn">
                                            <input type="date" name="finish" class="form-control" value="{{ date('Y-m-d') }}" required>
                                            {{-- <button class="btn btn-default" style="margin: -1px" type="submit">Generar <span class="voyager-settings"></span></button> --}}
                                        </span>
                                    </div>
                                    <small class="text-muted">Ingrese el rango de fecha del reporte</small>
                                    <div class="text-right">
                                        <button class="btn btn-success" type="submit">Generar <span class="voyager-settings"></span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div id="details-list"></div>

        </div>
    </div>
@stop()

@section('css')

@stop

@section('javascript')
    <script>
        $(document).ready(function(){
            $('#form-report').on('submit', function(e){
                if($('#form-report').prop('target') != '_blank'){
                    e.preventDefault();
                    let form = $(this);
                    $.post(form.attr('action'), form.serialize(), function(res){
                        $('#details-list').html(res);
                    })
                }
            });
        })

        function generate_pdf(){
            $('#form-report input[name="pdf"]').val(1);
            $('#form-report').attr('target', '_blank');
            $('#form-report').submit();
            // Reset datos auxiliares
            $('#form-report').attr('target', '_selft');
            $('#form-report input[name="pdf"]').val('');
        }
    </script>
@stop