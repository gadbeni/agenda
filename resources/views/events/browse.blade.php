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

    {{-- Single delete modal --}}
    <form action="#" id="create_form" method="POST">
        <div class="modal modal-info fade" tabindex="-1" id="create_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-calendar"></i> Agregar evento</h4>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="start">
                        <input type="hidden" name="finish">
                        <input type="hidden" name="all_day">
                        <div class="form-group">
                            <label for="name">Título</label>
                            <input type="text" name="name" class="form-control" placeholder="Conferencia de prensa" required />
                        </div>
                        <div class="form-group">
                            <label for="name">Descripción</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="name">Lugar</label>
                            <input type="text" name="place" class="form-control" placeholder="" required />
                        </div>
                        <div class="form-group">
                            <label for="name">Solicitante</label>
                            <input type="text" name="applicant" class="form-control" placeholder="" required />
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
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
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
                    $('#create_modal input[name="start"]').val(start);
                    $('#create_modal input[name="finish"]').val(finish);
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
                
                events: [
                    {
                        id: 1,
                        title: 'All Day Event',
                        start: new Date(y, m, 1)
                    },
                    {
                        id: 2,
                        title: 'Repeating Event',
                        start: new Date(y, m, d-3, 16, 0),
                        allDay: false,
                        className: 'info'
                    },
                    {
                        id: 3,
                        title: 'Repeating Event',
                        start: new Date(y, m, d+4, 16, 0),
                        allDay: false,
                        className: 'info'
                    },
                    {
                        id: 4,
                        title: 'Meeting',
                        start: new Date(y, m, d, 10, 30),
                        allDay: false,
                        className: 'important'
                    },
                    {
                        id: 5,
                        title: 'Lunch',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 14, 0),
                        allDay: false,
                        className: 'important'
                    },
                    {
                        id: 6,
                        title: 'Birthday Party',
                        start: new Date(y, m, d+1, 19, 0),
                        end: new Date(y, m, d+1, 22, 30),
                        allDay: false,
                    },
                    {
                        id: 7,
                        title: 'Click for Google',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        url: 'https://ccp.cloudaccess.net/aff.php?aff=5188',
                        className: 'success'
                    }
                ],			
            });

            $('#create_form').on('submit', function(e){
                e.preventDefault();
                let form = $('#create_form').serialize();
                let name = $('#create_form input[name="name"]').val();
                let start = $('#create_form input[name="start"]').val();
                let finish = $('#create_form input[name="finish"]').val();
                let allDay = $('#create_form input[name="all_day"]').val();
                let url = "{{ route('events.store') }}";
                calendar.fullCalendar('renderEvent', {
                        id: 200,
                        title: name,
                        start: start,
                        end: finish,
                        allDay: allDay
                    },
                    true // make the event "stick"
                );
                calendar.fullCalendar('unselect');
                $('#create_modal').modal('hide');
            })
	    });
    </script>
@stop
