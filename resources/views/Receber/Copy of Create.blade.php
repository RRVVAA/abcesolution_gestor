@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
<div class="thead border-bottom mb-3 p-2">
		<div class="titulo mb-0"><i class="fas fa-list-alt"></i> Cadastrar conta a receber</div>
		<div class="text-end d-flex">
			<a href="{{route('receber.index')}}" class="btn btn-azul d-inline-block btn-min"><i class="fas fa-arrow-left" aria-hidden="true"></i>voltar</a>
		</div>
	</div>
	<div class="rows">
		<div class="col-10 m-auto m-auto pb-4">
			<div class="px-md">
					<div class="card py-4" id="">
						 @if(isset($contar_receber))    
                           <form action="{{route('receber.update', $contar_receber->id)}}" method="POST">
                           <input name="_method" type="hidden" value="PUT"/>
                         @else                       
                        	<form action="{{route('receber.store')}}" method="Post">
                        @endif
                        	@csrf
							
							<div class="rows">
								
								<div class="col-12">
								<div class="rows">									
									
									<div class="col-6 mb-3">
										<label class="text-label">Empresa</label>
										@foreach($empresas as $e)
                    						<select name="empresa_id" class="form-campo" >
                    							<option value="{{$e->id}}">{{$e->razao_social}}</option>
                    						</select>
                    					@endforeach
									</div>
									
									<div class="col-6 mb-3">
										<label class="text-label">Descrição</label>
                    					<input type="text" name="descricao" value="{{($conta_receber->descricao) ?? old('descricao') }}" class="form-campo" >
									</div>
									
									<div class="col-3 mb-3">
										<label class="text-label">Data Lançamento</label>
                    					<input type="date" name="data_lancamento" value="{{($conta_receber->data_lancamento) ?? date('Y-m-d')  }}" class="form-campo" >
									</div>
									<div class="col-3 mb-3">
										<label class="text-label">Data Vencimento</label>
                    					<input type="date" name="data_vencimento"  value="{{($conta_receber->data_vencimento) ?? old('data_vencimento') }}" class="form-campo" >
									</div>
									<div class="col-3 mb-3">
										<label class="text-label">Valor</label>
                    					<input type="text" name="valor_a_receber"  value="{{($conta_receber->valor_a_receber) ?? old('valor_a_receber') }}" class="form-campo" >
									</div>									
									
									<div class="col-3 mb-3">
										<label class="text-label">Repete qtas vezes</label>
                    					<input type="number" name="repete"  value="1" class="form-campo" >
									</div>
									
								</div>
								</div>
								</div>
							
							
								<div class="col-3 m-auto">
    								<input type="submit" value="Cadastrar" class="btn btn-azul">
								</div>
						</form>
					</div>
				</div>
				</div>
			</div>
				
				</section>
</div>
@endsection