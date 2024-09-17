@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
<div class="thead border-bottom mb-3 p-1">
		<div class="titulo mb-0">
			<span><i class="fas fa-list-alt"></i> Contas a receber</span>
			<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <a href="{{route('receber.index')}}" class="text-azul"> Lista de contas a receber </a>  <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2"> Dar baixa</b></span>
		</div>
		<div class="text-end d-flex">
			<a href="{{route('receber.index')}}" class="btn btn-azul d-inline-block"><i class="fas fa-arrow-left" aria-hidden="true"></i> Voltar</a>
		</div>
	</div>
	<div class="rows">
	<div class="col-12 m-auto pb-4">
			<div class="px-md">
					<div class="" id="tabs">
                           <form action="{{route('receber.receber')}}" method="POST">                        
                        	@csrf
						
						<div id="tab-1">
						<fieldset class="mb-3">
						<legend>Conta a Receber</legend>	
							<div class="rows">
									<div class="col-3 mb-3">
										<label class="text-label">Empresa</label>
                    					<input type="text" value="{{$conta_receber->empresa->razao_social }}" class="form-campo" >
									</div>
									<div class="col-3 mb-3">
										<label class="text-label">Descrição</label>
                    					<input type="text" value="{{$conta_receber->descricao }}" class="form-campo" >
									</div>
									<div class="col-2 mb-3">
										<label class="text-label">Data Lançamento</label>
                    					<input type="date" value="{{$conta_receber->data_lancamento }}" class="form-campo" >
									</div>																	
									
									<div class="col-2 mb-3">
										<label class="text-label">Data do Vencimento</label>
                    					<input type="date"  value="{{ $conta_receber->data_vencimento}}" class="form-campo" >
									</div>
									<div class="col-2 mb-3">
										<label class="text-label">Valor original</label>
                    					<input type="text"  id="valor_original" value="{{$conta_receber->valor}}" class="form-campo" >
									</div>									
									
											
								</div>
							</fieldset>
							
							<fieldset>
							<legend>Recebimento</legend>	
								<div class="rows">
									
									
									
									<div class="col-3">
										<label class="text-label">Forma Pagto</label>
										<input type="text" name="forma_pagto"  readonly value="{{ ($conta_receber->recebimento->forma_pagto->forma_pagto) ?? null }}" class="form-campo" >
									</div>
									<div class="col-3 mb-3">
                						<label class="text-label">Número Documento</label>
                						<input type="text" name="numero_documento"  readonly value="{{ ($conta_receber->recebimento->numero_documento) ?? null }}" class="form-campo">												
                					</div>
                					<div class="col-6 mb-3">
                						<label class="text-label">Observação</label>
                						<input type="text" name="observacao"  readonly value="{{ ($conta_receber->recebimento->observacao) ?? null }}" class="form-campo">												
                					</div>
                					<div class="col-3">
										<label class="text-label">Valor Original</label>
                    					<input type="text" id="total_a_receber_final" readonly value="{{ ($conta_receber->recebimento->valor_original) ?? null }}" class="form-campo" >
									</div>	
									<div class="col-2">
										<label class="text-label">Juros</label>
                    					<input type="text" readonly value="{{ ($conta_receber->recebimento->juros) ?? null }}" class="form-campo" >
									</div>	
									<div class="col-2">
										<label class="text-label">Desconto</label>
                    					<input type="text"  readonly value="{{ ($conta_receber->recebimento->desconto) ?? null }}" class="form-campo" >
									</div>	
									<div class="col-2">
										<label class="text-label">Multa</label>
                    					<input type="text"  readonly value="{{ ($conta_receber->recebimento->multa) ?? null }}" class="form-campo" >
									</div>	
									<div class="col-3">
										<label class="text-label">Valor Recebido</label>
                    					<input type="text"  readonly value="{{ ($conta_receber->recebimento->valor_recebido) ?? null }}" class="form-campo" >
									</div>
                						
									
																
								</div>
							</fieldset>
					</div>
					
						
						</form>
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