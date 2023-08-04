<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

// Models
use App\Models\Appointment;
use App\Models\Event;

class ReportsController extends Controller
{
    public function appointments_index(){
        return view('reports.appointments-browse');
    }

    public function appointments_generate(Request $request){
        $query_assistant = $request->assistant_id ? 'id = '.$request->assistant_id : 1;
        $reg = Appointment::with('details.assistant')
                ->whereHas('details.assistant', function($q) use($query_assistant){
                    $q->whereRaw($query_assistant);
                })
                ->whereDate('start', '>=', $request->start)
                ->whereDate('finish', '<=', $request->finish)
                ->where('deleted_at', NULL)->orderBy('start')->get();

        $range = $this->get_range_date($request->start, $request->finish);
        if($request->pdf){
            $view = view('reports.appointments-pdf', compact('reg', 'range'));
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream();
        }else{
            return view('reports.appointments-list', compact('reg', 'range'));
        }
    }

    public function events_index(){
        return view('reports.events-browse');
    }

    public function events_generate(Request $request){
        $query_event_room = $request->events_room_id ? 'id = '.$request->events_room_id : 1;
        $reg = Event::with('events_room')
                ->whereHas('events_room', function($q) use($query_event_room){
                    $q->whereRaw($query_event_room);
                })
                ->whereDate('start', '>=', $request->start)
                ->whereDate('finish', '<=', $request->finish)
                ->where('deleted_at', NULL)->orderBy('start')->get();

        $range = $this->get_range_date($request->start, $request->finish);
        if($request->pdf){
            $view = view('reports.events-pdf', compact('reg', 'range'));
            // return $view;
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream();
        }else{
            return view('reports.events-list', compact('reg', 'range'));
        }
    }

    public function get_range_date($start, $finish){
        $days = ['', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        $months = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        if($start == $finish){
            $range = $days[date('N', strtotime($start))].', '.date('d', strtotime($start)).' de '.$months[date('n', strtotime($start))].' de '.date('Y', strtotime($start));
        }else{
            if(date('m', strtotime($start)) == date('m', strtotime($finish))){
                $range = 'Del '.date('d', strtotime($start)).' al '.date('d', strtotime($finish)).' de '.$months[date('n', strtotime($finish))].' de '.date('Y', strtotime($finish));
            }else{
                $range = 'Del '.date('d', strtotime($start)).' de '.$months[date('n', strtotime($start))].' al '.date('d', strtotime($finish)).' de '.$months[date('n', strtotime($finish))].' de '.date('Y', strtotime($finish));
            }
        }
        return $range;
    }
}
