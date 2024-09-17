<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamado;
use App\Models\ChamadoReposta;

class ChamadoController extends Controller
{
    
    public function index()
    {
        $dados["lista"] = Chamado::all();
        return view("Chamado.Index", $dados);
    }
       
    public function edit($id)
    {
        $dados["chamado"] = Chamado::find($id);
        $dados["respostas"] = ChamadoReposta::where("chamado_id", $id)->get();
        return view('Chamado.Create', $dados);
    }
    
    public function store(Request $request){         
        $req     = $request->except(["_token","_method"]);   
        $req["usuario_id"] = 1;
       
        ChamadoReposta::Create($req);  
        $chamado = Chamado::find($req["chamado_id"]); 
        $chamado->status_id = config("constantes.status.PENDENTE");       
        $chamado->save();  
              
        
        return redirect()->route("chamado.index")->with("msg_sucesso","Registro alterado com sucesso");
    }

    
}
