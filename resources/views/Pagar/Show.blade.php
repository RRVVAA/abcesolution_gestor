<?php
use App\Service\ConstanteService;
?>
@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
<div class="thead border-bottom mb-3 p-1	">
		<div class="titulo mb-0">
			<span><i class="fas fa-list-alt"></i> Contas a Pagar</span>
			<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <a href="{{route('pagar.index')}}" class="text-azul"> Lista de contas a pagar </a>  <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2"> Visualizar conta</b></span>
		</div>
		
	</div>
				<div class="px-md mb-4">
					<div class="caixa-form">
						    
						<fieldset class="mb-3">
						<legend>Conta a Pagar</legend>	
							<div class="rows">
								
								<div class="col-12">
								<div class="rows">	
									<div class="col-3 mb-3 border-bottom">
										<label class="text-label">Fornecedor</label>
                    					<input type="text" readonly="readonly"  value="{{$conta_pagar->fornecedor->razao_social}}" class="form-campo limpo px-0" >
									</div>
									<div class="col-3 mb-3 border-bottom">
										<label class="text-label">Data Lançamento</label>
                    					<input type="date" readonly value="{{$conta_pagar->data_lancamento }}" class="form-campo limpo px-0" >
									</div>
									<div class="col-3 mb-3 border-bottom">
										<label class="text-label">Valor Original </label>
                    					<input type="text" readonly id="valor_original"  value="{{$conta_pagar->valor_original}}" class="form-campo limpo px-0" >
									</div>									
									
									<div class="col-3 mb-3 border-bottom">
										<label class="text-label">Data do Vencimento</label>
                    					<input type="date" readonly value="{{ $conta_pagar->data_vencimento}}" class="form-campo limpo px-0" >
									</div>
									<div class="col-3 mb-3 border-bottom">
										<label class="text-label">Juros</label>
                    					<input type="text" id="juros" name="juros"  value="{{$conta_pagar->juros}}" class="form-campo limpo px-0" >
									</div>
									<div class="col-3 mb-3 border-bottom">
										<label class="text-label">Multa</label>
                    					<input type="text" id="multa" name="multa" value="{{$conta_pagar->multa}}" class="form-campo limpo px-0" >
									</div>
									<div class="col-3 mb-3 border-bottom">
										<label class="text-label">Desconto</label>
                    					<input type="text" id="desconto" name="desconto"  value="{{$conta_pagar->desconto}}" class="form-campo limpo px-0" >
									</div>
									<div class="col-3 mb-3 border-bottom">
										<label class="text-label">Valor a Pagar</label>
                    					<input type="text" id="valor_pagar" readonly value="{{$conta_pagar->valor_a_pagar}}" class="form-campo limpo px-0" >
									</div>
									<div class="col-3">
										<label class="text-label">Data Pagamento</label>
                    					<input type="date" readonly="readonly" name="data_pagamento" value="{{$conta_pagar->data_pagamento}}" class="form-campo limpo px-0" >
									</div>
									<div class="col-3">
										<label class="text-label">Forma Pagto</label>
                    					<input type="text" name="data_pagamento" value="{{$conta_pagar->forma_pagto}}" class="form-campo limpo px-0" >
									</div>
									
									<div class="col-3">
										<label class="text-label">Valor Pago</label>
                    					<input type="text" id="total_a_pagar_final" name="total_a_pagar_final"value="{{$conta_pagar->valor_a_pagar}}" class="form-campo limpo px-0" >
									</div>								
								
								</div>
								</div>
								</div>
							</fieldset>									
															
					</div>
				</div>
				
				</section>

@endsection