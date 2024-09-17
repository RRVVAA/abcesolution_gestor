@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
	<div class="thead border-bottom mb-3 p-1">	
		<div class="titulo mb-0"><i class="fas fa-users"></i> Cadastro de Empresa</div>
		<div class="text-end d-flex">
			<a href="{{route('empresa.index')}}" class="btn btn-azul d-inline-block btn-min"><i class="fas fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
		</div>
	</div>
				<div class="rows">
				<div class="col-9 m-auto pb-4">
				<div class="card">
					<div class="px-md pb-4">
						<div class="titulo h5 fw-600">Dados do empresa</div>
						 @if(isset($empresa))    
                           <form action="{{route('empresa.update', $empresa->id)}}" method="POST">
                           <input name="_method" type="hidden" value="PUT"/>
                         @else                       
                        	<form action="{{route('empresa.store')}}" method="Post">
                        @endif
                        	@csrf
						
					@if(!isset($empresa))   
						<fieldset class="mb-3" style="background: #f3f3f3;">
            				<legend>Pesquisar Por CNPJ</legend>
            				<div class="rows">
            					<div class="col-6">
            						<div class="grupo-form-btn">
            							<input type="text" id="codigocnpj"   class="form-campo mascara-cnpj">
            							<input type="button" onclick="pesquisarCnpj()" value="Pesquisar CNPJ" class="btn btn-azul d-block m-auto">
            						</div>
            					</div>
            				</div>
            			</fieldset>
			
					@endif		
							<div class="rows">
								
								<div class="col-12">
								<div class="rows">
									<div class="col-12 mb-3">
										<label class="text-label">Nome/Razão Social</label>
                    					<input type="text" name="razao_social" id="razao_social" value="{{($empresa->razao_social) ?? old('razao_social')}}" class="form-campo" >
									</div>
									<div class="col-3 mb-3">
									<label class="text-label">CPF/CNPJ</label>
    									<input type="text" name="cpf_cnpj" id="cnpj" value="{{($empresa->cpf_cnpj) ?? old('cpf_cnpj')}}" class="form-campo mascara-cnpj" >
    								</div>
								
									<div class="col-3 mb-3">
										<label class="text-label">Cep</label>
                    					<input type="text" name="cep" id="cep" value="{{($empresa->cep) ?? old('cep')}}" class="form-campo busca_cep mascara-cep" >
									</div>
									
									<div class="col-6 mb-3">				
										<label class="text-label">Endereço</label>
                    					<input type="text" name="logradouro" id="logradouro" value="{{($empresa->logradouro) ?? old('logradouro')}}" class="form-campo rua" >
									</div>
								</div>
								</div>
								<div class="col-4 mb-3">
									<label class="text-label">Complemento</label>
                    					<input type="text" name="complemento" id="complemento" value="{{($empresa->complemento) ?? old('complemento')}}" class="form-campo" >
								</div>			
								<div class="col-2 mb-3">
									<label class="text-label">Número</label>
                    					<input type="text" name="numero" id="numero" value="{{($empresa->numero) ?? old('numero')}}" class="form-campo" >
								</div>									
								<div class="col-6 mb-3">
									<label class="text-label">Bairro</label>
                    					<input type="text" name="bairro"  id="bairro"value="{{($empresa->bairro) ?? old('bairro')}}" class="form-campo bairro" >
								</div>
								<div class="col-4 mb-3">
									<label class="text-label">Cidade</label>
                    					<input type="text" name="cidade" id="cidade" value="{{($empresa->cidade) ?? old('cidade')}}" class="form-campo cidade" >
								</div>	
							
								<div class="col-2 mb-3">
									<label class="text-label">UF</label>	
									<input type="text" name="uf" id="uf" value="{{($empresa->uf) ?? old('uf')}}" class="form-campo estado" >
														
								</div>								
								
								<div class="col-3 mb-3">
            							<label class="text-label">Fone</label>	
            							<input type="text" name="fone" id="telefone" value="{{isset($empresa->fone) ? $empresa->fone : old('fone') }}"  class="form-campo mascara-fone">
            					</div>
            					<div class="col-3 mb-3">
            							<label class="text-label">Celular</label>	
            							<input type="text" name="celular" id="celular" value="{{isset($empresa->fone) ? $empresa->celular : old('celular') }}"  class="form-campo mascara-celular">
            					</div>            										
								
								
								<div class="col-12 mb-3">
									<label class="text-label">Email</label>
									<input type="text" name="email" required id="email" value="{{($empresa->email) ?? old('email')}}" class="form-campo" >
								</div>
								
								<div class="col-12">
    								<input type="hidden" name="id" value="{{($empresa->id) ?? old('id')}}" />
    								<input type="submit" value="Cadastrar" class="btn btn-azul m-auto">
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