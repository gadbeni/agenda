<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\Appointment;
use App\Models\AppointmentsDetail;

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
            }

            DB::commit();

            if($request->ajax){
                return response()->json(['appointment' => $appointment]);
            }
            return redirect()->route('appointments.index')->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            if($request->ajax){
                return response()->json(['error' => 'Ocurrió un erro.']);
            }
            return redirect()->route('appointments.create')->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
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
        try {
            Appointment::where('id', $id)->update([
                'start' => $request->start,
                'finish' => $request->finish
            ]);

            if($request->ajax){
                return response()->json(['success' => 'Evento editado correctamente.']);
            }
            return redirect()->route('appointments.index')->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            //throw $th;
            if($request->ajax){
                return response()->json(['error' => 'Ocurrió un erro.']);
            }
            return redirect()->route('appointments.create')->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
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
        //
    }
}
