@extends('voyager::master')

@section('page_title', 'Viendo  Calendario de Eventos')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="voyager-calendar"></i> Calendario de Eventos
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
                        <div id='wrap'>
                            <div id='calendar'></div>
                            <div style='clear:both'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal create --}}
    <form action="{{ route('appointments.store') }}" id="create_form" method="POST">
        <div class="modal modal-info fade" tabindex="-1" id="create_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-calendar"></i> Agregar evento</h4>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="input-start">
                        <input type="hidden" id="input-finish">
                        <input type="hidden" name="start">
                        <input type="hidden" name="finish">
                        <input type="hidden" name="all_day">
                        {{-- <input type="hidden" name="ajax" value="1"> --}}
                        <div class="form-group">
                            <label for="name">Título</label>
                            <input type="text" name="topic" class="form-control" placeholder="Conferencia de prensa" required />
                        </div>
                        <div class="form-group">
                            <label for="name">Descripción</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="name">Lugar del evento</label>
                            <input type="text" name="place" class="form-control" placeholder="" required />
                        </div>
                        <div class="form-group">
                            <label for="name">Solicitante</label>
                            <input type="text" name="applicant" class="form-control" placeholder="" required />
                        </div>
                        <div class="form-group">
                            <label for="name">Asitente</label>
                            <select name="assistant_id" class="form-control select2" required>
                                <option value="">-- Seleccione al asistente al evento --</option>
                                @foreach (\App\Models\Assistant::where('deleted_at', NULL)->get() as $item)
                                    <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
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
                    <h4 class="modal-title"><i class="voyager-calendar"></i> Viendo evento</h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-bordered" style="padding-bottom:5px;">
                        <div class="row">
                            <div class="col-md-12" style="margin: 0px">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h4 class="panel-title">Nombre del evento</h4>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p id="label-topic">Value</p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-12" style="margin: 0px">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h4 class="panel-title">Descripción</h4>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p id="label-description">Value</p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-12" style="margin: 0px">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h4 class="panel-title">Lugar</h4>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p id="label-place">Value</p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-12" style="margin: 0px">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h4 class="panel-title">Solicitante</h4>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p id="label-applicant">Value</p>
                                </div>
                                <hr style="margin:0;">
                            </div>
                            <div class="col-md-6" style="margin: 0px">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h4 class="panel-title">Hora de inicio</h4>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p id="label-start"></p>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin: 0px">
                                <div class="panel-heading" style="border-bottom:0;">
                                    <h4 class="panel-title">Hora de finalización</h4>
                                </div>
                                <div class="panel-body" style="padding-top:0;">
                                    <p id="label-finish"></p>
                                </div>
                            </div>
                        </div>
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
            width: 100%;
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
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(async function() {
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

            let request = await fetch('{{ url("admin/appointments/ajax/list") }}')
                                .then(response => response.json())
                                .then(res => res);
            let events = [];
            request.reg.map(event => {
                let start = new Date(event.start);
                let end = new Date(event.finish);
                let allDay = start.getHours() == 0 && end.getHours() == 0 ? true : false;

                events.push({
                    id: event.id,
                    title: event.topic,
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
                firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
                selectable: true,
                defaultView: 'month',
                
                axisFormat: 'h:mm',
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
	    });

        async function getInfo(id){
            console.log(id)
            let { appointment } = await fetch('{{ url("admin/appointments/") }}/'+id)
                                .then(response => response.json())
                                .then(res => res);
                 console.log(appointment)               
            $('#view_modal').modal('show');
            $('#label-topic').text(appointment.topic);
            $('#label-description').text(appointment.description ? appointment.description : 'No definido');
            $('#label-place').text(appointment.place);
            $('#label-applicant').text(appointment.applicant);

            let start = new Date(appointment.start);
            let finish = new Date(appointment.finish);
            let allDay = start.getHours() == 0 && finish.getHours() == 0 ? true : false;
            if(allDay){
                $('#label-start').text('No definida');
                $('#label-finish').text('No definida');
            }else{
                $('#label-start').text(moment(start).format('h:mm a'));
                $('#label-finish').text(moment(finish).format('h:mm a'));
            }
        }
    </script>
@stop
