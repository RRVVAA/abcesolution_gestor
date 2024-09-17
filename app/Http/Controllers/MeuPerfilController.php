<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\GestaoGestor;

class MeuPerfilController extends Controller
{
    
    public function index()
    {
        $dados["usuario"] = auth()->user();
        return view("MeuPerfil.Index", $dados);
    }
       
    public function update(Request $request, $id){        
        if($request->password){
            $req["password"] = bcrypt($request->password);
            $req             = $request->except(["_token","_method","file"]);
        }else{
            $req             = $request->except(["_token","_method","file","password"]);
        }        

        if ($request->hasFile('file') && $request->file->isValid()) {
            $file               = $request->file('file');
            $extensao           = $file->getClientOriginalExtension();
            $nomeImagem         = Str::random(25) . ".".$extensao;
            $pasta              = "storage/upload/foto/";
            $file->move(public_path($pasta), $nomeImagem);
            $req["foto"] = $pasta . $nomeImagem;            
        }        
        GestaoGestor::where("id", auth()->user()->getAuthIdentifier())->update($req);
        return redirect()->route("index")->with("msg_sucesso","Registro alterado com sucesso");
    }

    
}
