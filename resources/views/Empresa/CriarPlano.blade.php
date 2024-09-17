<?php
use App\Service\ConstanteService;
?>
@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<div class="caixa">
  <div class="thead border-bottom mb-3 p-1">
		<div class="titulo mb-0"><i class="fas fa-plus-circle"></i> Detalhes da Empresa</div>
		<div>
			<a href="{{route('empresa.index')}}" class="btn btn-azul2 ml-1 d-inline-block btn-pequeno" title="Voltar"><i class="fas fa-arrow-left"></i> </a>							
		</div>
	</div>                 
                      
	
   <div class="px-md mb-5">
   <div id="tabs">
	 
	  <div id="tab-1">
		<div class="p-2">
			<fieldset class="mb-3">
				<legend>Informações básicas</legend>
				
				<div class="rows">												
					<div class="col-6 mb-3">
							<label class="text-label">Razão Social</label>	
							<input type="text" name="razao_social" id="razao_social" value="{{isset($empresa->razao_social) ? $empresa->razao_social : old('razao_social') }}" class="form-campo">
					</div>                                    
					<div class="col-6 mb-3">
							<label class="text-label">Nome Fantasia</label>	
							<input type="text" name="nome_fantasia"  id="nome_fantasia" value="{{isset($empresa->nome_fantasia) ? $empresa->nome_fantasia : old('nome_fantasia') }}" class="form-campo">
					</div>					
					
								
					<div class="col-6 mb-3">
							<label class="text-label">Email</label>	
							<input type="text" name="email" id="email" value="{{isset($empresa->email) ? $empresa->email : old('email') }}"  class="form-campo">
					</div>						
					<div class="col-3 mb-3">
							<label class="text-label">CNPJ</label>	
							<input type="text" name="cpf_cnpj" id="cnpj" value="{{isset($empresa->cpf_cnpj) ? $empresa->cpf_cnpj : old('cpf_cnpj') }}"  class="form-campo">
					</div>	
					<div class="col-3 mb-3">
							<label class="text-label">Fone</label>	
							<input type="text" name="fone" id="telefone" value="{{isset($empresa->fone) ? $empresa->fone : old('fone') }}"  class="form-campo mascara-celular">
					</div>
			</fieldset>	
			
			<form action="{{route('assinatura.criarAssinatura')}}" method="Post">
				@csrf
			
			<fieldset  class="mb-3">					
					<legend>Dados de Assinatura</legend>	
																	
					<div class="rows">	
							<div class="col-3 mb-3">
								<label class="text-label">Selecione o Plano</label>	
								<select name="plano_id" id="plano_id" class="form-campo " onchange="buscarPlano()">
									@foreach($planos as $plano)
										<option value="{{$plano->id}}">{{$plano->nome}}</option>
									@endforeach
								</select>
                            </div>
                            <div class="col-3 mb-3">
                            	<label class="text-label">Recorrencia</label>	
                            	<select name="recorrencia_id" id="recorrencia_id" required="required" class="form-campo " onchange="buscarPlano()">
                            			<option>Selecione</option>
									@foreach(config("constantes.tipo_recorrencia") as $key => $e)
										<option value="{{$e}}">{{$key}}</option>
									@endforeach
								</select>
                            </div>
                            
                            <div class="col-3 mb-3">
                            	<label class="text-label">Forma de Pagamento</label>	
                            	<select name="forma_pagto_id" class="form-campo ">
									@foreach($forma_pagto as $f)
										<option value="{{$f->id}}">{{str_replace('_', ' ', $f->forma_pagto) }}</option>
									@endforeach
								</select>
                            </div>                           
                            
                            <div class="col-2 mb-4">
                                    <label class="text-label">Data Vencimento</label>	
                                    <input type="date" name="data_vencimento"  value="{{hoje() }}"  class="form-campo">
                            </div>                      
                            
                            <div class="col-2 mb-3">
                            	<label class="text-label">Fatura como Paga</label>
                            	<select name="fatura_paga" class="form-campo ">
									<option value="S">Sim</option>
									<option value="N">Não</option>
								</select>	
                            </div>
                            
                            <div class="col-2 mb-4">
                                    <label class="text-label">Valor Setup </label>	
                                    <input type="text" readonly="readonly" name="valor_setup" id="valor_setup"    class="form-campo mascara-float">
                            </div>
                            
                            <div class="col-3 mb-4">
                                    <label class="text-label">Valor Plano </label>	
                                    <input type="text" readonly="readonly" name="valor_plano" id="valor_plano"   class="form-campo mascara-float">
                            </div>
                            
                            <div class="col-2 mb-4">
                                    <label class="text-label">Valor Recorrente </label>	
                                    <input type="text" required name="valor_recorrente"  id="valor_recorrente" class="form-campo mascara-float">
                            </div>
                            
                            <div class="col-3 mb-4">
                                    <label class="text-label">Valor Contrato </label>	
                                    <input type="text" required name="valor_contrato"  id="valor_contrato" class="form-campo mascara-float">
                            </div>
                            
                            <div class="col-3 mb-4">
                                    <label class="text-label">Email de Acesso </label>	
                                    <input type="text" required name="email" value="{{isset($empresa->email) ? $empresa->email : null }}"   class="form-campo">
                            </div> 
                            
                            <div class="col-2 mb-4">
                                    <label class="text-label">Senha de Acesso </label>	
                                    <input type="text" required name="senha" value="mudar123"   class="form-campo">
                            </div> 
                            
                            <div class="col-3">
                            	<label class="text-label">. </label>	
            					<input type="hidden" name="empresa_id" value="{{($empresa->id) ?? old('id')}}" />
            					<input type="hidden" name="plano_preco_id" id="plano_preco_id"/>
            					<input type="submit" class="btn btn-azul2 width-100" value="Criar Assinatura">
            				</div>               
                              
					</div>
				
				</fieldset>
			
					
			</form>	
				</div>
			
		</div>
	 

  </div>	
	  </div>
</div>	

</div>
<script>

function buscarPlano(){
	var plano_id 		= $("#plano_id").val();
	var recorrencia_id 	= $("#recorrencia_id").val();
	var plano_preco_id 	= $("#plano_preco_id").val();
	if(plano_id=="" && recorrencia_id==""){
		return false;
	}
	 $.ajax({
		  url: base_url + "planopreco/buscarPlano/" + plano_id + "/" + recorrencia_id,
		  type: "POST",
		  dataType: "json",
		  data:{
		  		plano_id : plano_id,
		  		recorrencia_id : recorrencia_id,
		  		plano_preco_id : plano_preco_id,
		  		 
		  },
		  success: function (data){
			  $("#valor_setup").val(converteFloatMoeda(data.preco_setup));
			  $("#valor_plano").val(converteFloatMoeda(data.preco));
			  $("#valor_recorrente").val(converteFloatMoeda(data.preco));
			  $("#valor_contrato").val(converteFloatMoeda(data.total.toFixed(2)));
			  $("#plano_preco_id").val(data.plano_preco_id);
		  }
	   });	
}
</script>
@endsection