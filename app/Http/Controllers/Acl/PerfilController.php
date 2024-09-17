<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\PerfilPermissao;
use App\Models\Permissao;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    protected $perfil, $permissao;
    
    public function __construct(Perfil $perfil, Permissao $permissao)
    {
        $this->perfil = $perfil;
        $this->permissao = $permissao;
        
    }
    
    
    public function index()
    {
        $dados["lista"] = Perfil::all();
        return view("Perfil.Index", $dados);
    }

    
    public function create()
    {
        return view("Categoria.Create");
    }

    public function permissao($id_perfil){
        $dados["perfil"]            = Perfil::find($id_perfil);
        $dados["perfis"]            = Perfil::all();
        $dados["permissoes"]        = Permissao::all();
        $dados["perfil_permissoes"] = PerfilPermissao::where("perfil_id",$id_perfil)->get();
        
        return view('Perfil.Permissao', $dados);
    }
    
    public function vincular(Request $request,$id_perfil){        
        if (!$perfil = $this->perfil->find($id_perfil)) {
            return redirect()->back();        }
        
        $dados["filtro"]            = $request->except('_token');      
        $dados["perfil"]            = Perfil::find($id_perfil);
        $dados["lista"]             = $perfil->permissoesNaoInseridas($request->filtro);
        
        return view('Perfil.Vincular', $dados);
    }
    
    public function store(Request $request)
    {
       
        $req = $request->except(["_token","_method"]);
        Perfil::create($req);
        return redirect()->route("perfil.index");
    }

    
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
        $dados["lista"] = Perfil::all();
        $dados["perfil"] = Perfil::find($id);
        $dados["perfils"] = Perfil::all();
        return view('Perfil.Index', $dados);
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
        $req     =   $request->except(["_token","_method"]);
        Perfil::where("id", $id)->update($req);
        return redirect()->route("perfil.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $h = Perfil::find($id);
            $h->delete();
            return redirect()->back()->with('msg_sucesso', "Ítem apagado com sucesso.");
        }catch (\Exception $e){
            $cod = $e->getCode();
            return redirect()->back()->with('msg_erro', "Houve um problema ao apagar [$cod]");
        }
    }
}
