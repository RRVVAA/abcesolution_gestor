<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\PerfilPermissao;
use App\Models\Permissao;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index()
    {
        $dados["usuarios"] = User::all();
        
        return view(".User.Index", $dados);
    }

    
    public function create()
    {        
        $dados["status"] = Status::all();
        return view("Admin.Categoria.Create", $dados);
    }

    public function permissao($id_perfil){
        $dados["perfis"]            = Perfil::all();
        $dados["permissoes"]        = Permissao::all();
        $dados["perfil_permissoes"] = PerfilPermissao::where("perfil_id",$id_perfil)->get();
        
        return view('admin.Perfil.Permissao', $dados);
    }
    
    public function store(Request $request){
        try{
            $req = $request->all();
            User::criar($req);
            return redirect()->route("user.index")->with('msg_sucesso', "Cadastro realizado com sucesso.");
        }catch (\Exception $e){
            return redirect()->back()->with('msg_erro', "Houve um problema na tentativa de cadastro [{$e->getMessage()}]");
        }
        
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
        return view('Admin.Perfil.Index', $dados);
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
