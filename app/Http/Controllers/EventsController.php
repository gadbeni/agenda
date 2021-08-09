<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

// Models
use App\Models\Event;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('events.browse');
    }

    public function list(){
        $reg = Event::where('deleted_at', NULL)->get();
        return response()->json(['reg' => $reg]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.edit-add');
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
            Event::create([
                'user_id' => Auth::user()->id,
                'events_room_id' => $request->events_room_id,
                'name' => $request->name,
                'description' => $request->description,
                'applicant' => $request->applicant,
                'start' => $request->start,
                'finish' => $request->finish
            ]);

            DB::commit();
            return redirect()->route('events.index')->with(['message' => 'Evento guardado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->route('events.index')->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
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
        $event = Event::with('events_room')->where('id', $id)->where('deleted_at', NULL)->first();
        return response()->json(['event' => $event]);
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
            $event = Event::findOrFail($id);
            $event->name = $request->name ?? $event->name;
            $event->description = $request->description ?? $event->description;
            $event->applicant = $request->applicant ?? $event->applicant;
            $event->events_room_id = $request->events_room_id  ?? $event->events_room_id;
            $event->start = $request->start ?? $event->start;
            $event->finish = $request->finish ?? $event->finish;
            $event->save();

            DB::commit();
            if($request->ajax){
                return response()->json(['success' => 'Evento editado correctamente.']);
            }
            return redirect()->route('events.index')->with(['message' => 'Evento editado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
            if($request->ajax){
                return response()->json(['error' => 'Ocurrió un erro.']);
            }
            return redirect()->route('events.index')->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
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
        $event = Event::findOrFail($id);
        $event->deleted_at = Carbon::now();
        $event->save();
        return redirect()->route('events.index')->with(['message' => 'Evento eliminado exitosamente.', 'alert-type' => 'success']);
    }
}
