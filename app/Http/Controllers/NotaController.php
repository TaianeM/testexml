<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;

class NotaController extends Controller
{
       /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notas = Nota::all();

        return view("notas.index",[
            'notas' => $notas
        ]);
    }

    /**
     * 
     *
     * @param Nota|array $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view("notas.create");
    }

    public function store(Request $request) {

    
            $nota = new Nota;

            $nota->xml = $request->xml;
               
            $nota->save();

         
    return redirect('notas')->with('success', 'Nota salva!');
     

}

    /**
     * Método que visualiza o notao.
     *
     * @param  Nota|int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nota = Nota::findOrFail($id);
        
        return view("notas.view");
    }



    /**
     * Método que remove um nota.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {

        $nota = nota::find($id);

        return view('notas.delete', compact('nota'));

    }
    
    public function destroy(nota $nota) {

        $nota->delete();

        return redirect()->route('notas.index')->with('delete','nota deletada.');
       

    }
}