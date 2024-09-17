<?php
use App\Service\ConstanteService;
?>
@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<div class="caixa">
  <div class="thead border-bottom mb-3 p-1">
		<div class="titulo mb-0"><i class="fas fa-plus-circle"></i> Criar Fatura da Empresa: {{$empresa->razao_social }}</div>
		<div>
			<a href="{{route('empresa.index')}}" class="btn btn-azul2 ml-1 d-inline-block btn-pequeno" title="Voltar"><i class="fas fa-arrow-left"></i> </a>							
		</div>
	</div>                 
                      
	
   <div class="px-md mb-5">
   <div id="tabs">
	 
	  <div id="tab-1">
		<div class="p-2">			
			
			<form action="{{route('gerarFatura')}}" method="Post">
				@csrf
			
			<fieldset  class="mb-3">					
					<legend>Dados da Fatura</legend>	
																	
					<div class="rows">
                            
                            <div class="col-4 mb-3">
                            	<label class="text-label">Forma de Pagamento</label>	
                            	<select name="forma_pagto_id" class="form-campo ">
									@foreach(ConstanteService::tiposPagamento() as $key => $v)
										<option value="{{$key}}">{{$v}}</option>
									@endforeach
								</select>
                            </div>
                            
                            <div class="col-4 mb-4">
                                    <label class="text-label">Primeiro Vencimento</label>	
                                    <input type="date" name="data_vencimento"  value="{{ hoje() }}"  class="form-campo">
                            </div>
                            
                            <div class="col-2 mb-3">
                            	<label class="text-label">Qtde</label>
                            	<select name="qtde" class="form-campo ">
                            	@for($i=1; $i<=12; $i++)
									<option value="{{$i}}">{{zeroEsquerda($i,2)}}</option>
								@endfor
								</select>	
                            </div> 
					</div>
				
				</fieldset>
			
				<div class="col-12">
					<input type="hidden" name="empresa_id" value="{{($empresa->id) ?? old('id')}}" />
					<input type="submit" value="Gerar Fatura" class="btn btn-azul m-auto">
				</div>	
			</form>	
				</div>
			
		</div>
	 

  </div>	
	  </div>
</div>	

</div>
@endsection