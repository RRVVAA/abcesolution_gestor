<?php

namespace App\Http\Controllers;

use App\Models\ClassificacaoFinanceira;
use App\Models\ContaCorrente;
use App\Models\Empresa;
use App\Models\EmpresaPlano;
use App\Models\FinComprovanteFatura;
use App\Models\FinFatura;
use App\Models\FinPagamento;
use App\Models\FormaPagto;
use App\Models\GestaoFornecedor;
use App\Models\GestaoRecebimento;
use App\Models\PlanoPreco;
use App\Service\FinanceiroService;
use Illuminate\Http\Request;
use App\Models\Assinatura;
use App\Models\FinContaPagar;


class GestaoFaturaController extends Controller
{
    
    public function index()
    {
        $dados["lista"]         = FinFatura::whereMonth("data_vencimento", date('m'))->whereYear("data_vencimento", date('Y'))->get();
        $dados["mes"]           = date('m');
        
        return view("Fatura.Index", $dados);
    }
    public function pormes()
    {
        $mes            = $_GET["mes"];
        $ano            = $_GET["ano"];
        $dados["lista"] = FinFatura::whereMonth("data_vencimento", $mes)->whereYear("data_vencimento", $ano)->get();
        $dados["mes"]   = $mes;
        $dados["fornecedores"]  = GestaoFornecedor::get();
        return view("Fatura.Index", $dados);
    }
    
    public function filtro()
    {
        $filtro                 = new \stdClass();
        $filtro->fornecedor_id  = $_GET["fornecedor_id"];
        $filtro->status_id      = $_GET["status_id"];
        $filtro->venc01         = $_GET["venc01"];
        $filtro->venc02         = $_GET["venc02"];
        $filtro->emissao01      = $_GET["emissao01"];
        $filtro->emissao02      = $_GET["emissao02"];
        
        $dados["lista"]         = FinFatura::filtro($filtro);
        $dados["filtro"]        = $filtro;
        $dados["mes"]           = 13;
        $dados["fornecedores"]  = GestaoFornecedor::get();
        return view("Fatura.Index", $dados);
    }
    
 
    public function confirmaFaturaPeloComprovante($id){   
        $dados["formas_pagto"]  = FormaPagto::get();
        $dados["contas"]        = ContaCorrente::get();
        $dados["classificacoes"]= ClassificacaoFinanceira::get();
        
        $dados["comprovante"] = FinComprovanteFatura::find($id);
        $dados["fatura"] = FinFatura::find($dados["comprovante"]->fatura_id);
        return view('Fatura.ConfirmaPeloComprovante', $dados);
    }
    
    public function baixarPeloComprovante(Request $request)
    {        
        try {
            $comprovante = FinComprovanteFatura::find($request->comprovante_id);
            if($comprovante){
                $fatura = FinFatura::find($comprovante->fatura_id);
               
                //inserir conta receber
                $dados                              = new \stdClass();
                $dados->forma_pagto                 = $comprovante->forma_pagto_id;
                $dados->classificacao_financeira_id = $comprovante->classificacao_id;
                $dados->conta_corrente_id           = $comprovante->conta_corrente_id;
                FinanceiroService::inserirRecebimentoDeFatura($fatura->id, $dados);
                
                //Atualiza a fatura
                $fatura->valor               = getFloat($request->valor);
                $fatura->data_pagamento      = $request->data_pagamento;
                $fatura->status_id           = config("constantes.status.PAGO");
                $fatura->save();
                
                //atualiza Conta Pagar
                $contaPagar = FinContaPagar::where("fatura_id", $fatura->id)->first();
                $contaPagar->total_restante = 0;
                $contaPagar->total_restante = $fatura->valor ;
                $contaPagar->status_id      = config("constantes.status.PAGO");
                $contaPagar->save();
                
                //Ultima fatura paga
                $assinatura = Assinatura::find($fatura->assinatura_id);
                $assinatura->ultima_fatura_paga= $fatura->id;
                $assinatura->save();
                
                //Confirma o recebimento
                $comprovante->confirmado = "S";
                $comprovante->save();
            } 
        } catch (\Exception $e) {
            return redirect()->back()->with("msg_erro", $e->getMessage());
        }
             
                
        return redirect()->route('comprovante.index');
    }
    
    
    
    public function create()
    {
        $dados["empresas"]  = Empresa::where("id","!=",1)->get();
        $dados["planos"]    = PlanoPreco::all();
        return view("Fatura.Create", $dados);
    }

    
    public function store(Request $request)
    {
       
        $req = $request->except(["_token","_method"]);
        $planoPreco = PlanoPreco::find($req["planopreco_id"]);
        for($i=0; $i<$req["repete"]; $i++){
            $fatura = new FinFatura();            
            $fatura->empresa_id          = $req["empresa_id"];
            $fatura->planopreco_id       = $req["planopreco_id"];
            $fatura->descricao           = $req["descricao"];
            $fatura->data_emissao        = $req["data_emissao"];
            $fatura->data_vencimento     = somarData($req["data_vencimento"], 30 * $i);
            $fatura->valor               = $planoPreco->valor;
            $fatura->status_id           = config("constantes.status.ABERTO");
            $fatura->save(); 
        }
       
        return redirect()->route('fatura.index');
    }

    public function planos($id)
    {
        $dados["empresa"] = Empresa::find($id);
        $dados["lista"]  = EmpresaPlano::where("empresa_id",$id)->get();        
        return view('Cliente.Planos', $dados);
    }
    
    public function show($id)
    {
        $dados["fornecedores"] = GestaoFornecedor::all() ;
        $dados["fatura"] = FinFatura::find($id);
        return view('Fatura.Show', $dados);
    }

    public function listaPorEmpresa($id)
    {
        $dados["lista"] = FinFatura::where("empresa_id",$id)->get();
        return view('Fatura.Lista', $dados);
    }
    
    public function listaPorAssinatura($assinatura_id)
    {
        $dados["lista"] = FinFatura::where("assinatura_id",$assinatura_id)->get();
        return view('Fatura.Lista', $dados);
    }
    
    public function faturar($id){
        $contafatura = FinFatura::find($id);
        if($contafatura->pagamento_id){
            return redirect()->route('fatura.detalhe', $id)->with('msg_erro', "Essa conta não pode mais ser modificada.");
        }
       
        $dados["fatura"] = FinFatura::find($id);
        return view('Fatura.Faturar', $dados);
    }
   
    public function detalhe($id)
    {
        $dados["fatura"] = FinFatura::find($id);
        return view('Fatura.Detalhe', $dados);
    }
    
    public function edit($id)
    {
       
        $contafatura = FinFatura::find($id);
        if($contafatura->pagamento_id){
            return redirect()->route('fatura.detalhe', $id)->with('msg_erro', "Essa conta não pode mais ser modificada.");
        }        
       
     
        $dados["fatura"] = FinFatura::find($id);
        $dados["planos"]    = PlanoPreco::all();
        $dados["empresa"]       = Empresa::find($id);
        $dados["forma_pagto"]   = FormaPagto::whereIn('id',
            [
                Config('constantes.forma_pagto.BOLETO_BANCARIO'),
                Config('constantes.forma_pagto.PIX'),
                Config('constantes.forma_pagto.CARTAO_CREDITO'),
            ]
            )->get();
        
        return view('Fatura.Edit', $dados);
    }
    
    public function pagar(Request  $request)
    {
        
        $req                            = $request->except(["_token","_method"]);
        $fatura                         = FinFatura::find($req["fatura_id"]);  
       
        //gerar pagamento para a Empresa
        $pag                          = new \stdClass();
        $pag->usuario_id              = 1;
        $pag->empresa_id              = $fatura->empresa_id;
        $pag->descricao_pagamento     = "Pagamento da Fatura #" .$fatura->id;
        $pag->forma_pagto_id          = $req["forma_pagto_id"];
        $pag->tipo_documento          = config("constantes.tipo_documento.FATURA") ;
        $pag->documento_id            = $fatura->id;
        $pag->data_pagamento          = $req["data_pagamento"];;
        $pag->numero_documento        = $req["numero_documento"];
        $pag->observacao              = $req["observacao"];
        
        
        $pag->valor_original          = ($req["valor_original"]) ? moedaEN($req["valor_original"]) : 0;;
        $pag->juros                   = ($req["juros"]) ? moedaEN($req["juros"]) : 0;
        $pag->desconto                = ($req["desconto"]) ? moedaEN($req["desconto"]) : 0 ;
        $pag->multa                   = ($req["multa"]) ? moedaEN($req["multa"]) : 0;
        
        $pag->valor_pago              = $pag->valor_original + $pag->juros + $pag->multa-$pag->desconto;
        $pagamento                    = FinPagamento::Create(objToArray($pag));
        
        
        //gerar Recebimento para o Gestor
        $receb                          = new \stdClass();
        $receb->usuario_id              = 1;
        $receb->empresa_id              = $fatura->empresa_id;
        $receb->descricao_recebimento   = "Recebimento da Fatura #" .$fatura->id;
        $receb->forma_pagto_id          = $req["forma_pagto_id"];
        $receb->tipo_documento          = config("constantes.tipo_documento.FATURA") ;
        $receb->documento_id            = $fatura->id;
        $receb->data_recebimento        = hoje();
        $receb->numero_documento        = $req["numero_documento"];
        $receb->observacao              = $req["observacao"];
        
        
        $receb->valor_original          = ($req["valor_original"]) ? moedaEN($req["valor_original"]) : 0;;
        $receb->juros                   = ($req["juros"]) ? moedaEN($req["juros"]) : 0;
        $receb->desconto                = ($req["desconto"]) ? moedaEN($req["desconto"]) : 0 ;
        $receb->multa                   = ($req["multa"]) ? moedaEN($req["multa"]) : 0;
        
        
        $receb->valor_recebido          = $receb->valor_original + $receb->juros + $receb->multa-$receb->desconto;
        $recebimento                    = GestaoRecebimento::Create(objToArray($receb));
        
        $fatura->pagamento_id           = $pagamento->id;
        $fatura->recebimento_id         = $recebimento->id;
        $fatura->status_id              = config("constantes.status.PAGO");
        $fatura->save();
        
        //Alterar o status da empresa
        $empresa                = Empresa::find($fatura->empresa_id);
        
        if($empresa->plano_id   ==1){
            $empresa->data_aquisicao            = hoje();
            $empresa->data_inicial_vencimento   = hoje();
        }
        
        $empresa->plano_preco_id    = $fatura->planopreco->id;
        $empresa->forma_pagto_id    = $req["forma_pagto_id"];
        $empresa->valor_recorrente  = $fatura->planopreco->preco;
        $empresa->status_id         = config("constantes.status.ATIVO");
        $empresa->status_plano_id   = config("constantes.status.EM_DIAS");
        $empresa->data_vencimento   = somarData(hoje(),30 * $fatura->planopreco->recorrencia );
        $empresa->save();        
            
        return redirect()->route('fatura.index');
    }

    public function update(Request $request, $id)
    {
        $req                = $request->except(["_token","_method"]);
        
        $req["valor"]       = getFloat($req["valor"]);
        FinFatura::where("id", $id)->update($req);        
        return redirect()->route('fatura.index');
    }
    
   
    public function destroy($id)
    {
        try{
            $h = FinFatura::find($id);
            $h->delete();
            return redirect()->back()->with('msg_sucesso', "Ítem apagado com sucesso.");
        }catch (\Exception $e){
            $cod = $e->getCode();
            return redirect()->back()->with('msg_erro', "Houve um problema ao  [$cod]");
        }
    }
}
