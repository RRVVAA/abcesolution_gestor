@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<div class="caixa">
  <div class="thead border-bottom mb-3 p-1">
		<div class="titulo mb-0"><i class="fas fa-plus-circle"></i> Cadastrar fornecedor</div>
		<div>
			<a href="{{route('fornecedor.index')}}" class="btn btn-azul mx-1 d-inline-block btn-pequeno"><i class="fas fa-arrow-left"></i> Voltar</a>							
		</div>
	</div>                 
 @if(isset($fornecedor))    
   <form action="{{route('fornecedor.update', $fornecedor->id)}}" method="POST">
   <input name="_method" type="hidden" value="PUT"/>
 @else                       
	<form action="{{route('fornecedor.store')}}" method="Post">
@endif
	@csrf
   <div class="px-md">
   <div id="tabs">
	 
	  <div id="tab-1">
		<div class="p-2">
			<fieldset class="mb-3" style="background: #f3f3f3;">
				<legend>Pesquisar Por CNPJ</legend>
				<div class="rows">
					<div class="col-3">
							<select  id="tipo_cliente" class="form-campo" onchange ="tipoCliente()"  >
								<option value="J">Juridica</option>
								<option value="F">Física</option>
															
							</select>
					</div>
					
					<div class="col-8" id="div_pesquisar">
						<div class="grupo-form-btn">
							<input type="text" id="codigocnpj" class="form-campo mascara-cnpj"  >
							<input type="button" onclick="pesquisarCnpj()" value="Pesquisar CNPJ" class="btn btn-azul d-block m-auto">
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>Informações básicas</legend>
				
				<div class="rows">												
					<div class="col-6 mb-3">
							<label class="text-label" id="lblRazaoSocial">Razão Social</label>	
							<input type="text" name="razao_social" id="razao_social" value="{{isset($fornecedor->razao_social) ? $fornecedor->razao_social : old('razao_social') }}" class="form-campo">
					</div>                                    
					<div class="col-6 mb-3" id="divFantasia">
							<label class="text-label">Nome Fantasia</label>	
							<input type="text" name="nome_fantasia"  id="nome_fantasia" value="{{isset($fornecedor->nome_fantasia) ? $fornecedor->nome_fantasia : old('nome_fantasia') }}" class="form-campo">
					</div>		
					<div class="col-4 mb-3">
							<label class="text-label">Email</label>	
							<input type="text" name="email" id="email" value="{{isset($fornecedor->email) ? $fornecedor->email : old('email') }}"  class="form-campo">
					</div>	

					<div class="col-2 mb-3">
							<label class="text-label">Fone</label>	
							<input type="text" name="fone" id="telefone" value="{{isset($fornecedor->fone) ? $fornecedor->fone : old('fone') }}"  class="form-campo mascara-fone">
					</div>					
					<div class="col-3 mb-3">
							<label class="text-label" id="lblCnpj">CNPJ</label>	
							<input type="text" name="cpf_cnpj" id="cnpj" value="{{isset($fornecedor->cpf_cnpj) ? $fornecedor->cpf_cnpj : old('cpf_cnpj') }}"  class="form-campo ">
					</div>
													
						
					<div class="col-3 mb-3">
							<label class="text-label">Celular</label>	
							<input type="text" name="celular" id="celular" value="{{isset($fornecedor->fone) ? $fornecedor->fone : old('fone') }}"  class="form-campo mascara-celular">
					</div>
				</div>
			</fieldset>
			
			<fieldset>
					<legend>Endereço</legend>
													
					<div class="rows">	
							<div class="col-2 mb-3">
                            <label class="text-label">Cep</label>	
                            <input type="text" name="cep" id="cep" value="{{isset($fornecedor->cep) ? $fornecedor->cep : old('cep') }}"  class="form-campo busca_cep mascara-cep">
                            </div>
                            
                            <div class="col-4 mb-3">
                                    <label class="text-label">Logradouro</label>	
                                    <input type="text" name="logradouro" id="logradouro" value="{{isset($fornecedor->logradouro) ? $fornecedor->logradouro : old('logradouro') }}"  class="form-campo rua">
                            </div>
                            <div class="col-2 mb-4">
                                    <label class="text-label">Numero</label>	
                                    <input type="text" name="numero" id="numero" value="{{isset($fornecedor->numero) ? $fornecedor->numero : old('numero') }}"  class="form-campo">
                            </div>
                            <div class="col-4 mb-3">
                                     <label class="text-label">Bairro</label>	
                                     <input type="text" name="bairro" id="bairro" value="{{isset($fornecedor->bairro) ? $fornecedor->bairro : old('bairro') }}"  class="form-campo bairro">
                             </div>
                             <div class="col-4 mb-3">
                                     <label class="text-label">Complemento</label>	
                                     <input type="text" name="complemento" id="complemento" value="{{isset($fornecedor->complemento) ? $fornecedor->complemento : old('complemento') }}"  class="form-campo">
                             </div>	                            
        						 
                             <div class="col-2 mb-2">
                                 <label class="text-label">UF</label>	
                                 <input type="text" name="uf" id="uf" value="{{isset($fornecedor->uf) ? $fornecedor->uf : old('uf') }}"   class="form-campo estado"> 
                             </div>                    
                             
                             <div class="col-4 mb-3">
                                     <label class="text-label">Cidade</label>	
                                     <input type="text" name="cidade" id="cidade" value="{{isset($fornecedor->cidade) ? $fornecedor->cidade : old('cidade') }}"  class="form-campo cidade">
                             </div>	
                             <div class="col-2 mb-3">
                                     <label class="text-label">Ibge</label>	
                                     <input type="text" name="ibge" id="ibge" value="{{isset($fornecedor->ibge) ? $fornecedor->ibge : old('ibge') }}"  class="form-campo ibge ">
                             </div>  
					</div>
				</fieldset>
		</div>
	  </div>
	  
	  
		<div class="col-12 text-center pb-4 mt-4">
			<input type="submit" value="Salvar" class="btn btn-azul m-auto">
		</div>

         
 </div>
		
	  </div>
</div>	
</form>
</div>
<script>
	function tipoCliente(){
		var tp = $("#tipo_cliente").val();
		
		if(tp=="F"){
			$("#div_pesquisar").hide();
            $("#div_tipo_contribuinte").hide();
            $("#divIscEstadual").hide();
            $("#divSuframa").hide();
            $("#divFantasia").hide();
            
            $("#lblInscEstadual").html("RG");
            $("#lblCnpj").html('CPF');
            $("#lblRazaoSocial").html('Nome');
            
            $("#cnpj").val('');
       
            
		}else{
			$("#div_pesquisar").show();
            $("#div_tipo_contribuinte").show();
            $("#divIscEstadual").show();
            $("#divSuframa").show();
            $("#divFantasia").show();
            
            $("#lblInscEstadual").html("Inscrição Estadual");
            $("#lblCnpj").html('CNPJ');
            $("#lblRazaoSocial").html('Razão Social');
            
            $("#cnpj").val('');
          
		}
	}
	
	$("#cnpj").keydown(function(){
    try {
    	$("#cnpj").unmask();
    } catch (e) {}
    
    var tamanho = $("#cnpj").val().length;
	
    if(tamanho < 11){
        $("#cnpj").mask("999.999.999-99");
    } else if(tamanho >= 11){
        $("#cnpj").mask("99.999.999/9999-99");
    }
    
    // ajustando foco
    var elem = this;
    setTimeout(function(){
    	// mudo a posição do seletor
    	elem.selectionStart = elem.selectionEnd = 10000;
    }, 0);
    // reaplico o valor para mudar o foco
    var currentValue = $(this).val();
    $(this).val('');
    $(this).val(currentValue);
});
</script>
@endsection