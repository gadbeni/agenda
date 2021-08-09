@extends('voyager::master')

@section('page_title', 'Viendo  Calendario de Eventos')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8" style="margin-bottom: 0px">
                <h1 class="page-title">
                    <i class="voyager-calendar"></i> Calendario de Salón de Eventos
                </h1>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div id='wrap'>
                    <div id='calendar'></div>
                    <div style='clear:both'></div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal create --}}
    <form action="{{ route('events.store') }}" id="create_form" method="POST">
        <div class="modal modal-info fade" tabindex="-1" id="create_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-calendar"></i> Nuevo evento</h4>
                    </div>
                    <div class="modal-body">
                        @include('events.partials.form')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- modal view --}}
    <div class="modal modal-info fade" tabindex="-1" id="view_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-bordered" style="padding-bottom:5px;">
                        <div class="row" id="div-view">
                            <div class="col-md-12 text-right" style="margin: 0px">
                                <div class="btn-group" role="group" aria-label="...">
                                    <button type="button" class="btn btn-primary btn-sm btn-edit"><i class="voyager-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm btn-delete"><i class="voyager-trash"></i></button>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin: 0px">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h4 class="panel-title" style="padding-bottom: 10px">Nombre del evento</h4>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p id="label-name"></p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-12" style="margin: 0px">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h4 class="panel-title" style="padding-bottom: 10px">Descripción</h4>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p id="label-description"></p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-12" style="margin: 0px">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h4 class="panel-title" style="padding-bottom: 10px">Lugar</h4>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p id="label-place"></p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-12" style="margin: 0px">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h4 class="panel-title" style="padding-bottom: 10px">Solicitante</h4>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p id="label-applicant"></p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-6" style="margin: 0px">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h4 class="panel-title" style="padding-bottom: 10px">Hora de inicio</h4>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p id="label-start"></p>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin: 0px">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h4 class="panel-title" style="padding-bottom: 10px">Hora de finalización</h4>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p id="label-finish"></p>
                                </div>
                            </div>
                        </div>

                        {{-- Form edit --}}
                        <form id="form-edit" action="#" method="POST">
                            @method('PUT')
                            <div id="div-edit" style="display: none">
                                @include('events.partials.form')
                                <div class="row">
                                    <div class="col-md-12 text-right" style="margin-top: 10px; margin-bottom: 10px">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        {{-- Form delete --}}
                        <form id="form-delete" action="#" method="POST">
                            @method('DELETE')
                            @csrf
                            <div id="div-delete" style="display: none">
                                <p class="text-muted">Desea elimianr el siguiente evento de la agenda?</p>
                                <div class="row">
                                    <div class="col-md-12 text-right" style="margin-top: 10px; margin-bottom: 10px">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div> --}}
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <style> 
        #wrap {
            width: 80%;
            margin: 0 auto;
            overflow: auto;
            }
            
        #external-events {
            float: left;
            width: 150px;
            padding: 0 10px;
            text-align: left;
            }
            
        #external-events h4 {
            font-size: 16px;
            margin-top: 0;
            padding-top: 1em;
            }
            
        .external-event { /* try to mimick the look of a real event */
            margin: 10px 0;
            padding: 2px 4px;
            background: #3366CC;
            color: #fff;
            font-size: .85em;
            cursor: pointer;
            }
            
        #external-events p {
            margin: 1.5em 0;
            font-size: 11px;
            color: #666;
            }
            
        #external-events p input {
            margin: 0;
            vertical-align: middle;
            }
    
        #calendar {
        /*  float: right; */
            margin: 0 auto;
            width: 1024;
            background-color: #FFFFFF;
              border-radius: 6px;
            box-shadow: 0 1px 2px #C3C3C3;
            -webkit-box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
            -moz-box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
            box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
            }
    
    </style>
@stop

@section('javascript')
    <script src="{{ asset('js/calendar.js') }}"></script>
    <script src="{{ asset('vendor/moment.js/moment.js') }}"></script>
    <script src="{{ asset('vendor/moment.js/moment-with-locales.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(async function() {
            moment.locale("es");
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            
            /*  className colors
            className: default(transparent), important(red), chill(pink), success(green), info(blue)
            */		
            
            /* initialize the external events
            -----------------------------------------------------------------*/
            $('#external-events div.external-event').each(function() {
            
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };
                
                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);
                
                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });
                
            });
            /* initialize the calendar
            -----------------------------------------------------------------*/

            let request = await fetch('{{ url("admin/events/ajax/list") }}')
                                .then(response => response.json())
                                .then(res => res);
            let events = [];
            request.reg.map(event => {
                let start = new Date(event.start);
                let end = new Date(event.finish);
                let allDay = start.getHours() == 0 && end.getHours() == 0 ? true : false;

                events.push({
                    id: event.id,
                    title: event.name,
                    start, end,
                    allDay,
                    className: 'important'
                });
            });
            
            var calendar =  $('#calendar').fullCalendar({
                header: {
                    left: 'title',
                    center: 'agendaDay,agendaWeek,month',
                    right: 'prev,next today'
                },
                editable: true,
                firstDay: 0, //  1(Monday) this can be changed to 0(Sunday) for the USA system
                selectable: true,
                defaultView: 'month',
                
                axisFormat: 'HH:mm',
                columnFormat: {
                    month: 'ddd',    // Mon
                    week: 'ddd d', // Mon 7
                    day: 'dddd M/d',  // Monday 9/7
                    agendaDay: 'dddd d'
                },
                titleFormat: {
                    month: 'MMMM yyyy', // September 2009
                    week: "MMMM yyyy", // September 2009
                    day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
                },
                allDaySlot: false,
                selectHelper: true,
                select: function(start, finish, allDay) {
                    $('#create_modal').modal('show');
                    $('#input-start').val(start);
                    let startAlt = moment(start).format('YYYY-MM-DD HH:mm:ss');
                    $('#create_modal input[name="start"]').val(startAlt);
                    
                    $('#input-finish').val(finish);
                    let finishAlt = moment(finish).format('YYYY-MM-DD HH:mm:ss');
                    $('#create_modal input[name="finish"]').val(finishAlt);

                    $('#create_modal input[name="all_day"]').val(allDay);
                },
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function(date, allDay) { // this function is called when something is dropped
                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');
                    
                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);
                    
                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
                    
                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                    
                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }
                    
                },
                events
            });

            // Edita event
            $('.btn-edit').click(function(){
                $('#div-view').fadeOut('fast', () => $('#div-edit').fadeIn());
                let event = $('#view_modal .btn-edit').data('event');
                $('#form-edit input[name=name]').val(event.name);
                $('#form-edit textarea[name=description]').val(event.description);
                $('#form-edit input[name=applicant]').val(event.applicant);
                $('#form-edit select[name=events_room_id]').val(event.events_room.id);

                let url = "{{ url('admin/events') }}/"+event.id;
                $('#form-edit').attr('action', url);
            });

            // Eliminar event
            $('.btn-delete').click(function(){
                $('#div-view').fadeOut('fast', () => $('#div-delete').fadeIn());
                let event = $('#view_modal .btn-delete').data('event');
                let url = "{{ url('admin/events') }}/"+event.id;
                $('#form-delete').attr('action', url);
            });
	    });

        async function getInfo(id){
            $('#div-edit').fadeOut('fast', () => $('#div-view').fadeIn());
            $('#div-delete').fadeOut('fast')
            let { event } = await fetch('{{ url("admin/events/") }}/'+id)
                                .then(response => response.json())
                                .then(res => res);
            $('#view_modal .btn-edit').data('event', event);
            $('#view_modal .btn-delete').data('event', event);
            $('#view_modal').modal('show');
            $('#label-name').text(event.name);
            $('#label-description').text(event.description ? event.description : 'No definida');
            $('#label-place').text(event.events_room.name);
            $('#label-applicant').text(event.applicant);

            let start = new Date(event.start);
            let finish = new Date(event.finish);
            let allDay = start.getHours() == 0 && finish.getHours() == 0 ? true : false;
            $('#view_modal .modal-title').html(`<i class="voyager-calendar"></i> ${moment(start).format('dddd, DD [de] MMMM [de] YYYY')}`);
            if(allDay){
                $('#label-start').text('No definida');
                $('#label-finish').text('No definida');
            }else{
                $('#label-start').text(moment(start).format('h:mm a'));
                $('#label-finish').text(moment(finish).format('h:mm a'));
            }
        }

        function editDateEvent(event){
            let id = event.id;
            let form = {
                start: moment(event.start).format('YYYY-MM-DD HH:mm:ss'),
                finish: event.end ? moment(event.end).format('YYYY-MM-DD HH:mm:ss') : moment(event.start).format('YYYY-MM-DD HH:mm:ss'),
                ajax: 1,
                _token: "{{ csrf_token() }}",
                _method: "PUT"
            }
            let url = "{{ url('admin/events') }}/"+id;
            $.post(url, form, function(res){
                if(res.success){
                    toastr.info(res.success, 'Bien hecho!');
                }else{
                    toastr.error(res.error, 'Oops!');
                }
            })
        }
    </script>
@stop
