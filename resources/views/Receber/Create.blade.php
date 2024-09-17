@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
<div class="thead border-bottom mb-3 p-1">
		<div class="titulo mb-0"><i class="fas fa-list-alt"></i> Cadastro de Conta a Receber</div>
		<div class="text-end d-flex">
			<a href="{{route('receber.index')}}" class="btn btn-azul d-inline-block"><i class="fas fa-arrow-left" aria-hidden="true"></i> Voltar</a>
		</div>
	</div>
	<div class="rows">
	<div class="col-12 m-auto pb-4">
			<div class="px-md">
					<div class="" id="tabs">
						 <form action="{{route('receber.store')}}" method="Post">
                        	@csrf
					
						<div class="rows pb-4">
							<div class="col-6 m-auto">
								<div class="card py-4 mt-4">
								<div class="px-md">									
								<div class="rows">									
									<div class="col-12 mb-3">
										<label class="text-label">Empresa</label>
                    					
                    						<select name="empresa_id" class="form-campo" >
                    						@foreach($empresas as $e)
                    							<option value="{{$e->id}}">{{$e->razao_social}}</option>
                    							@endforeach
                    						</select>
                    					
									</div>
									<div class="col-12 mb-3">
										<label class="text-label">Descrição</label>
                    					<input type="text" required name="descricao" value="{{($conta_receber->descricao) ?? old('descricao')  }}" class="form-campo" >
									</div>
									<div class="col-6 mb-3">
										<label class="text-label">Data Lançamento</label>
                    					<input type="date" required name="data_lancamento" value="{{($conta_receber->data_lancamento) ?? date('Y-m-d')  }}" class="form-campo" >
									</div>
									
									<div class="col-6 mb-3">
										<label class="text-label">Data do Vencimento</label>
                    					<input type="date" required name="data_vencimento"  value="{{($conta_receber->data_vencimento) ?? old('data_vencimento') }}" class="form-campo" >
									</div>
									<div class="col-6 mb-3">
										<label class="text-label">Valor</label>
                    					<input type="text" required name="valor"  value="{{($conta_receber->valor) ?? old('valor') }}" class="form-campo mascara-float" >
									</div>
									<div class="col-6 mb-3">
										<label class="text-label">Repete</label>
                    					<input type="number" min="1"  name="repete" value="1" class="form-campo" >
									</div>	
									
									<div class="col-4 m-auto pt-3">
    								<input type="submit" value="Cadastrar" class="btn btn-azul width-100">
								</div>		
								</div>
								</div>
							</div>
						</div>
					</div>
					
						
								
						</form>
					</div>
				</div>
			</div>
		</div>
				
				</section>
</div>
@endsection