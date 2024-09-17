<?php
use App\Service\ConstanteService;
?>
@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<div class="caixa">
  <div class="thead border-bottom mb-3 p-1">
		<div class="titulo mb-0"><i class="fas fa-plus-circle"></i> Detalhes da Empresa: {{$empresa->razao_social}}</div>
		<div>
			<a href="{{route('empresa.index')}}" class="btn btn-azul2 ml-1 d-inline-block btn-pequeno" title="Voltar"><i class="fas fa-arrow-left"></i> </a>							
		</div>
	</div>                 
   
   
	
   <div class="px-md mb-5">
   <div id="tabs">
	  <ul>
		<li><a href="#tab-1">Dados Gerais</a></li>
		<li><a href="#tab-2">Assinaturas</a></li>
		<li><a href="#tab-3">Pagamento</a></li>
	  </ul>
	  <div id="tab-1">
		<div class="p-2">
			<fieldset class="mb-3">
				<legend>Informações básicas</legend>
				
				<div class="rows">												
					<div class="col-6 mb-3">
							<label class="text-label">Razão Social</label>	
							<input type="text" readonly name="razao_social" id="razao_social" value="{{isset($empresa->razao_social) ? $empresa->razao_social : old('razao_social') }}" class="form-campo">
					</div>                                    
					<div class="col-6 mb-3">
							<label class="text-label">Nome Fantasia</label>	
							<input type="text" readonly name="nome_fantasia"  id="nome_fantasia" value="{{isset($empresa->nome_fantasia) ? $empresa->nome_fantasia : old('nome_fantasia') }}" class="form-campo">
					</div>					
					
								
					<div class="col-6 mb-3">
							<label class="text-label">Email</label>	
							<input type="text" readonly name="email" id="email" value="{{isset($empresa->email) ? $empresa->email : old('email') }}"  class="form-campo">
					</div>						
					<div class="col-3 mb-3">
							<label class="text-label">CNPJ</label>	
							<input type="text" readonly name="cpf_cnpj" id="cnpj" value="{{isset($empresa->cpf_cnpj) ? $empresa->cpf_cnpj : old('cpf_cnpj') }}"  class="form-campo">
					</div>	
					<div class="col-3 mb-3">
							<label class="text-label">Fone</label>	
							<input type="text" readonly name="fone" id="telefone" value="{{isset($empresa->fone) ? $empresa->fone : old('fone') }}"  class="form-campo mascara-celular">
					</div>
			</fieldset>		
			
		
				<fieldset>
					
					<legend>Endereço</legend>
													
					<div class="rows">	
							<div class="col-2 mb-3">
                            <label class="text-label">Cep</label>	
                            <input type="text" readonly name="cep" id="cep" value="{{isset($empresa->cep) ? $empresa->cep : old('cep') }}"  class="form-campo mascara-cep">
                            </div>
                            
                            <div class="col-4 mb-3">
                                    <label class="text-label">Logradouro</label>	
                                    <input type="text" readonly name="logradouro" id="logradouro" value="{{isset($empresa->logradouro) ? $empresa->logradouro : old('logradouro') }}"  class="form-campo rua">
                            </div>
                            <div class="col-2 mb-4">
                                    <label class="text-label">Numero</label>	
                                    <input type="text" readonly name="numero" id="numero" value="{{isset($empresa->numero) ? $empresa->numero : old('numero') }}"  class="form-campo">
                            </div>
                            <div class="col-4 mb-3">
                                     <label class="text-label">Bairro</label>	
                                     <input type="text" readonly name="bairro" id="bairro" value="{{isset($empresa->bairro) ? $empresa->bairro : old('bairro') }}"  class="form-campo bairro">
                             </div>
                             <div class="col-4 mb-3">
                                     <label class="text-label">Complemento</label>	
                                     <input type="text" readonly name="complemento" id="complemento" value="{{isset($empresa->complemento) ? $empresa->complemento : old('complemento') }}"  class="form-campo">
                             </div>	                            
        						 
                             <div class="col-2 mb-2">
                                 <label class="text-label">UF</label>	
                                 <input type="text" readonly name="uf" id="uf" value="{{isset($empresa->uf) ? $empresa->uf : old('uf') }}"   class="form-campo estado"> 
                             </div>                    
                             
                             <div class="col-4 mb-3">
                                     <label class="text-label">Cidade</label>	
                                     <input type="text" readonly name="cidade" id="cidade" value="{{isset($empresa->cidade) ? $empresa->cidade : old('cidade') }}"  class="form-campo cidade">
                             </div>	
                             <div class="col-2 mb-3">
                                     <label class="text-label">Ibge</label>	
                                     <input type="text" readonly name="ibge" id="ibge" value="{{isset($empresa->ibge) ? $empresa->ibge : old('ibge') }}"  class="form-campo ibge ">
                             </div>  
					</div>
				</fieldset>
					
				</div>
			
		</div>
	 
	   <div id="tab-2">
		<div class="p-2">									
				<fieldset>
					<legend>Assinaturas</legend>
													
			<div class="rows">	
		
			
				<div class="col-12">
						
				
				<div class="tabela-responsiva">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable">
						<thead> 
						  <tr>
							<th class="text-center">ID</th>
							<th class="text-center">Plano</th>
							<th class="text-center">Data Aquisição</th>
							<th class="text-center">Data Cancelamento</th>
							<th class="text-center">Liberado Pelo Gestor</th>
							<th class="text-center">Bloqueado Pelo Gestor</th>
							<th class="text-center">Adicionar Dias</th>
							<th class="text-center">Valor Contrato</th>
							<th class="text-center">Valor Recorrente</th>
							<th class="text-center">Faturas</th>
							<th class="text-center">Cancelar</th>
						  </tr>
						</thead> 
						<tbody>
						@foreach($assinaturas as $a)
							<tr>
								<td  class="text-center">{{$a->id}}</td>
								<td  class="text-center">{{$a->planopreco->plano->nome}} - {{$a->eh_teste=="S" ? "(Plano Teste)" : ""}}</td>
								<td  class="text-center">{{databr($a->data_aquisicao)}}</td>
								<td  class="text-center">{{$a->data_cancelamento ? databr($a->data_cancelamento ) :"00/00/0000"  }}</td>
								@if($a->status_id==config('constantes.status.ATIVO'))
									<td  class="text-center"><a href="{{route('assinatura.liberar', $a->id)}}">{{$a->liberado_pelo_gestor == "S" ? "Sim " : "Não " }}</a></td>
								@else
									<td  class="text-center">{{$a->liberado_pelo_gestor == "S" ? "Sim" : "Não"}}</td>
								@endif	
								
								@if($a->status_id==config('constantes.status.ATIVO'))
									<td  class="text-center"><a href="{{route('assinatura.bloquear', $a->id)}}">{{$a->bloqueado_pelo_gestor == "S" ? "Sim " : "Não " }}</a></td>
								@else
									<td  class="text-center">{{$a->bloqueado_pelo_gestor == "S" ? "Sim" : "Não"}}</td>
								@endif							
								
								@if($a->status_id==config('constantes.status.ATIVO'))
									<td  class="text-center"><a href="javascript:;">{{$a->dias_bloqueia }}</a></td>
								@else
									<td  class="text-center">{{$a->dias_bloqueia }}</td>
								@endif
								<td  class="text-center">{{$a->valor_contrato}}</td>
								<td  class="text-center">{{$a->valor_recorrente}}</td>	
								<td  class="text-center"><a href="{{route('fatura.listaPorAssinatura', $a->id)}}" class="d-inline-block btn btn-roxo btn-pequeno">Faturas </a> </td> 							
								
								@if($a->status_id == config('constantes.status.CANCELADO'))						  
									<td  class="text-center">Cancelado</td>
								@else
									<td  class="text-center"><a href="{{route('assinatura.cancelar', $a->id)}}" class="d-inline-block btn btn-vermelho btn-pequeno">Cancelar </a> </td> 							
								@endif	  							
    						</tr>
						@endforeach 						
						</tbody>
					</table>
					</div>
										
					
					</div>
					</div>
				
				</fieldset>
        </div>
	  
 </div>

 
   <div id="tab-3">
		<div class="p-2">									
				<fieldset>
					<legend>Pagamentos</legend>
													
			<div class="rows">	
		
			
				<div class="col-12">
						
				
				<div class="tabela-responsiva">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela">
						<thead> 
						  <tr>
							<th align="center">Id</th>
                           <th class="text-left">Descrição</th>
                           <th align="center">Data Recebimento</th>
                           <th align="center">Número</th>
                           <th align="center">Valor Original</th>
                           <th align="center">Juros</th>
                           <th align="center">Desconto</th>
                           <th align="center">Multa</th>
                           <th align="center">Valor Pago</th>
                           <th align="center">Forma Pagto</th>
                           <th align="center">Opções</th>
						  </tr>
						</thead> 
						<tbody>
						@foreach($recebimentos as $lancamento)
							<tr>
                               <td align="center">{{ $lancamento->id }}</td>
                               <td align="left">{{ $lancamento->descricao_pagamento }} </td>
                               <td align="center">{{ databr($lancamento->data_pagamento) }}</td>
                               <td align="center">{{ $lancamento->numero_documento }}</td>
                               <td align="center">{{ $lancamento->valor_original }}</td>
                               <td align="center">{{ $lancamento->juros }}</td>
                               <td align="center">{{ $lancamento->desconto }}</td>
                               <td align="center">{{ $lancamento->multa }}</td>
                               <td align="center">{{ $lancamento->valor_pago }}</td>
                               <td align="center">{{ $lancamento->forma_pagto->forma_pagto }}</td>
                               <td align="center">
									<a href="{{route('empresa.pagamento', $lancamento->id)}}" class="btn btn-roxo d-inline-block"><i class="fas fa-eye" title="Visualizar"></i></a>
							   </td>
                            </tr>
						@endforeach 						
						</tbody>
					</table>
					</div>
										
					
					</div>
					</div>
				
				</fieldset>
        </div>

         
 </div>
  </div>	
	  </div>
</div>	

</div>
@endsection