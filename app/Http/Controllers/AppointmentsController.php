<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

// Models
use App\Models\Appointment;
use App\Models\AppointmentsDetail;
use App\Models\Assistant;

// Queue
use App\Jobs\SendEmail;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('appointments.browse');
    }

    public function list(){
        $reg = Appointment::where('deleted_at', NULL)->get();
        return response()->json(['reg' => $reg]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $appointment = Appointment::create([
                'user_id' => Auth::user()->id,
                'topic' => $request->topic,
                'description' => $request->description,
                'applicant' => $request->applicant,
                'place' => $request->place,
                'start' => $request->start,
                'finish' => $request->finish
            ]);
            
            foreach ($request->assistant_id as $assistant_id) {
                AppointmentsDetail::create([
                    'appointment_id' => $appointment->id,
                    'assistant_id' => $assistant_id
                ]);

                $assistant = Assistant::find($assistant_id);
                if($assistant->email){
                    try {
                        SendEmail::dispatch($assistant->email, 'Nuevo evento agendado', $request->topic, $request->description, $request->applicant, $request->place, $this->get_range_date($request->start, $request->finish));
                    } catch (\Throwable $th) {}
                }
            }

            DB::commit();

            if($request->ajax){
                return response()->json(['appointment' => $appointment]);
            }
            return redirect()->route('appointments.index')->with(['message' => 'Evento guardado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            // dd($th);
            DB::rollback();
            if($request->ajax){
                return response()->json(['error' => 'Ocurrió un erro.']);
            }
            return redirect()->route('appointments.index')->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::with('details.assistant')->where('id', $id)->where('deleted_at', NULL)->first();
        return response()->json(['appointment' => $appointment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $appointment = Appointment::findOrFail($id);
            $appointment->topic = $request->topic ?? $appointment->topic;
            $appointment->description = $request->description ?? $appointment->description;
            $appointment->applicant = $request->applicant ?? $appointment->applicant;
            $appointment->place = $request->place ?? $appointment->place;
            $appointment->start = $request->start ?? $appointment->start;
            $appointment->finish = $request->finish ?? $appointment->finish;
            if($request->assistant_id){
                $appointment->assistants()->sync($request->assistant_id);
            }
            $appointment->save();

            DB::commit();
            if($request->ajax){
                return response()->json(['success' => 'Evento editado correctamente.']);
            }
            return redirect()->route('appointments.index')->with(['message' => 'Evento editado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
            if($request->ajax){
                return response()->json(['error' => 'Ocurrió un erro.']);
            }
            return redirect()->route('appointments.index')->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->deleted_at = Carbon::now();
        $appointment->save();
        return redirect()->route('appointments.index')->with(['message' => 'Evento eliminado exitosamente.', 'alert-type' => 'success']);
    }

    public function get_range_date($start, $finish){
        $days = ['', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        $months = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $range = $days[date('N', strtotime($start))].', '.date('d', strtotime($start)).' de '.$months[date('n', strtotime($start))].' de '.date('Y', strtotime($start));
        if(date('H:i', strtotime($start)) != '00:00' && date('H:i', strtotime($finish)) != '00:00'){
            $range .= ' de '.date('H:i', strtotime($start)).' a '.date('H:i', strtotime($finish));
        }
        return $range;
    }

    public function index_details($start){
        $reg = [];
        $assistant = Assistant::where('user_id', Auth::user()->id)->first();
        $assistant_id = $assistant ? $assistant->id : NULL;
        if ($assistant_id) {
            $reg = Appointment::with('details.assistant')
                    ->whereHas('details.assistant', function($q) use($assistant_id){
                        $q->where('id', $assistant_id);
                    })
                    ->whereDate('start', $start)
                    ->where('deleted_at', NULL)->orderBy('start')->get();
        }

        return view('vendor.voyager.index-list', compact('reg'));
    }
}
