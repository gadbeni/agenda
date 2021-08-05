@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', ($type == 'create' ? 'Añadir' : 'Editar').' Asistente')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-people"></i> {{ ($type == 'create' ? 'Añadir' : 'Editar').' Asistente' }}
    </h1>
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ $type == 'create' ? route('assistants.store') : route('assistants.update', ['assistant' => $assistant->id]) }}" method="post">
                    @csrf
                    @if ($type == 'edit')
                        @method('PUT')
                        <input type="hidden" name="user_id" value="{{ $assistant->user ? $assistant->user->id : '' }}">
                    @endif
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Nombre completo</label>
                                    <input type="text" name="full_name" class="form-control" value="@if($type == 'edit'){{ $assistant->full_name }}@endif" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Cargo</label>
                                    <input type="text" name="detail" class="form-control" value="@if($type == 'edit'){{ $assistant->detail }}@endif" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input type="text" name="email_alt" class="form-control" value="@if($type == 'edit'){{ $assistant->email }}@endif" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Número de celular</label>
                                    <input type="text" name="phone" class="form-control" value="@if($type == 'edit'){{ $assistant->phone }}@endif" required>
                                </div>
                                <div class="col-md-12">
                                    <hr style="margin: 0px">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Usuario del sistema</label>
                                        <input type="text" name="email" class="form-control" value="@if($type == 'edit'){{ $assistant->user ? $assistant->user->email : '' }}@endif" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Contraseña</label>
                                    <input type="password" name="password" class="form-control" @if($type == 'create') required @endif>
                                    @if($type == 'edit') <small>Si no ingresa nada en el campo contraseña se mantiene la actual.</small> @endif
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-right">
                            <button type="submit" class="btn btn-primary">Guardar <i class="voyager-check"></i></button>
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
