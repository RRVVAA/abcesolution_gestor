<?php
use App\Service\ConstanteService;
?>
@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<div class="caixa">
  <div class="thead border-bottom mb-3 p-1">
		<div class="titulo mb-0"><i class="fas fa-plus-circle"></i> Detalhes da Assinatura</div>
		<div>
			<a href="{{route('empresa.index')}}" class="btn btn-azul2 ml-1 d-inline-block btn-pequeno" title="Voltar"><i class="fas fa-arrow-left"></i> </a>							
		</div>
	</div>                 
                      
	
   <div class="px-md mb-5">
   <div id="tabs">
	 
	  <div id="tab-1">
		<div class="p-2">	
			
			<form action="{{route('assinatura.store')}}" method="Post">
				@csrf
			
			<fieldset  class="mb-3">					
					<legend>Dados de Assinatura</legend>	
																	
					<div class="rows">	
							<div class="col-3 mb-3">
								<label class="text-label">Selecione o Plano</label>	
								<select name="plano_id" class="form-campo ">
									@foreach($planos as $plano)
										<option value="{{$plano->id}}" {{($comprovante->planopreco->plano->id ?? null) == $plano->id ? "selected" : "" }}>{{$plano->nome}}</option>
									@endforeach
								</select>
                            </div>
                            <div class="col-3 mb-3">
                            	<label class="text-label">Recorrencia</label>	
                            	<select name="recorrencia_id" class="form-campo ">
									@foreach(config("constantes.tipo_recorrencia") as $key => $e)
										<option value="{{$e}}" {{($comprovante->planopreco->recorrencia ?? null) == $e ? "selected" : "" }}>{{$key}}</option>
									@endforeach
								</select>
                            </div>
                            
                            <div class="col-3 mb-3">
								<label class="text-label">Selecione</label>	
								<select name="forma_pagto_id" class="form-campo ">
									@foreach($formas_pagto as $f)
										<option value="{{$f->id}}" {{$f->id == config('constantes.forma_pagto.DEPOSITO_BANCARIO') ? 'selected' : ''}} >{{$f->id}} - {{$f->forma_pagto}}</option>
									@endforeach
								</select>
                            </div>
                            <div class="col-3 mb-3">
								<label class="text-label">Conta Corrente</label>	
								<select name="conta_corrente_id" class="form-campo ">
									@foreach($contas as $c)
										<option value="{{$c->id}}" >{{$c->id}} - {{$c->descricao}}</option>
									@endforeach
								</select>
                            </div>
                            
                            <div class="col-3 mb-3">
								<label class="text-label">Classificação Financeira</label>	
								<select name="classificacao_id" class="form-campo ">
									@foreach($classificacoes as $cl)
										<option value="{{$cl->id}}" >{{$cl->codigo}} - {{$cl->descricao}}</option>
									@endforeach
								</select>
                            </div>
                            
                          
                          @php
                          		$preco = $comprovante->planopreco->preco;
                          		$setup = $comprovante->planopreco->plano->valor_setup;
                          		$total = $preco + $setup;
                          		
                          @endphp
                            
                            <div class="col-2 mb-4">
                                    <label class="text-label">Data Aquisição</label>	
                                    <input type="date" name="data_aquisicao"  value="{{ hoje() }}"  class="form-campo">
                            </div>                            
                            <div class="col-3 mb-4">
                                    <label class="text-label">Valor Plano </label>	
                                    <input type="text" readonly="readonly" value="{{ $preco  }}"   class="form-campo mascara-float">
                            </div>
                            
                            <div class="col-3 mb-4">
                                    <label class="text-label">Valor Setup </label>	
                                    <input type="text"  value="{{  $setup }}"   class="form-campo mascara-float">
                            </div>
                            <div class="col-3 mb-4">
                                    <label class="text-label">Valor Contrato </label>	
                                    <input type="text" required name="valor_contrato" value="{{ $total }}"   class="form-campo ">
                            </div> 
                             
                             <div class="col-3 mb-4">
                                    <label class="text-label">Valor Recorrente </label>	
                                    <input type="text" required name="valor_recorrente" value="{{ $preco }}"   class="form-campo mascara-float">
                            </div>                           
                            
                            <div class="col-3">
                            	<label class="text-label">. </label>	
            					<input type="hidden" name="empresa_id" value="{{($comprovante->empresa_id) ?? null }}" />
            					<input type="hidden" name="comprovante_id" value="{{($comprovante->id) ?? null }}" />
            					<input type="hidden" name="plano_preco_id" value="{{($comprovante->planopreco_id ) ?? null }}" />
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
@endsection