@extends('voyager::master')

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12 div-phone">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Eventos del día</h2>
                            </div>
                            <div class="col-md-12 text-right">
                                <input type="date" name="" class="form-control input-lg" id="input-date" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div id="table-details"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function(){
            let start = $('#input-date').val();
            getData(start);

            $('#input-date').change(function(){
                let start = $(this).val();
                getData(start);
            });
        });

        function getData(start){
            let url = "{{ url('admin/index/details') }}/"+start;
            $.get(url, function(res){
                $('#table-details').html(res);
            });
        }
    </script>
@stop
