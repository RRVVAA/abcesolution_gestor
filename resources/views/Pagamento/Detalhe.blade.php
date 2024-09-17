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
			<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <a href="{{route('pagar.index')}}" class="text-azul"> Lista de contas a pagar </a>  <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2"> Dar baixa</b></span>
		</div>
		<div class="text-end d-flex">
			<a href="{{route('pagamento.index')}}" class="btn btn-azul2 d-inline-block ml-1" title="Voltar"><i class="fas fa fa-arrow-left" aria-hidden="true"></i></a>
		</div>
	</div>
				<div class="px-md mb-4">
					<div class="caixa-form">
						    
                           <form action="{{route('pagar.pagar')}}" method="POST">                        
                        	@csrf
						
						<fieldset class="mb-3">
						<legend>Conta a Pagar</legend>	
							<div class="rows">
								
								<div class="col-12">
								<div class="rows">									
									
									<div class="col-3 mb-3">
										<label class="text-label">Fornecedor</label>
                    					<input type="text" readonly="readonly"  value="{{$conta_pagar->fornecedor->razao_social ?? null }}" class="form-campo" >
									</div>
									<div class="col-3 mb-3">
										<label class="text-label">Descrição</label>
                    					<input type="text" readonly="readonly"  value="{{$conta_pagar->descricao  ?? null }}" class="form-campo" >
									</div>
									<div class="col-2 mb-3">
										<label class="text-label">Data Lançamento</label>
                    					<input type="date" readonly value="{{$conta_pagar->data_lancamento  ?? null }}" class="form-campo" >
									</div>
									<div class="col-2 mb-3">
										<label class="text-label">Data do Vencimento</label>
                    					<input type="date" readonly value="{{ $conta_pagar->data_vencimento  ?? null }}" class="form-campo" >
									</div>
									<div class="col-2 mb-3">
										<label class="text-label">Valor Original </label>
                    					<input type="text" readonly id="valor_original"  value="{{$conta_pagar->valor  ?? null }}" class="form-campo mascara-float" >
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
									
									
									<div class="col-2">
										<label class="text-label">Data Pagamento</label>
                    					<input type="date" name="data_pagamento" value="{{$pagamento->data_pagamento  ?? null  }}" class="form-campo" >
									</div>
									<div class="col-4">
										<label class="text-label">Forma Pagto</label>
										<select name="forma_pagto_id" class="form-campo">
											@foreach(config('constantes.forma_pagto') as $chave =>$valor)
												<option value="{{$valor}}">{{$valor}} - {{$chave}}</option>
											@endforeach
										</select>
									</div>
									
									
                					<div class="col-6 mb-3">
                						<label class="text-label">Observação</label>
                						<input type="text" name="observacao" value="{{$pagamento->observacao  ?? null  }}" id="observacao" class="form-campo">												
                					</div>	
                					<div class="col-3 mb-3">
                						<label class="text-label">Número Documento</label>
                						<input type="text" name="numero_documento" value="{{$pagamento->numero_documento  ?? null  }}"  id="numero_documento" class="form-campo">												
                					</div>
                					<div class="col-2 mb-3">
										<label class="text-label">Juros</label>
                    					<input type="text" id="juros" name="juros" value="{{$pagamento->juros  ?? null  }}"  class="form-campo mascara-float" >
									</div>
									<div class="col-2 mb-3">
										<label class="text-label">Multa</label>
                    					<input type="text" id="multa" name="multa" value="{{$pagamento->multa  ?? null  }}" class="form-campo mascara-float" >
									</div>
									<div class="col-2 mb-3">
										<label class="text-label">Desconto</label>
                    					<input type="text" id="desconto" name="desconto" value="{{$pagamento->desconto  ?? null  }}"  class="form-campo mascara-float" >
									</div>
									<div class="col-2 mb-3">
										<label class="text-label">Valor a Pagar</label>
                    					<input type="text" id="valor_pagar" name="valor_pagar" value="{{$pagamento->valor_pago ?? null}}" class="form-campo mascara-float" >
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
	
	let total_a_pagar = parseFloat(valor_original) + parseFloat(juros) + parseFloat(multa) - parseFloat(desconto);
	$('#valor_pagar').val(converteFloatMoeda(total_a_pagar));
	$('#total_a_pagar_final').val(converteFloatMoeda(total_a_pagar));
}


</script>
@endsection