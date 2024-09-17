<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssinaturaRequest;
use App\Models\Assinatura;
use App\Models\CertificadoDigital;
use App\Models\ClassificacaoFinanceira;
use App\Models\ClassificacaoFinanceiraModel;
use App\Models\Cliente;
use App\Models\ContaCorrente;
use App\Models\Emitente;
use App\Models\Empresa;
use App\Models\FinComprovanteFatura;
use App\Models\FinFatura;
use App\Models\FormaPagto;
use App\Models\LojaConfiguracao;
use App\Models\Parametro;
use App\Models\Plano;
use App\Models\PlanoPreco;
use App\Models\TabelaPreco;
use App\Models\User;
use App\Service\FaturaService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssinaturaController extends Controller
{
    
    public function index()
    {
        $dados["lista"] = Empresa::where("id","!=",1)->get();
        return view("Empresa.Index", $dados);
    }

    public function create()
    {
        $dados = array();
        $dados["fornecedorJs"] = true;
        return view("Empresa.Create", $dados);
    }
    
    public function confirmaAssinaturaPeloComprovante($id)
    {
        $dados["planos"]        = Plano::get();
        $dados["formas_pagto"]  = FormaPagto::get();
        $dados["contas"]        = ContaCorrente::get();
        $dados["classificacoes"]= ClassificacaoFinanceira::get();
        $dados["comprovante"]   = FinComprovanteFatura::find($id);        
        return view('Assinatura.ConfirmarAssinaturaPeloComprovante', $dados);
    }
    
    public function cancelar($id)
    {
        $assinaturaAtiva = Assinatura::where(["id" => $id])->first();
        if($assinaturaAtiva){
            $assinaturaAtiva->status_id           = config("constantes.status.CANCELADO");
            $assinaturaAtiva->data_cancelamento   = hoje();
            $assinaturaAtiva->save();
            
            //Cancela as faturas;
            $fat_anterior = new \stdClass();
            $fat_anterior->observacao        = "Cancelado devido Mudançca de plano";
            $fat_anterior->status_id         = config("constantes.status.CANCELADO");
            $fat_anterior->data_cancelamento = hoje();
            FinFatura::where(["assinatura_id"=>$assinaturaAtiva->id,"status_id"=>config("constantes.status.ABERTO")])->update(objToArray($fat_anterior));
        }        
        return redirect()->route('empresa.index');
    }
    
    
    public function store(Request $request)    {
        $req                        = $request->except(["_token","_method","forma_pagto_id","comprovante_id","classificacao_id","conta_corrente_id"]);
        try{            
            $req["valor_contrato"]  = ($req["valor_contrato"]) ? getFloat($req["valor_contrato"]) : 0;
            $req["valor_recorrente"]= ($req["valor_recorrente"]) ? getFloat($req["valor_recorrente"]) : 0;
            $req["status_id"]       = config("constantes.status.ATIVO");
            $req["eh_teste"]        = "N";
            $req["dias_bloqueia"]   = 0;
            $assinatura             = Assinatura::Create($req);
            if($assinatura){                
                $dados                      = new \stdClass();
                $dados->forma_pagto         = $request->forma_pagto_id;
                $dados->classificacao_financeira_id = $request->classificacao_id;
                $dados->conta_corrente_id   = $request->conta_corrente_id;  
                $dados->pagar_fatura               = "S";
                FaturaService::gerarParcelas($assinatura->id, $dados);
                if($request->comprovante_id){
                    $comprovante = FinComprovanteFatura::find($request->comprovante_id);
                    $comprovante->confirmado = "S";
                    $comprovante->save();
                }
                
            }
            return redirect()->route('empresa.index');
        } catch (\Exception $e){
            return redirect()->back()->with('msg_erro', "Erro: " . $e->getMessage());
        }
        
        
    }
    
    
    public function criarAssinatura(AssinaturaRequest $request){  
        $req                    = $request->except(["_token","_method"]);
        try {
            // localiza a empresa
            $empresa          = Empresa::find($request->empresa_id);
            $planopreco       = PlanoPreco::where(["plano_id" => $req["plano_id"],"recorrencia" =>$req["recorrencia_id"]] )->first();
            
            //Verifica se já existe alguma assinatura ativa
            $assinaturaAtiva = Assinatura::where(["empresa_id" => $empresa->id,  "status_id"=>config("constantes.status.ATIVO") ])->first();
            if($assinaturaAtiva){
                $assinaturaAtiva->status_id           = config("constantes.status.CANCELADO");
                $assinaturaAtiva->data_cancelamento   = hoje();
                $assinaturaAtiva->save();
                
                //Cancela as faturas;
                $fat_anterior = new \stdClass();
                $fat_anterior->observacao        = "Cancelado devido Mudançca de plano";
                $fat_anterior->status_id         = config("constantes.status.CANCELADO");
                $fat_anterior->data_cancelamento = hoje();
                FinFatura::where(["assinatura_id"=>$assinaturaAtiva->id,"status_id"=>config("constantes.status.ABERTO")])->update(objToArray($fat_anterior));
            }
            
            // Cria um usuario
            $usuario            = new \stdClass();
            $usuario->empresa_id=$empresa->id;
            $usuario->uuid      =Str::uuid() ;
            $usuario->name      = $empresa->razao_social ;
            $usuario->email     =$request->email;
            $usuario->password  =bcrypt($request->senha);
            $usuario->telefone  =$request->celular;
            $usuario->eh_admin  ="S";
            $usuario->status_id =config("constantes.status.ATIVO");            
            $temUsuario = User::where("empresa_id", $empresa->id)->first();
            if(!$temUsuario){
                User::Create(objToArray($usuario));
            }      
                        
            // Cria Assinatura
            $assinatura                     = new \stdClass();
            $assinatura->empresa_id         = $empresa->id;
            $assinatura->plano_preco_id     = $planopreco->id;
            $assinatura->status_id          = config("constantes.status.ATIVO");
            $assinatura->data_aquisicao     = hoje();
            $assinatura->valor_contrato     = getFloat($request->valor_contrato);
            $assinatura->eh_teste           = "N";
            $assinatura->bloqueado_pelo_gestor = "N";
            $assinatura->liberado_pelo_gestor = "N";            
            $assinatura->valor_recorrente   = getFloat($request->valor_recorrente);
            $assinatura->dias_bloqueia      =  0;
            $assinatura_nova = Assinatura::Create(objToArray($assinatura));
                        
            //Criando a tabela de parâmetros da empresa
            $parametro = new \stdClass();
            $parametro->empresa_id          = $empresa->id;
            $parametro->margem_lucro        = 30;
            $parametro->num_casas_decimais  = 2;
            $temParamento =Parametro::where("empresa_id", $empresa->id)->first();
            if(!$temParamento){
                Parametro::Create(objToArray($parametro));
            }
                        
            //Criando a tabela de Configuração da Loja
            $loja = new \stdClass();
            $loja->empresa_id  = $empresa->id;
            $temConfig =LojaConfiguracao::where("empresa_id", $empresa->id)->first();
            if(!$temConfig){
                LojaConfiguracao::Create(objToArray($loja));
            }
            
            //Criando o Cliente Consumidor
            
            $consumidor = new \stdClass();
            $consumidor->empresa_id         = $empresa->id;
            $consumidor->tipo_cliente       = "F";
            $consumidor->eh_consumidor      = "S";
            $consumidor->cpf_cnpj           = "11111111111";
            $consumidor->nome_razao_social  = "CLIENTE CONSUMIDOR";
            $consumidor->indFinal           = "1";
            $consumidor->logradouro         = "logradouro";
            $consumidor->numero           = "123";
            $consumidor->bairro           = "Bairro";
            $consumidor->uf             = "UF";
            $consumidor->status_id           = config("constantes.status.ATIVO");
            
            $temCliente =Cliente::where("empresa_id", $empresa->id)->first();
            if(!$temCliente){
                $cliente = Cliente::Create(objToArray($consumidor));
            }else{
                $cliente = $temCliente;
            }
           
            $emitente                     =  new \stdClass();
            $emitente->empresa_id         = $empresa->id;
            $emitente->cliente_consumidor = $cliente->id;
            $temEmitente=Emitente::where("empresa_id", $empresa->id)->first();
            if(!$temEmitente){
                $emit                    = Emitente::Create(objToArray($emitente));
            }else{
                $emit               = $temEmitente;
            }
            
            $certificado                  = new \stdClass();
            $certificado->empresa_id      = $empresa->id;
            $certificado->emitente_id     = $emit->id;
            $temCertificado=CertificadoDigital::where("empresa_id", $empresa->id)->first();
            if(!$temCertificado){
                CertificadoDigital::Create(objToArray($certificado));
            }
            
            $temClassificacao=ClassificacaoFinanceira::where("empresa_id", $empresa->id)->first();
            if(!$temClassificacao){
                $lista                      = ClassificacaoFinanceiraModel::get();
                foreach($lista as $classificacao){
                    $nova_classificacao                 = new ClassificacaoFinanceira();
                    $nova_classificacao->empresa_id     = $empresa->id;
                    $nova_classificacao->codigo         = $classificacao->codigo;
                    $nova_classificacao->descricao      = $classificacao->descricao;
                    $nova_classificacao->titulo_grupo   = $classificacao->titulo_grupo;
                    $nova_classificacao->ativo          = $classificacao->ativo;
                    $nova_classificacao->receita_despesa= $classificacao->receita_despesa;
                    $nova_classificacao->save();
                }
            }
            
            $conta = new \stdClass();
            $conta->banco_id = 1;
            $conta->empresa_id = $empresa->id;
            $conta->tipo_conta_corrente_id  = 3;
            $conta->descricao = "Conta Caixa" ;
            $conta->agencia = "000";
            $conta->conta = "0000";
            $conta->pix = "0000";
            $temConta=ContaCorrente::where("empresa_id", $empresa->id)->first();
            if(!$temConta){
                ContaCorrente::Create(objToArray($conta));
            }
            
            $preco = new \stdClass();
            $preco->empresa_id = $empresa->id;
            $preco->nome    = "Tabela Principal";
            $preco->padrao  = "S";
            $temPreco=TabelaPreco::where("empresa_id", $empresa->id)->first();
            if(!$temPreco){
                TabelaPreco::Create(objToArray($preco));
            }
            
            //Gerar Parcelas
            $dados                      = new \stdClass();
            $dados->forma_pagto         = $request->forma_pagto_id;
            $dados->classificacao_financeira_id = 1;
            $dados->conta_corrente_id   = 1; 
            $dados->pagar_fatura        = $request->fatura_paga;
            FaturaService::gerarParcelas($assinatura_nova->id, $dados);
            return redirect()->route('empresa.index');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('msg_erro', $e->getMessage());
        }        
    }
    
    public function bloquear($id)
    {
        $assinatura  = Assinatura::find($id);
        if($assinatura->bloqueado_pelo_gestor == "N"){
            $assinatura->bloqueado_pelo_gestor = "S";
        }else{
            $assinatura->bloqueado_pelo_gestor = "N";
        }
        
        $assinatura->save();
        return redirect()->back()->with('msg_sucesso', "Alterado com sucesso.");
    }
    
    public function liberar($id)
    {
        $assinatura  = Assinatura::find($id);
        if($assinatura->liberado_pelo_gestor == "N"){
            $assinatura->liberado_pelo_gestor = "S";
        }else{
            $assinatura->liberado_pelo_gestor = "N";
        }
        $assinatura->save();
        return redirect()->back()->with('msg_sucesso', "Alterado com sucesso.");
    }
    
    public function alterarDias(Request $request)
    {        
        $assinatura  = Assinatura::find($request->id);
        $assinatura->dias_bloqueia = $request->dias;
        $assinatura->save();
        return redirect()->back()->with('msg_sucesso', "Alterado com sucesso.");
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function gerarFatura(Request $request){
        $req                    = $request->except(["_token","_method"]);
        $empresa                = Empresa::find($req["empresa_id"]);    
     
        $fat                    = new \stdClass();
        $fat->descricao         = "Fatura do Plano: " . $empresa->planopreco->plano->nome ;
        $fat->empresa_id        = $empresa->id;
        $fat->forma_pagto_id    = $req["forma_pagto_id"];
        $fat->status_id         = config("constantes.status.ABERTO");
        $fat->data_emissao      = hoje();
        $fat->data_vencimento   = $req["data_vencimento"];
        $fat->valor             = $empresa->planopreco->preco;
        $fat->num_fatura        = 1;
        $fat->inicio_vigencia   = hoje();
        $fat->fim_vigencia      = $req["data_vencimento"];
        
        //Verifica se tem alguma fatura em aberto se sim, ele atualiza, senão ele cria
       $fatura =  FinFatura::Create(objToArray($fat));
       
       if($fatura){
           $empresa->data_vencimento = $req["data_vencimento"];
           $empresa->status_plano_id = ($empresa->data_vencimento > hoje()) ?  config("constantes.status.EM_DIAS") : config("constantes.status.ATRASADO");;
           $empresa->status_id       = config("constantes.status.ATIVO");
           $empresa->save();
       }
        
               
        return redirect()->back()->with("msg_sucesso","Operação realizada com sucesso!");
    }
    
    

    
    
    public function criarfatura($id)
    {
        $dados["empresa"]       = Empresa::find($id);
        $dados["planos"]        = Plano::where('id',"<>", 1)->get();
        
        return view('Empresa.CriarFatura', $dados);
    }
    
    public function fatura($id)
    {
        $dados["empresa"]       = Empresa::find($id);
        $dados["forma_pagto"]   = FormaPagto::whereIn('id',
            [
                Config('constantes.forma_pagto.BOLETO_BANCARIO'),
                Config('constantes.forma_pagto.PIX'),
                Config('constantes.forma_pagto.CARTAO_CREDITO'),
            ]
            )->get();
        $dados["lista"]    = FinFatura::where("empresa_id",$id)->get();
        return view('Empresa.Fatura', $dados);
    }
   
   
    
    public function show($id)
    {
        $dados["empresa"] = Empresa::find($id);
        return view('Empresa.Detalhe', $dados);
    }
    
    public function edit($id)
    {
        $dados["empresa"] = Empresa::find($id);
        $dados["fornecedorJs"] = true;
        return view('Empresa.Create', $dados);
    }

    public function update(Request $request, $id)
    {
        $req                    = $request->except(["_token","_method"]);
        $req["cep"]             = ($req["cep"]) ? tira_mascara($req["cep"]) : null;
        $req["cpf_cnpj"]        = ($req["cpf_cnpj"]) ? tira_mascara($req["cpf_cnpj"]) : null;
        $req["fone"]            = ($req["fone"]) ? tira_mascara($req["fone"]) : null;
        $req["celular"]         = ($req["celular"]) ? tira_mascara($req["celular"]) : null;
        Empresa::where("id", $id)->update($req);
        return redirect()->route("empresa.index");
    }

    public function destroy($id)
    {
        try{           
            $h = Empresa::find($id);
            Emitente::where("empresa_id", $h->id)->delete();
            Parametro::where("empresa_id", $h->id)->delete();   
            User::where("empresa_id", $h->id)->delete(); 
            $h->delete();
            return redirect()->back()->with('msg_sucesso', "Ítem apagado com sucesso.");
        }catch (\Exception $e){
            $cod = $e->getCode();
            return redirect()->back()->with('msg_erro', "Houve um problema ao apagar " . $cod);
        }
    }
}
