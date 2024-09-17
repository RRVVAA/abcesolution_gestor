<?php

namespace App\Http\Controllers;

use App\Models\GestaoTipoDespesa;
use Illuminate\Http\Request;

class TipoDespesaController extends Controller
{
    
    public function index()
    {
        $dados["lista"] = GestaoTipoDespesa::all();
        return view("TipoDespesa.Index", $dados);
    }
    
    public function create()
    {
        $dados = array();
        return view("TipoDespesa.Create", $dados);
    }
    
    public function store(Request $request)
    {       
        $req = $request->except(["_token","_method"]);
        GestaoTipoDespesa::firstOrCreate($req);
        return redirect()->route('tipodespesa.index');
    }
    
    public function show($id)
    {
        //
    }
   
    public function edit($id)
    {
        $dados["tipodespesa"] = GestaoTipoDespesa::find($id);
        $dados["lista"] = GestaoTipoDespesa::all();
        return view('TipoDespesa.Index', $dados);
    }
    
    public function update(Request $request, $id)
    {
        $req     =   $request->except(["_token","_method"]);
        GestaoTipoDespesa::where("id", $id)->update($req);
        return redirect()->route("tipodespesa.index");
    }
   
    public function destroy($id)
    {
        try{
            $h = GestaoTipoDespesa::find($id);
            $h->delete();
            return redirect()->back()->with('msg_sucesso', "Ítem apagado com sucesso.");
        }catch (\Exception $e){
            $cod = $e->getCode();
            return redirect()->back()->with('msg_erro', "Houve um problema ao apagar [$cod]");
        }
    }
}
