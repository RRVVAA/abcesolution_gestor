<?php
use App\Service\ConstanteService;
?>
@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
<div class="thead border-bottom mb-3 p-1	">
		<div class="titulo mb-0">
			<span><i class="fas fa-list-alt"></i> Editar Fatura: {{zeroEsquerda($fatura->id, 4)}} </span>
			<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <a href="{{route('fatura.index')}}" class="text-azul"> Fatura </a>  <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2"> Editar</b></span>
		</div>
		<div class="text-end d-flex">
			<a href="{{route('fatura.create')}}" class="btn btn-azul d-inline-block ml-1" title="Adicionar Novo"><i class="fas fa fa-plus-circle" aria-hidden="true"></i></a>
			<a href="{{route('fatura.index')}}" class="btn btn-azul2 d-inline-block ml-1" title="Voltar"><i class="fas fa fa-arrow-left" aria-hidden="true"></i></a>
		</div>
	</div>
				<div class="px-md mb-4">
					<div class="caixa-form">
						    <form action="{{route('fatura.update', $fatura->id)}}" method="POST">
   							<input name="_method" type="hidden" value="PUT"/>                       
                        	@csrf
				
							<fieldset>
							<legend>Dados da Fatura</legend>	
								<div class="rows">
								
								<div class="col-12">
								<div class="rows">
									
									
									<div class="col-2">
										<label class="text-label">Data Vencimento</label>
                    					<input type="date" name="data_vencimento" value="{{$fatura->data_vencimento }}" class="form-campo" >
									</div>
									<div class="col-3">
										<label class="text-label">Forma Pagto</label>
										<select name="forma_pagto_id" class="form-campo">
											@foreach(config('constantes.forma_pagto') as $chave =>$valor)
												<option value="{{$valor}}">{{$valor}} - {{$chave}}</option>
											@endforeach
										</select>
									</div>
									
									
                					<div class="col-4 mb-3">
                						<label class="text-label">Observação</label>
                						<input type="text" name="observacao"  id="observacao" value="{{$fatura->observacao}}" class="form-campo">												
                					</div>	
                					
                					<div class="col-2 mb-3">
										<label class="text-label">Valor </label>
									<input type="text"  name="valor" id="valor"  value="{{$fatura->valor}}" class="form-campo mascara-float" >
									</div>
									
                					
									
									
									<div class="col-12 mt-3 text-center">
        								<input type="submit" value="Salvar Fatura" class="btn btn-azul2 d-inline-block">
    								</div>							
								</div>
								</div>
							
								</div>
							</fieldset>
								
						</form>
					</div>
				</div>
				
</section>
</div>

@endsection