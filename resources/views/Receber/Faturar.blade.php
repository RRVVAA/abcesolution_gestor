@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
<div class="thead border-bottom mb-3 p-1">
		<div class="titulo mb-0">
			<span><i class="fas fa-list-alt"></i> Contas a receber</span>
			<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <a href="{{route('receber.index')}}" class="text-azul"> Lista de contas a pagar </a>  <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2"> Dar baixa</b></span>
		</div>
		<div class="text-end d-flex">
			<a href="{{route('receber.index')}}" class="btn btn-azul2 d-inline-block" title="Voltar"><i class="fas fa-arrow-left" aria-hidden="true"></i></a>
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
                    					<input type="text"  id="valor_original" value="{{$conta_receber->valor}}" class="form-campo mascara-float" >
									</div>									
									
											
								</div>
							</fieldset>
							
							<fieldset>
							<legend>Recebimento</legend>	
								<div class="rows">									
									<div class="col-3 mb-3">
										<label class="text-label">Data Recebimento</label>
                    					<input type="date" name="data_recebimento" value="{{date('Y-m-d') }}" class="form-campo" >
									</div>
									<div class="col-3 mb-3">
										<label class="text-label">Forma Pagto</label>
										<select name="forma_pagto_id" class="form-campo">
											@foreach(config('constantes.forma_pagto') as $chave =>$valor)
												<option value="{{$valor}}">{{$valor}} - {{$chave}}</option>
											@endforeach
										</select>
									</div>
									
									<div class="col-6 mb-3">
										<label class="text-label">Observação</label>
                    					<input type="text" id="observacao" name="observacao"   class="form-campo" >
									</div>	
									
									<div class="col-2 mb-3">
										<label class="text-label">Número Documento</label>
                    					<input type="text" id="numero_documento" name="numero_documento"   class="form-campo" >
									</div>
									
									<div class="col-2 mb-3">
										<label class="text-label">Juros</label>
                    					<input type="text" id="juros" name="juros"   class="form-campo mascara-float" >
									</div>
									<div class="col-2 mb-3">
										<label class="text-label">Multa</label>
                    					<input type="text" id="multa" name="multa"  class="form-campo mascara-float" >
									</div>
									<div class="col-2 mb-3">
										<label class="text-label">Desconto</label>
                    					<input type="text" id="desconto" name="desconto"  value="0" class="form-campo mascara-float" >
									</div>
									<div class="col-3 mb-3">
										<label class="text-label">Valor a Receber</label>
                    					<input type="text" id="valor_a_receber" name="valor_a_receber" value="{{$conta_receber->valor}}" class="form-campo mascara-float" >
									</div>
									
									
									
								<div class="col-12 m-auto pt-2 text-center">
    								<input type="hidden" name="conta_receber_id" value="{{ $conta_receber->id }}" />
    								<input type="hidden" name="valor_original" value="{{ $conta_receber->valor }}" />
    								<input type="submit" value="Salvar Informações" class="btn btn-azul2 d-inline-block">
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
	var valor_original  = ($('#valor_original').val() !="") ? converteMoedaFloat($('#valor_original').val()) : parseFloat(0);
	var juros 			= ($('#juros').val() !="") ? converteMoedaFloat($('#juros').val()) : parseFloat(0);
	var multa 			= ($('#multa').val() !="") ? converteMoedaFloat($('#multa').val()) : parseFloat(0);
	var desconto 		= ($('#desconto').val() !="") ? converteMoedaFloat($('#desconto').val()) : parseFloat(0);	
	
	let total_a_receber = parseFloat(valor_original) + parseFloat(juros) + parseFloat(multa) - parseFloat(desconto);
	$('#valor_a_receber').val(converteFloatMoeda(total_a_receber));
	$('#valor_a_receber_final').val(converteFloatMoeda(total_a_receber));
}

</script>

@endsection