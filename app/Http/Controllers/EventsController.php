<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $start = $request->date.' '.$request->start;
        $finish = $request->date.' '.$request->finish;
        $event = Event::where('deleted_at', NULL)
                    ->whereRaw("(start < '$finish') or (finish > '$start' and finish < '$finish' )")
                    ->get();
        dd($start, $finish,$event);
        try {
            Event::create([
                'events_room_id' => $request->events_room_id,
                'name' => $request->name,
                'description' => $request->description,
                'applicant' => $request->applicant,
                'start' => $request->date.' '.$request->start,
                'finish' => $request->date.' '.$request->finish
            ]);
            return redirect()->route('events.index')->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->route('events.create')->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
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
        //
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
        //
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
