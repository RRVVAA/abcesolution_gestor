@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
<div class="thead border-bottom mb-3 p-2">
		<div class="titulo mb-0"><i class="fas fa-list-alt"></i> Editar Conta a Receber</div>
		<div class="text-end d-flex">
			<a href="{{route('receber.index')}}" class="btn btn-azul d-inline-block btn-min"><i class="fas fa-arrow-left" aria-hidden="true"></i> Meus Planos</a>
		</div>
	</div>
	<div class="rows">
	<div class="col-12 m-auto pb-4">
			<div class="px-md">
					<div class="" id="tabs">
						 <form action="{{route('receber.update', $conta_receber->id)}}" method="POST">    
                            <input name="_method" type="hidden" value="PUT"/>                
                        	@csrf	
					
						<div id="tab-1">
						<fieldset>
						<legend>Conta a Receber</legend>	
							<div class="rows">									
									<div class="col-6 mb-3">
										<label class="text-label">Empresa</label>
                    					
                    						<select name="empresa_id" class="form-campo" >
                    						@foreach($empresas as $e)
                    							<option value="{{$e->id}}" {{($e->id ==$conta_receber->empresa_id) ? 'selected' : ''}}>{{$e->razao_social}}</option>
                    							@endforeach
                    						</select>
                    					
									</div>
									<div class="col-6 mb-3">
										<label class="text-label">Descrição</label>
                    					<input type="text"  name="descricao" value="{{($conta_receber->descricao) ?? old('descricao')  }}" class="form-campo" >
									</div>
									<div class="col-3 mb-3">
										<label class="text-label">Data Lançamento</label>
                    					<input type="date" name="data_lancamento" value="{{($conta_receber->data_lancamento) ?? date('Y-m-d')  }}" class="form-campo" >
									</div>
									
									<div class="col-3 mb-3">
										<label class="text-label">Data do Vencimento</label>
                    					<input type="date" name="data_vencimento"  value="{{($conta_receber->data_vencimento) ?? old('data_vencimento') }}" class="form-campo" >
									</div>
									<div class="col-3 mb-3">
										<label class="text-label">Valor</label>
                    					<input type="text" name="valor"  value="{{($conta_receber->valor) ?? old('valor') }}" class="form-campo mascara-float" >
									</div>
																
											
								</div>
							</fieldset>
					</div>
					
						
								<div class="col-3 m-auto pt-4">
    								<input type="submit" value="Editar Conta" class="btn btn-azul width-100">
								</div>
						</form>
					</div>
				</div>
			</div>
		</div>
				
				</section>
</div>
@endsection