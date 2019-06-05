<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Nota;

class NotasController extends Controller
{
	public function notas(){
		return view('notas');
	}    

	public function mostrarNotas(){
		return Nota::all();
	}

	public function saveNota(Request $request){
		$nota = new Nota();

		$nota->descripcion = $request->input('descripcion');
		$nota->save();

		return $this->mostrarNotas();
	}

	public function terminarNota(Request $request){
		$nota = new Nota();

		$nota = Nota::find($request->input('id'));
		$nota->estado = !$nota->estado;
		$nota->save();

		return $this->mostrarnotas();
	}

	public function deleteNota(Request $request){

		$nota = Nota::find($request->input('id'));
		$nota->delete();	

		return $this->mostrarNotas();
	}
}
