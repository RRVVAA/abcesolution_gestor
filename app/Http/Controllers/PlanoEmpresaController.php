<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\EmpresaPlano;
use App\Models\GestaoReceber;
use App\Models\Plano;
use Illuminate\Http\Request;

class PlanoEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados["lista"] = EmpresaPlano::all();
        return view("Gestor.PlanoEmpresa.Index", $dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $dados["planos"] = Plano::all();
        $dados["empresas"] = Empresa::all();        
        return view("Gestor.PlanoEmpresa.Create", $dados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $req = $request->except(["_token","_method"]);
        $req["status_id"] = config('constantes.status.ATIVO');
        $plano = EmpresaPlano::Create($req);
        if($plano){
            GestaoReceber::Create(
                [
                    "empresa_id" => $plano->empresa_id,
                    "descricao"  => "Contrato do plano: ". $plano->id,
                    "data_lancamento" =>hoje(),
                    "data_vencimento" => $plano->data_vencimento,
                    "valor_a_receber" => $plano->valor_contrato,
                    "saldo_restante"  => $plano->valor_contrato,
                    "valor_total"     => $plano->valor_contrato,
                    "pago"            => "N",
                ]
                );
        }
        return redirect()->route('gestor.cliente.planos', $req["empresa_id"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $dados["cliente"] = Empresa::find($id);
        return view('Gestor.Cliente.Create', $dados);
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
        Empresa::where("id", $id)->update($req);
        return redirect()->route("gestor.cliente.index");
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
            $h = Empresa::find($id);
            $h->delete();
            return redirect()->back()->with('msg_sucesso', "Ítem apagado com sucesso.");
        }catch (\Exception $e){
            $cod = $e->getCode();
            return redirect()->back()->with('msg_erro', "Houve um problema ao apagar [$cod]");
        }
    }
}
