<?php
use App\Service\ConstanteService;
?>
@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
		<div class="thead border-bottom mb-3 px-2">
			<div class="titulo mb-0">
				<span><i class="fas fa-list-alt"></i> Preços do Plano: {{$plano->nome}}</span>
				<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <a href="{{route('plano.index')}}"  class="text-azul">Lista de planos</a> <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2">{{$plano->nome}}</b></span>
			</div>
		</div>
			<div class="px-md">					
				<div class="card bg-normal blue-100 mb-3">						
					<div class="lst ">	
					 @if(isset($planopreco))    
                           <form action="{{route('planopreco.update', $planopreco->id)}}" method="POST">
                           <input name="_method" type="hidden" value="PUT"/>
                         @else                       
                        	<form action="{{route('planopreco.store')}}" method="Post">
                        @endif
                        	@csrf
	
						<div class="rows">	
							<div class="col-4">
									<label class="text-label d-block ">Recorrência </label>
									<select name="recorrencia" class="form-campo">
										<label class="text-label d-block ">Nome </label>
										@foreach(config('constantes.tipo_recorrencia') as $chave=>$valor)
											<option value="{{$valor}}" {{($planopreco->recorrencia ?? null)== $valor ? 'selected' : ''}}>{{$chave}}</option>
										@endforeach
									</select>
                    			</div>
                    										
								<div class="col-3">
										<label class="text-label d-block ">Preço De </label>
                    					<input type="text" name="preco_de" required="required" value="{{($planopreco->preco_de) ?? old('preco_de')}}" placeholder="Preço" class="form-campo mascara-dinheiro" >
                    			</div>
                    			<div class="col-3">
										<label class="text-label d-block ">Preço Atual </label>
                    					<input type="text" name="preco" required value="{{($planopreco->preco) ?? old('preco')}}" placeholder="Preço" class="form-campo mascara-dinheiro" >
                    			</div>
								
								<div class="col-2">
								<label class="text-label d-block ">. </label>
									<input type="hidden" name="plano_id" value="{{$plano->id}}">
									<input type="submit" class="btn btn-azul2 width-100" value="Salvar">
								</div>
						</div>
						</form>
			</div>			
			</div>			
		
		<div class="card caixa blue-100 mb-3">			
				<div class="tabela-responsiva">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable">
						<thead> 
						  <tr>
							<th class="text-left" width="40">ID</th>
							<th class="text-left">Recorrência</th>
							<th class="text-left">Preço de</th>
							<th class="text-left">Preço Atual</th>
							<th class="text-left">Status</th>
							<th class="text-center" width="30">Editar</th>
							<th class="text-center" width="30">Excluir</th>
						  </tr>
						</thead> 
						<tbody>
						@foreach($lista as $v)
							<tr>
								<td>{{$v->id}}</td>
								<td>{{ConstanteService::getRecorrencia($v->recorrencia)}}</td>
								<td>{{moedaBr($v->preco_de)}}</td>
								<td>{{moedaBr($v->preco)}}</td>
								<td>{{ $v->status->status}}</td>
                                <td>
                                	<a href="{{route('plano.editarPreco', $v->id)}}" class="btn btn-laranja d-inline-block" title="Editar Empresa"><i class="fas fa-edit"></i></a>
                                	
                                </td>	
								 <td align="center">
                                <a href="#" onclick="confirm('Tem Certeza?') ? document.getElementById('apagar{{$v->id}}').submit() : '';" class="d-inline-block btn btn-vermelho btn-circulo btn-pequeno" title="Excluir"><i class="fas fa-trash-alt"></i></a>
                                    <form action="{{route('planopreco.destroy', $v->id)}}" method="POST" id="apagar{{$v->id}}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{csrf_field()}}
                                    </form>
                                 </td>
							</tr>
						@endforeach 						
						</tbody>
					</table>
					</div>
										
					
					</div>
				
			</section>
		</div>
	</div>
</div>
@endsection