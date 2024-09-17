@extends("Gestor.template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
<div class="thead border-bottom mb-3 p-2">
		<div class="titulo mb-0"><i class="fas fa-list-alt"></i> Cadastrar novo Planos</div>
		<div class="text-end d-flex">
			<a href="{{route('gestor.plano.index')}}" class="btn btn-azul d-inline-block btn-min"><i class="fas fa-arrow-left" aria-hidden="true"></i> Meus Planos</a>
		</div>
	</div>
	<div class="rows">
	<div class="col-12 m-auto pb-4">
			<div class="px-md">
					<div class="" id="tabs">
						
						 @if(isset($planoempresa))    
                           <form action="{{route('gestor.planoempresa.update', $planoempresa->id)}}" method="POST">
                           <input name="_method" type="hidden" value="PUT"/>
                         @else                       
                        	<form action="{{route('gestor.planoempresa.store')}}" method="Post">
                        @endif
                        	@csrf
						<ul>
							<li><a href="#tab-1">Contrato</a></li>
							<li><a href="#tab-2">Recorrência</a></li>
						</ul>
						<div id="tab-1">
							<fieldset>
							<legend>Contrato</legend>	
									<div class="rows">
										<div class="col-6 mb-3">
											<label class="text-label">Empresa</label>
											<select name="empresa_id" class="form-campo">
												@foreach($empresas as $empresa)
													<option value="{{$empresa->id}}">{{$empresa->razao_social}}</option>
												@endforeach
											</select>
										</div>
										
										<div class="col-6 mb-3">
											<label class="text-label">Plano</label>
											<select name="plano_id" class="form-campo">
												@foreach($planos as $plano)
													<option value="{{$plano->id}}">{{$plano->nome}} - R$ {{$plano->valor}}</option>
												@endforeach
											</select>
										</div>
										
										
										<div class="col-3 mb-3">
											<label class="text-label">Data Aquisicao</label>
											<input type="date" name="data_aquisicao" value="{{($planoempresa->data_aquisicao) ?? date('Y-m-d')}}" class="form-campo" >
										</div>
										<div class="col-3 mb-3">
											<label class="text-label">Valor do contrato</label>
											<input type="text" name="valor_contrato" value="{{($planoempresa->valor_contrato) ?? old('valor_contrato')}}" class="form-campo" >
										</div>
										
										<div class="col-3 mb-3">
											<label class="text-label">Data do Vencimento</label>
											<input type="date" name="data_vencimento" value="{{($planoempresa->data_vencimento) ?? date('Y-m-d')}}" class="form-campo" >
										</div>
										<div class="col-3 mb-3">
											<label class="text-label">Recorrência</label>
											<select name="tipo_recorrencia" class="form-campo">
												@foreach(config('constantes.tipo_recorrencia') as $chave =>$valor)
													<option value="{{$valor}}">{{$chave}}</option>
												@endforeach
											</select>
										</div>
																	
									
									</div>
								</fieldset>	
							</div>	
							
							
						<div id="tab-2">
							<fieldset>
							<legend>Recorrência</legend>
								<div class="rows">
									<div class="col-3 mb-3">
										<label class="text-label">Data Inicial Recorrência</label>
                    					<input type="date" name="data_inicial_vencimento" value="{{($planoempresa->data_inicial_vencimento) ?? date('Y-m-d')}}" class="form-campo" >
									</div>
									<div class="col-3 mb-3">
										<label class="text-label">Valor Recorrente</label>
                    					<input type="text" name="valor_recorrente" value="{{($planoempresa->valor_recorrente) ?? old('valor_recorrente')}}" class="form-campo" >
									</div>
									
									<div class="col-3 mb-3">
										<label class="text-label">bloqueia qto tempo(dias)</label>
                    					<input type="text" name="dias_bloqueia" value="{{($planoempresa->dias_bloqueia) ?? old('dias_bloqueia')}}" class="form-campo" >
									</div>									
									
									<div class="col-3 mb-3">
										<label class="text-label">Forma Pagto Padrão</label>
										<select name="forma_pagto_id" class="form-campo">
											@foreach(config('constantes.forma_pagto') as $chave =>$valor)
												<option value="{{$valor}}">{{$chave}}</option>
											@endforeach
										</select>
									</div>
																
								
								</div>
							
							</fieldset>
							</div>
								<div class="col-2 m-auto pt-3">
    								<input type="hidden" name="id" value="{{($planoempresa->id) ?? old('id')}}" />
    								<input type="submit" value="Cadastrar plano" class="btn btn-azul width-100">
								</div>
						</form>
					
				</div>
				</div>
				</div>
				
				</section>
</div>
@endsection