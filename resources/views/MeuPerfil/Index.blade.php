@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
	<div class="thead border-bottom mb-3 p-1">	
		<div class="titulo mb-0"><i class="fas fa-user"></i> Meu Perfil</div>
		<div class="text-end d-flex">
			<a href="{{route('index')}}" class="btn btn-azul d-inline-block btn-min" title="Voltar"><i class="fas fa fa-arrow-left" aria-hidden="true"></i></a>
		</div>
	</div>
				<div class="rows">
				<div class="col-9 m-auto pb-4">
				<div class="">
					<fieldset class="px-md pb-4">
						<legend class="mb-4 h5">Meus Dados</legend>
						   
                           <form action="{{route('meuperfil.update', $usuario->id)}}" method="POST" enctype="multipart/form-data">
                           <input name="_method" type="hidden" value="PUT"/>                       
                        	@csrf
						
							
							<div class="rows">
								<div class="col-3 mb-3">
									<label class="banner-thumb">	
									@if(!$usuario->foto)
    									<img src="{{asset('assets/gestor/img/img-usuario.png')}}" class="img-fluido" id="imgUp">
    								@else									
    									<img src="{{ url($usuario->foto) }}" class="img-fluido" id="imgUp">
    								@endif	
										<input type="file" name="file" id="img_perfil" onChange="valida_imagem('img_perfil')" class="d-none">
										<span class="">Carregar foto</span>
									</label>
								</div>
								<div class="col-9">
								<div class="rows">
									<div class="col-12 mb-3">
										<label class="text-label">Nome</label>
                    					<input type="text" name="razao_social" id="razao_social" value="{{($usuario->razao_social) ?? old('razao_social')}}" class="form-campo" >
									</div>									
								
									<div class="col-3 mb-3">
										<label class="text-label">Cep</label>
                    					<input type="text" name="cep" id="cep" value="{{($usuario->cep) ?? old('cep')}}" class="form-campo busca_cep mascara-cep" >
									</div>
									
									<div class="col-9 mb-3">				
										<label class="text-label">Endereço</label>
                    					<input type="text" name="logradouro" value="{{($usuario->logradouro) ?? old('logradouro')}}" class="form-campo rua" >
									</div>
									<div class="col-9 mb-3">
    									<label class="text-label">Bairro</label>
                        					<input type="text" name="bairro"  id="bairro"value="{{($usuario->bairro) ?? old('bairro')}}" class="form-campo bairro" >
    								</div>
    								<div class="col-3 mb-3">
    									<label class="text-label">Número</label>
                        					<input type="text" name="numero" id="numero" value="{{($usuario->numero) ?? old('numero')}}" class="form-campo" >
    								</div>
																
								</div>
								</div>
								
							<div class="col-12">
								<div class="rows">				
								
								<div class="col-6 mb-3">
									<label class="text-label">Cidade</label>
                    					<input type="text" name="cidade" id="cidade" value="{{($usuario->cidade) ?? old('cidade')}}" class="form-campo cidade" >
								</div>	
							
								<div class="col-2 mb-3">
									<label class="text-label">UF</label>	
									<input type="text" name="uf" id="uf" value="{{($usuario->uf) ?? old('uf')}}" class="form-campo estado" >
														
								</div>								
								
            					<div class="col-4 mb-3">
            							<label class="text-label">Celular</label>	
            							<input type="text" name="fone"  id="fone" value="{{isset($usuario->fone) ? $usuario->celular : old('celular') }}"  class="form-campo mascara-celular">
            					</div>            										
								
								
								<div class="col-8 mb-3">
									<label class="text-label">Email</label>
									<input type="text" name="email" required id="email" value="{{($usuario->email) ?? old('email')}}" class="form-campo" >
								</div>
								<div class="col-4 mb-3">
									<label class="text-label">Senha</label>
									<input type="text" name="password"  id="email"  class="form-campo" >
								</div>
								
								<div class="col-12">
    								<input type="hidden" name="id" value="{{($usuario->id) ?? old('id')}}" />
    								<input type="submit" value="Atualizar dados" class="btn btn-azul m-auto">
								</div>
								</div>
								</div>
						</form>
					</fieldset>
				</div>
				</div>
				</div>
				
				</section>
</div>				
@endsection