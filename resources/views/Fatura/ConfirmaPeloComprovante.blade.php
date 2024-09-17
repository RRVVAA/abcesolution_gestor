<?php
use App\Service\ConstanteService;
?>
@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
<div class="thead border-bottom mb-3 p-1	">
		<div class="titulo mb-0">
			<span><i class="fas fa-list-alt"></i> Baixar Fatura pelo Comprovante</span>
			<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <a href="{{route('fatura.index')}}" class="text-azul"> Lista de fatura </a>  <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2"> Dar baixa</b></span>
		</div>
		<div class="text-end d-flex">
			<a href="{{route('comprovante.index')}}" class="btn btn-azul2 d-inline-block ml-1" title="Voltar"><i class="fas fa fa-arrow-left" aria-hidden="true"></i></a>
		</div>
	</div>
				<div class="px-md mb-4">
					<div class="caixa-form">
						    
                           <form action="{{route('fatura.baixarPeloComprovante')}}" method="POST">                        
                        	@csrf
						
						<fieldset class="mb-3">
						<legend>Dados do Comprovante</legend>	
							<div class="rows">
								
								<div class="col-12">
								<div class="rows">								
									
									
									<div class="col-3 mb-3">
										<label class="text-label">Descrição</label>
                    					<input type="text" readonly="readonly"  value="{{$comprovante->descricao}}" class="form-campo" >
									</div>
									<div class="col-2 mb-3">
										<label class="text-label">Data Lançamento</label>
                    					<input type="date" readonly value="{{$comprovante->data_emissao }}" class="form-campo" >
									</div>
									<div class="col-2 mb-3">
										<label class="text-label">Data do Pagamento</label>
                    					<input type="date" readonly value="{{ $comprovante->data_pagamento}}" class="form-campo" >
									</div>
									<div class="col-2 mb-3">
										<label class="text-label">Valor Pago </label>
                    					<input type="text" readonly   value="{{$comprovante->valor_pago}}" class="form-campo mascara-float" >
									</div>
									<div class="col-2 mt-3 text-center">
										<a href="{{getenv('APP_URL_ERP') . $comprovante->nome_arquivo}}" class="btn btn-azul2 d-inline-block">Ver Comprovante</a>
        								
    								</div>
									
																
								
								</div>
								</div>
								</div>
							</fieldset>	
								
							<fieldset>
							<legend>Confirmação Pagamento da Fatura</legend>	
								<div class="rows">
								
								<div class="col-12">
								<div class="rows">
									
									
									<div class="col-2">
										<label class="text-label">Data Pagamento</label>
                    					<input type="date" name="data_pagamento" value="{{date('Y-m-d') }}" class="form-campo" >
									</div>									
                            
									
                					<div class="col-6 mb-3">
                						<label class="text-label">Observação</label>
                						<input type="text" readonly="readonly"  id="observacao" class="form-campo">												
                					</div>	
                					<div class="col-3 mb-3">
                						<label class="text-label">Número Documento</label>
                						<input type="text" readonly="readonly"  id="numero_documento" class="form-campo">												
                					</div>
                					<div class="col-2 mb-3">
										<label class="text-label">Juros</label>
                    					<input type="text" readonly="readonly"  class="form-campo mascara-float" >
									</div>
									<div class="col-2 mb-3">
										<label class="text-label">Multa</label>
                    					<input type="text" readonly="readonly"  class="form-campo mascara-float" >
									</div>
									<div class="col-2 mb-3">
										<label class="text-label">Desconto</label>
                    					<input type="text" readonly="readonly"   class="form-campo mascara-float" >
									</div>
									<div class="col-2 mb-3">
										<label class="text-label">Valor Fatura</label>
                    					<input type="text" name="valor" value="{{$fatura->valor}}" class="form-campo mascara-float" >
									</div>
									
									<div class="col-12 mt-3 text-center">
        								<input type="hidden" name="fatura_id" value="{{ $fatura->id }}" />
        								<input type="hidden" name="comprovante_id" value="{{ $comprovante->id }}" />
        								<input type="hidden" name="empresa_id" value="{{ $fatura->empresa_id }}" />
        								<input type="submit" value="Confirmar Pagamento" class="btn btn-azul2 d-inline-block">
    								</div>							
								</div>
								</div>
							
								</div>
							
								
						</form>
					</div>
				</div>
				
</section>
</div>
<script>
$(function () {
	$('#juros').on('keyup', () => {
		atualizaTotalPagamento()
	})

    $('#multa').on('keyup', () => {
    	atualizaTotalPagamento()
    })
    
    $('#desconto').on('keyup', () => {
    	atualizaTotalPagamento()
    })
});

function atualizaTotalPagamento() {
	var valor_original  = ($('#valor_original').val() !="") ? converteMoedaFloat($('#valor_original').val()) : parseFloat(0);
	var juros 			= ($('#juros').val() !="") ? converteMoedaFloat($('#juros').val()) : parseFloat(0);
	var multa 			= ($('#multa').val() !="") ? converteMoedaFloat($('#multa').val()) : parseFloat(0);
	var desconto 		= ($('#desconto').val() !="") ? converteMoedaFloat($('#desconto').val()) : parseFloat(0);
	
	let total_a_fatura =  parseFloat(valor_original) + parseFloat(juros) + parseFloat(multa) - parseFloat(desconto);
	
	$('#valor_fatura').val(converteFloatMoeda(total_a_fatura));
}



</script>
@endsection