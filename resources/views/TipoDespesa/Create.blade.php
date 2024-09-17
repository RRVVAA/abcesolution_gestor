@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
				<div class="titulo p-2"><i class="fas fa-list-alt"></i> Cadastro de Modulo</div>
				<div class="px-md">
					<div class="card">
						<div class="rows">
							<div class="col-6 m-auto">
							<fieldset>
								<legend>Inserir novo cadastro</legend>
								 @if(isset($modulo))    
								   <form action="{{route('modulo.update', $modulo->id)}}" method="POST">
								   <input name="_method" type="hidden" value="PUT"/>
								 @else                       
									<form action="{{route('modulo.store')}}" method="Post">
								@endif
									@csrf
								
									
									<div class="rows">
											<div class="col-12 mb-3">
												<label class="text-label">Nome</label>
												<input type="text" name="nome" value="{{($modulo->nome) ?? old('nome')}}" class="form-campo" >
											</div>		
																			
										<div class="col-3  m-auto">
											<input type="hidden" name="id" value="{{($modulo->id) ?? old('id')}}" />
											<input type="submit" value="Cadastrar" class="btn btn-azul width-100">
										</div>
										</div>
								</form>
								</fieldset>
							</div>
						</div>
					</div>
				</div>
				
		</section>
</div>
@endsection