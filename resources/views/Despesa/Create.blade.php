@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
			<div class="thead border-bottom mb-3 p-1">
				<div class="titulo mb-0"><i class="fas fa-list-alt"></i> Cadastrar Despesa</div>
				<div class="text-end d-flex">
					<a href="{{route('despesa.index')}}" class="btn btn-azul2 d-inline-block ml-1"><i class="fas fa fa-arrow-left" aria-hidden="true"></i></a>
					
				</div>
			</div>
			<div class="rows pb-4">
				<div class="col-6 m-auto">
				<div class="card py-4 mt-4">
					<div class="px-md">
						@if(isset($despesa))    
                           <form action="{{route('despesa.update', $despesa->id)}}" method="POST">
                           <input name="_method" type="hidden" value="PUT"/>
                         @else                       
                        	<form action="{{route('despesa.store')}}" method="Post">
                        @endif
                        	@csrf
	                  
	                  @php
	                  	$id_fornecedor = ($despesa->fornecedor_id) ?? null;
	                  	$id_tipo 	  = ($despesa->tipo_despesa_id) ?? null;
	                  @endphp
							
							<div class="rows">
									<div class="col-12 mb-3">
										<label class="text-label">Fornecedor</label>										
                						<select name="fornecedor_id" class="form-campo" >
                							@foreach($fornecedores as $e)
                								<option value="{{$e->id}}" {{($e->id==$id_fornecedor) ? 'selected' : ''}}>{{$e->razao_social}}</option>
                							@endforeach
                						</select>
                    					
									</div>
									
									<div class="col-12 mb-3">
										<label class="text-label">Tipo Despesa</label>										
                						<select name="tipo_despesa_id" class="form-campo" >
                							@foreach($tipos as $t)
                								<option value="{{$t->id}}" {{($t->id==$id_tipo) ? 'selected' : ''}}>{{$t->nome}}</option>
                							@endforeach
                						</select>
                    					
									</div>
									
									<div class="col-12 mb-3">
										<label class="text-label">Descrição</label>
                    					<input type="text" name="descricao" required value="{{($despesa->descricao) ?? old('descricao') }}" class="form-campo" >
									</div>
									
									<div class="col-6 mb-3">
										<label class="text-label">Data Lançamento</label>
                    					<input type="date" name="data_lancamento" required value="{{($despesa->data_lancamento) ?? date('Y-m-d')  }}" class="form-campo" >
									</div>
									<div class="col-6 mb-3">
										<label class="text-label">Data Vencimento</label>
                    					<input type="date" name="data_vencimento" required value="{{($despesa->data_vencimento) ?? old('data_vencimento') }}" class="form-campo" >
									</div>
									<div class="col-6 mb-3">
										<label class="text-label">Valor</label>
                    					<input type="text" name="valor" required value="{{($despesa->valor) ?? old('valor') }}" class="form-campo mascara-float" >
									</div>									
								@if(!isset($despesa))  	
									<div class="col-6 mb-3">
										<label class="text-label">Repete qtas vezes</label>
                    					<input type="number" name="repete"  value="1" class="form-campo" >
									</div>
								@endif
								
									<div class="col-4 m-auto pt-3">									
										<input type="submit" value="Salvar Dados" class="btn btn-azul width-100">
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