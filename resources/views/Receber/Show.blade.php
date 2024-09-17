@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
<div class="thead border-bottom mb-3 p-2">
			<div class="titulo mb-0">
			<span><i class="fas fa-list-alt"></i> Contas a receber</span>
			<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <a href="{{route('receber.index')}}" class="text-azul"> Lista de contas a receber </a>  <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2"> Visualizar conta</b></span>
		</div>
	</div>
	<div class="rows">
	<div class="col-12 m-auto pb-4">
			<div class="px-md">
					<div class="" id="tabs">                          
						
						<div id="tab-1">
						<fieldset>
						<legend>Conta a Receber</legend>	
							<div class="rows">
									<div class="col-3 mb-3 border-bottom">
										<label class="text-label">Empresa</label>
                    					<input type="text" readonly="readonly" value="{{$conta_receber->empresa->razao_social }}" class="form-campo limpo px-0" >
									</div>
																		
									<div class="col-3 mb-3 border-bottom">
										<label class="text-label">Data Lançamento</label>
                    					<input type="date" readonly value="{{$conta_receber->data_lancamento }}" class="form-campo limpo px-0" >
									</div>
									<div class="col-3 mb-3 border-bottom">
										<label class="text-label">Valor original</label>
                    					<input type="text"  id="valor_original" value="{{$conta_receber->valor_a_receber}}" class="form-campo limpo px-0" >
									</div>									
									
									<div class="col-3 mb-3 border-bottom">
										<label class="text-label">Data do Vencimento</label>
                    					<input type="date"  readonly="readonly" value="{{ $conta_receber->data_vencimento}}" class="form-campo limpo px-0" >
									</div>
									<div class="col-3 mb-3 border-bottom">
										<label class="text-label">Juros</label>
                    					<input type="text" id="juros" name="juros"  value="{{$conta_receber->juros}}" class="form-campo limpo px-0" >
									</div>
									<div class="col-3 mb-3 border-bottom">
										<label class="text-label">Multa</label>
                    					<input type="text" readonly name="multa" value="{{$conta_receber->multa}}" class="form-campo limpo px-0" >
									</div>
									<div class="col-3 mb-3 border-bottom">
										<label class="text-label">Desconto</label>
                    					<input type="text" readonly name="desconto"  value="{{$conta_receber->desconto}}" class="form-campo limpo px-0" >
									</div>
									<div class="col-3 mb-3 border-bottom">
										<label class="text-label">Valor a Receber</label>
                    					<input type="text" readonly  value="{{$conta_receber->valor_a_receber}}" class="form-campo limpo px-0" >
									</div>
									<div class="col-3 mb-3">
										<label class="text-label">Data Recebimento</label>
                    					<input type="date" readonly name="data_recebimento" value="{$conta_receber->data_recebimento}}" class="form-campo limpo px-0" >
									</div>
									<div class="col-3 mb-3">
										<label class="text-label">Forma Pagto</label>
										<input type="text"   value="{{$conta_receber->forma_pagto}}" class="form-campo limpo px-0" >

									</div>
									<div class="col-3 mb-3">
										<label class="text-label">Valor a Receber</label>
                    					<input type="text" id="valor_a_receber_final" name="valor_a_receber_final"  value="{{$conta_receber->valor_a_receber}}" class="form-campo limpo px-0" >
									</div>		
								</div>
							</fieldset>
							
					</div>
					
						
								
						
					</div>
				</div>
			</div>
		</div>
				
				</section>
</div>

<script>
$(function () {
	$('#juros').on('keyup', () => {
		atualizaTotalRecebimento()
	})

    $('#multa').on('keyup', () => {
    	atualizaTotalRecebimento()
    })
    
    $('#desconto').on('keyup', () => {
    	atualizaTotalRecebimento()
    })
});

function atualizaTotalRecebimento() {
	var valor_original 	= ($('#valor_original').val() !="") ? parseFloat($('#valor_original').val()) : parseFloat(0);
	var juros 			= ($('#juros').val() !="") ? parseFloat($('#juros').val()) : parseFloat(0);
	var multa 			= ($('#multa').val() !="") ? parseFloat($('#multa').val()) : parseFloat(0);
	var desconto 		= ($('#desconto').val() !="") ? parseFloat($('#desconto').val()) : parseFloat(0);
	
	let total_a_receber = valor_original + juros + multa-desconto;	
	$('#valor_a_receber').val(total_a_receber);
	$('#valor_a_receber_final').val(total_a_receber);
}



</script>

@endsection