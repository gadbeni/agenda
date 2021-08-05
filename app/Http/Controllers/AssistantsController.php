<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Carbon\Carbon;

// Models
use App\Models\Assistant;
use App\Models\User;

class AssistantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('assistants.browse');
    }

    public function list(){
        $data = Assistant::with(['user'])->where('deleted_at', NULL)->get();
        // return $data;

        return
            Datatables::of($data)
            ->addIndexColumn()

            ->addColumn('action', function($row){
                $actions = '
                    <div class="no-sort no-click bread-actions text-right">
                        <a href="'.route('assistants.show', ['assistant' => $row->id]).'" title="Ver" class="btn btn-sm btn-warning view">
                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                        </a>
                        <a href="'.route('assistants.edit', ['assistant' => $row->id]).'" title="Ver" class="btn btn-sm btn-info edit">
                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                        </a>
                        <button title="Borrar" class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#delete_modal" onclick="deleteItem('."'".url("admin/assistants/".$row->id)."'".')">
                            <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar</span>
                        </button>
                    </div>
                        ';
                return $actions;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = 'create';
        return view('assistants.edit-add', compact('type'));
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
            $user = User::create([
                'name' => $request->full_name,
                'email' => $request->email,
                'role_id' => 4, // Rol de funcionario
                'password' => Hash::make($request->password)
            ]);

            Assistant::create([
                'full_name' => $request->full_name,
                'detail' => $request->detail,
                'email' => $request->email_alt,
                'phone' => $request->phone,
                'user_id' => $user->id
            ]);

            DB::commit();
            return redirect()->route('assistants.index')->with(['message' => 'Registro guardado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
            return redirect()->route('assistants.index')->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
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
        $assistant = Assistant::with(['user'])->where('id', $id)->first();
        return view('assistants.read', compact('assistant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = 'edit';
        $assistant = Assistant::with(['user'])->where('id', $id)->first();
        return view('assistants.edit-add', compact('type', 'assistant'));
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
            $user_id = $request->user_id;
            if($user_id){
                $user = User::find($user_id);
                $user->name = $request->full_name;
                $user->email = $request->email;
                if ($request->password) {
                    $user->password = Hash::make($request->password);
                }
                $user->save();
            }else{
                $user = User::create([
                    'name' => $request->full_name,
                    'email' => $request->email,
                    'role_id' => 4, // Rol de funcionario
                    'password' => Hash::make($request->password)
                ]);
                $user_id = $user->id;
            }

            Assistant::where('id', $id)->update([
                'full_name' => $request->full_name,
                'detail' => $request->detail,
                'email' => $request->email_alt,
                'phone' => $request->phone,
                'user_id' => $user_id
            ]);

            DB::commit();
            return redirect()->route('assistants.index')->with(['message' => 'Registro actualizado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
            return redirect()->route('assistants.index')->with(['message' => 'Ocurrio un error.', 'alert-type' => 'error']);
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
