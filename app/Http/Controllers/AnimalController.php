<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB; //trabajar con base de datos utilizando procedimientos almacenados
use Illuminate\Http\Request; //recuperar datos de la vista
use DataTables;

class AnimalController extends Controller
{
    public function index(Request $request){

        if($request->ajax()){
            $animales = DB::select('CALL spsel_animal()');
            return DataTables::of($animales)
                    ->addColumn('action', function($animales){
                        $acciones = '<a href="javascript:void(0)" onclick="editarAnimal('.$animales->id.')" class="btn btn-info btn-sm"> Editar </a>';
                        $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$animales->id.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }       

        return view('animal.index');
    } 
    
    public function registrar(Request $request){
        //llamar al procedimiento almacenado

        $animal = DB::select('call spcre_animal(?,?,?)',
                    [$request->nombre, $request->especie, $request->genero]);

        return back();            

    }

    public function eliminar($id){
        $animal = DB::select('call spdel_animal(?)', [$id]);
        return back();
    }

    public function editar($id){
        $animal = DB::select('call spseledit_animal(?)', [$id]);
        return response()->json($animal);
    }

    public function actualizar(Request $request){
        $animal = DB::select('call spupd_animal(?,?,?,?)',
                 [$request->id, $request->nombre, $request->especie, $request->genero]);

        return back();
    }

}
