@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
		<div class="thead border-bottom mb-3 p-2">
				<div class="titulo mb-0"><i class="fas fa-list-alt"></i> Editar Conta a Pagar</div>
				<div class="text-end d-flex">
					<a href="{{route('pagar.index')}}" class="btn btn-verde d-inline-block mx-1"><i class="fas fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
					
				</div>
			</div>
			<div class="rows pb-4">
				<div class="col-9 m-auto">
				<div class="card py-4">
					<div class="px-md"> 
                            <form action="{{route('pagar.update', $conta_pagar->id)}}" method="POST">    
                            <input name="_method" type="hidden" value="PUT"/>                
                        	@csrf						
							
							<div class="rows">
									<div class="col-6 mb-3">
										<label class="text-label">Fornecedor</label>										
                						<select name="fornecedor_id" class="form-campo" >
                							@foreach($fornecedores as $e)
                								<option value="{{$e->id}}" {{($e->id ==$conta_pagar->fornecedor_id) ? 'selected' : ''}}>{{$e->razao_social}}</option>
                							@endforeach
                						</select>                    					
									</div>
									
									<div class="col-6 mb-3">
										<label class="text-label">Descrição</label>
                    					<input type="text" name="descricao" required value="{{($conta_pagar->descricao) ?? old('descricao') }}" class="form-campo" >
									</div>
									
									<div class="col-3 mb-3">
										<label class="text-label">Data Lançamento</label>
                    					<input type="date" name="data_lancamento" required value="{{($conta_pagar->data_lancamento) ?? date('Y-m-d')  }}" class="form-campo" >
									</div>
									<div class="col-3 mb-3">
										<label class="text-label">Data Vencimento</label>
                    					<input type="date" name="data_vencimento" required  value="{{($conta_pagar->data_vencimento) ?? old('data_vencimento') }}" class="form-campo" >
									</div>
									<div class="col-3 mb-3">
										<label class="text-label">Valor</label>
                    					<input type="text" name="valor_a_pagar" required value="{{($conta_pagar->valor_a_pagar) ?? old('valor_a_pagar') }}" class="form-campo" >
									</div>									
									
								
							
									<div class="col-4 m-auto">
										<input type="submit" value="Editar Contar" class="btn btn-azul width-100">
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