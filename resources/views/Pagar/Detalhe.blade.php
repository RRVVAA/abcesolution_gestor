<?php
use App\Service\ConstanteService;
?>
@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
<div class="thead border-bottom mb-3 p-1">
		<div class="titulo mb-0">
			<span><i class="fas fa-list-alt"></i> Contas a Pagar</span>
			<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <a href="{{route('pagar.index')}}" class="text-azul"> Lista de contas a pagar </a>  <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2"> Dar baixa</b></span>
		</div>
		<div class="text-end d-flex">
			<a href="{{route('pagar.create')}}" class="btn btn-azul d-inline-block mx-1"><i class="fas fa fa-plus-circle" aria-hidden="true"></i>  Adicionar Novo</a>
		</div>
	</div>
				<div class="px-md mb-4">
					<div class="caixa-form">
						    
                           
						
						<fieldset class="mb-3">
						<legend>Conta a Pagar</legend>	
							<div class="rows">
								
								<div class="col-12">
								<div class="rows">									
									
									<div class="col-3 mb-3">
										<label class="text-label">Fornecedor</label>
                    					<input type="text" readonly="readonly"  value="{{$conta_pagar->fornecedor->razao_social}}" class="form-campo" >
									</div>
									<div class="col-3 mb-3">
										<label class="text-label">Descrição</label>
                    					<input type="text" readonly="readonly"  value="{{$conta_pagar->descricao}}" class="form-campo" >
									</div>
									<div class="col-2 mb-3">
										<label class="text-label">Data Lançamento</label>
                    					<input type="date" readonly value="{{$conta_pagar->data_lancamento }}" class="form-campo" >
									</div>
									<div class="col-2 mb-3">
										<label class="text-label">Data do Vencimento</label>
                    					<input type="date" readonly value="{{ $conta_pagar->data_vencimento}}" class="form-campo" >
									</div>
									<div class="col-2">
										<label class="text-label">Data Pagamento</label>
                    					<input type="date" name="data_pagamento"  readonly value="{{ ($conta_pagar->pagamento->data_pagamento) ?? null }}" class="form-campo" >
									</div>
												
								
								</div>
								</div>
								</div>
							</fieldset>	
								
							<fieldset>
							<legend>Pagamento</legend>	
								<div class="rows">
								
								<div class="col-12">
								<div class="rows">
									
									
									
									<div class="col-3">
										<label class="text-label">Forma Pagto</label>
										<input type="text" name="forma_pagto"  readonly value="{{ ($conta_pagar->pagamento->forma_pagto->forma_pagto) ?? null }}" class="form-campo" >

									</div>
									<div class="col-3 mb-3">
                						<label class="text-label">Número Documento</label>
                						<input type="text" name="numero_documento"  readonly value="{{ ($conta_pagar->pagamento->numero_documento) ?? null }}" class="form-campo">												
                					</div>
                					<div class="col-6 mb-3">
                						<label class="text-label">Observação</label>
                						<input type="text" name="observacao"  readonly value="{{ ($conta_pagar->pagamento->observacao) ?? null }}" class="form-campo">												
                					</div>
                					<div class="col-3">
										<label class="text-label">Valor Original</label>
                    					<input type="text" id="total_a_pagar_final" readonly value="{{ ($conta_pagar->pagamento->valor_original) ?? null }}" class="form-campo" >
									</div>	
									<div class="col-2">
										<label class="text-label">Juros</label>
                    					<input type="text" readonly value="{{ ($conta_pagar->pagamento->juros) ?? null }}" class="form-campo" >
									</div>	
									<div class="col-2">
										<label class="text-label">Desconto</label>
                    					<input type="text"  readonly value="{{ ($conta_pagar->pagamento->desconto) ?? null }}" class="form-campo" >
									</div>	
									<div class="col-2">
										<label class="text-label">Multa</label>
                    					<input type="text"  readonly value="{{ ($conta_pagar->pagamento->multa) ?? null }}" class="form-campo" >
									</div>	
									<div class="col-3">
										<label class="text-label">Valor Pago</label>
                    					<input type="text"  readonly value="{{ ($conta_pagar->pagamento->valor_pago) ?? null }}" class="form-campo" >
									</div>
                						
									
																
								</div>
								</div>
							
								</div>
							
								
					</div>
				</div>
				
</section>
</div>

@endsection