<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\PerfilPermissao;
use App\Models\Permissao;
use Illuminate\Http\Request;

class PerfilPermissaoController extends Controller
{
    protected $perfil, $permissao;
    
    public function __construct(Perfil $perfil, Permissao $permission)
    {
        $this->perfil       = $perfil;
        $this->permissao    = $permission;
        
        //$this->middleware(['can:profiles']);
    }
    
    
    public function index()
    {
        $dados["perfils"] = Perfil::all();
        return view("Permissao.Index", $dados);
    }

    
    public function create()
    {
        return view("Categoria.Create");
    }

    public function store(Request $request)
    {
        $req                = $request->except(["_token","_method"]);
        PerfilPermissao::firstOrCreate($req);
        return redirect()->route('perfil.permissao',$req["perfil_id"]);
    }

    public function vincularPermissao(Request $request, $idPerfil)
    {
        if (!$perfil = $this->perfil->find($idPerfil)) {
            return redirect()->back();
        }
        
        if (!$request->permissoes || count($request->permissoes) == 0) {
            return redirect()
            ->back()
            ->with('msg_erro', 'Precisa escolher pelo menos uma permissão');
        }
        
        $perfil->permissoes()->attach($request->permissoes);
        
        return redirect()->route('perfil.permissao', $perfil->id);
    }
    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $dados["perfil"] = Perfil::find($id);
        $dados["perfils"] = Perfil::all();
        return view('Perfil.Create', $dados);
    }
    
    public function update(Request $request, $id)
    {
        $req     =   $request->except(["_token","_method"]);
        Permissao::where("id", $id)->update($req);
        return redirect()->route("permissao.index");
    }

    public function destroy($id)
    {
        try{
            $h = Permissao::find($id);
            $h->delete();
            return redirect()->back()->with('msg_sucesso', "Ítem apagado com sucesso.");
        }catch (\Exception $e){
            $cod = $e->getCode();
            return redirect()->back()->with('msg_erro', "Houve um problema ao apagar [$cod]");
        }
    }
}
