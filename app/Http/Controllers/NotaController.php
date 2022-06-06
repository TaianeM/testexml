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

        if($request->method() == "POST"){
            $xml = simplexml_load_file($request->xml);

            $cnpj_nf = $xml->NFe->infNFe->emit->CNPJ->asXML();

            $cnpj_validado = '<CNPJ>09066241000884</CNPJ>';

            $nProt = str_replace(['<nProt>', '</nProt>'], '', $xml->protNFe->infProt->nProt->asXML()); //<nProt></nProt> str_replace

            if($nProt == null || $nProt == ""){
                return redirect('notas')->with('error', 'Numero de Protocolo não preenchido'); 
            }

            if($cnpj_nf != $cnpj_validado){
                return redirect('notas')->with('error', 'CNPJ inválido'); 
            }

            $numNota = str_replace(['<nNF>', '</nNF>'], '', $xml->NFe->infNFe->ide->nNF->asXML());      

            $horaEmissao = date('d/m/Y', strtotime(str_replace (['<dhEmi>', "</dhEmi>"], '', $xml->NFe->infNFe->ide->dhEmi->asXML())));

            $nota = new Nota;

            $nota->numNota = $numNota;

            $nota->horaEmissao = $horaEmissao;
                
            $nota->save();
        }
            
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

        $nota = Nota::find($id);

        return view('notas.delete', compact('nota'));

    }
    
    public function destroy(nota $nota) {

        $nota->delete();

        return redirect()->route('notas.index')->with('delete','nota deletada.');
       

    }
}