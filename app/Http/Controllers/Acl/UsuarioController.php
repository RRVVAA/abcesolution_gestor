<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\PerfilPermissao;
use App\Models\PerfilUser;
use App\Models\Permissao;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    
    public function index()
    {
        $dados["usuarios"] = User::EmpresaUser()->get();
        return view("Admin.Configuracao.Usuario.Index", $dados);
    }

    
    public function create()
    {        
        $dados["status"] = Status::all();
        $dados["perfis"] = Perfil::where('empresa_id', session('empresa_selecionada_id'))->get();
        return view("Admin.Configuracao.Usuario.Create", $dados);
    }

    public function permissao($id_perfil){
        $dados["perfis"]            = Perfil::all();
        $dados["permissoes"]        = Permissao::all();
        $dados["perfil_permissoes"] = PerfilPermissao::where("perfil_id",$id_perfil)->get();
        
        return view('admin.Perfil.Permissao', $dados);
    }
    
    public function store(Request $request){
        try{
            $req                = $request->except(["_token","_method","senha","file","perfil_id"]);
            $req["password"]    = ($req["password"]!="") ? bcrypt($req["password"]) : null;
            $file               = $request->file('file');
            
            if($file){
                $extensao           = $file->getClientOriginalExtension();
                $nomeImagem         = Str::random(25) . ".".$extensao;
                $pasta              = "storage/upload/img_perfil/";
                $upload             = $file->move(public_path($pasta), $nomeImagem);
                $req["foto"]        = $nomeImagem;
            }                     
            $usuario =  User::Create($req);
            if($usuario){
                UserEmpresa::Create(["empresa_id" =>session('empresa_selecionada_id'), "user_id"=>$usuario->id]);
                PerfilUser::Create(["perfil_id" => $request["perfil_id"], "user_id"=>$usuario->id]);
            }
            return redirect()->route("admin.usuario.index")->with('msg_sucesso', "Cadastro realizado com sucesso.");
        }catch (\Exception $e){
            return redirect()->back()->with('msg_erro', "Houve um problema na tentativa de cadastro [{$e->getMessage()}]");
        }
        
    }

    public function perfis( $id){
        $dados["usuarioLogado"] = auth()->user();
        $dados["perfisusuario"] = PerfilUser::where("user_id", $id)->get();
        $dados["usuario"]       = User::find($id);
        $dados["perfis"]        = Perfil::where('empresa_id', session('empresa_selecionada_id'))->get();
        return view('Admin.Configuracao.Usuario.Perfis', $dados);
    }    

  
    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $dados["usuarioLogado"] = auth()->user();
        $dados["perfisusuario"] = PerfilUser::where("user_id", $id)->get();
        $dados["usuario"]       = User::find($id);
       
        return view("Admin.Configuracao.Usuario.Edit", $dados);
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
        $req             = $request->except(["_token","_method","senha","file"]);
        $req["password"] = ($req["password"]!="") ? bcrypt($req["password"]) : $request->senha;
        
        $file               = $request->file('file');
        if($file){
            $extensao           = $file->getClientOriginalExtension();
            $nomeImagem         = Str::random(25) . ".".$extensao;
            $request->merge([ 'path' => $nomeImagem ]);
            $pasta = "storage/upload/img_perfil/";
            $upload = $file->move(public_path($pasta), $nomeImagem);
            $req["foto"] = $nomeImagem;
        }
        
        User::where("id", $id)->update($req);
        
        return redirect()->route("admin.usuario.index")->with('msg_sucesso', "Cadastro realizado com sucesso.");
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
