@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', 'Añadir Evento')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-file-text"></i>
        Añadir Evento
    </h1>
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('events.store') }}" method="post">
                    @csrf
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Salón de eventos</label>
                                    <select name="events_room_id" class="select2" id="select-events_room_id" required>
                                        <option selected disabled value="">-- Seleccione el salón de eventos --</option>
                                        @foreach (\App\Models\EventsRoom::where('deleted_at', NULL)->get() as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Título del evento</label>
                                    <input type="text" name="name" class="form-control" placeholder="Conferencia de prensa" required>
                                </div>
                                <div class="col-md-12">
                                    <label>Descripción del evento</label>
                                    <textarea name="description" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label>Nombre del solicitante</label>
                                    <input type="text" name="applicant" class="form-control" placeholder="Dirección de sistemas" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Fecha del evento</label>
                                    <input type="date" name="date" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Hora de inicio</label>
                                    <input type="time" name="start" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Hora de inicio</label>
                                    <input type="time" name="finish" class="form-control" required>
                                </div>
                                <div id="alert-error"></div>
                            </div>
                        </div>
                        <div class="panel-footer text-right">
                            <button type="submit" class="btn btn-primary save">Guardar <i class="voyager-check"></i> </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function(){

        });
    </script>
@stop
