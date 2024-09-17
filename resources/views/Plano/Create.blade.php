@extends("Gestor.template_gestor")
@section("conteudo")
<div class="conteudo">
	<section class="caixa">
			<div class="thead border-bottom mb-3 p-2">
				<div class="titulo mb-0"><i class="fas fa-list-alt"></i> Cadastrar novo plano</div>
				<div class="text-end d-flex">
					<a href="{{route('gestor.plano.index')}}" class="btn btn-verde d-inline-block mx-1"><i class="fas fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
					
				</div>
			</div>
				<div class="rows">
					<div class="col-6 m-auto">
					<fieldset>
						<legend>Inserir novo cadastro</legend>
						 @if(isset($plano))    
                           <form action="{{route('gestor.plano.update', $plano->id)}}" method="POST">
                           <input name="_method" type="hidden" value="PUT"/>
                         @else                       
                        	<form action="{{route('gestor.plano.store')}}" method="Post">
                        @endif
                        	@csrf
						
							
							<div class="rows">
								
								<div class="col-12">
								<div class="rows">
									<div class="col-12 mb-3">
										<label class="text-label">Nome</label>
                    					<input type="text" name="nome" value="{{($plano->nome) ?? old('nome')}}" class="form-campo" >
									</div>
									<div class="col-6 m-auto">
									<label class="text-label">Valor</label>
    									<input type="text" name="valor" value="{{($plano->valor) ?? old('valor')}}" class="form-campo" >
    								</div>
    								<div class="col-6 m-auto">
									<label class="text-label">Limite Usuário</label>
    									<input type="text" name="limite_usuario" value="{{($plano->valor) ?? old('valor')}}" class="form-campo" >
    								</div>
    								
    								<div class="col-6 m-auto">
									<label class="text-label">Limite NFE</label>
    									<input type="text" name="limite_nfe" value="{{($plano->valor) ?? old('valor')}}" class="form-campo" >
    								</div>
    								
    								<div class="col-6 m-auto">
									<label class="text-label">Valor</label>
    									<input type="text" name="valor" value="{{($plano->valor) ?? old('valor')}}" class="form-campo" >
    								</div>
								
								</div>
								</div>
							
								
								
								<div class="col-3 m-auto pt-3">
    								<input type="hidden" name="id" value="{{($plano->id) ?? old('id')}}" />
    								<input type="submit" value="Cadastrar" class="btn btn-azul width-100">
								</div>
								</div>
						</form>
						</fieldset>
					</div>
				</div>
				
	</section>
</div>
@endsection