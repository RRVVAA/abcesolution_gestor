@extends("Gestor.template_gestor")
@section("conteudo")
<div class="conteudo">
<div class="rows">
<div class="col-10 m-auto">
<span class="p-2 bg-title text-light text-uppercase h5 mb-0"><i class="fas fa-cogs text-azul"></i> Configurações</span>
                      
                     
	<form action="{{route('gestor.salvar')}}" method="Post" enctype="multipart/form-data">

	@csrf
   <div id="tabs">
	  <ul>
		<li><a href="#tab-1">Dados Pessoais</a></li>
		<li><a href="#tab-2">Endereço</a></li>
		<li><a href="#tab-3">Valores Padrão</a></li>
		<li><a href="#tab-4">Certificado Digital</a></li>
	  </ul>
	  <div id="tab-1">
		<div class="p-2">
				
				<div class="rows pb-2 mb-3 border radius-4" style="background:#bdd0dc;">
					<div class="col-12" >
						<span class="d-block pt-3 mb-2 h5 text-uppercase">Pesquisar Por CNPJ</span>
					</div>
					<div class="col-12 mb-3" >
						<div class="grupo-form-btn">
							<input type="number" id="codigocnpj"   class="form-campo">
							<input type="button" onclick="pesquisarCnpj()" value="Pesquisar CNPJ" class="btn btn-roxo d-block m-auto">
						</div>
					</div>
				</div>
				
				<div class="rows">
					<div  class="col-12">
						<span class="d-block  mb-4 h5 border-bottom text-uppercase">Dados pessoais</span>
					</div>
					<div class="col-6 mb-3">
										<label class="text-label">Razão Social</label>	
										<input type="text" name="razao_social" id="razao_social" value="{{isset($gestor->razao_social) ? $gestor->razao_social : old('razao_social') }}" class="form-campo">
								</div>                                    
								<div class="col-6 mb-3">
										<label class="text-label">Nome Fantasia</label>	
										<input type="text" name="nome_fantasia"  id="nome_fantasia" value="{{isset($gestor->nome_fantasia) ? $gestor->nome_fantasia : old('nome_fantasia') }}" class="form-campo">
								</div>					
								
														
								<div class="col-3 mb-3">
										<label class="text-label">CNPJ</label>	
										<input type="text" name="cnpj" id="cnpj" value="{{isset($gestor->cnpj) ? $gestor->cnpj : old('cnpj') }}"  class="form-campo">
								</div>
								
								<div class="col-3 mb-3">
										<label class="text-label">Insc. Estadual</label>	
										<input type="text" name="ie" id="ie" value="{{isset($gestor->ie) ? $gestor->ie : old('ie') }}"  class="form-campo">
								</div>
								<div class="col-3 mb-3">
										<label class="text-label">IEST</label>	
										<input type="text" name="iest"  id="iest" value="{{isset($gestor->iest) ? $gestor->iest : old('iest') }}"  class="form-campo">
								</div>
								<div class="col-3 mb-3">
                                       <label class="text-label">Insc. Municipal</label>	
                                       <input type="text" name="im" id="im" value="{{isset($gestor->im) ? $gestor->im : old('im') }}"  class="form-campo">
                               </div>
                               <div class="col-6 mb-3">
                                        <label class="text-label">CNAE</label>	
                                        <input type="text" name="cnae" id="cnae" value="{{isset($gestor->cnae) ? $gestor->cnae : old('') }}"  class="form-campo">
                                </div>
                                <div class="col-6 mb-3">
                                        <label class="text-label">Regime Tributário</label>	
                                        <select class="form-campo" name="CRT">
                                                <option value="1">Simples Nacional</option> 
                                                <option value="2">Lucro Presumido</option> 
                                                <option value="3">Lucro Real</option> 
                                        </select>
                                </div>
				

			</div>
		</div>
	  </div>
	  
	  
	  <div id="tab-2">
		<div class="p-2">									
        <span class="d-block h5 border-bottom text-uppercase">Endereço</span>										
        <div class="rows">	
              <div class="col-2 mb-3">
                            <label class="text-label">Cep</label>	
                            <input type="text" name="cep" id="cep" value="{{isset($gestor->cep) ? $gestor->cep : old('cep') }}"  class="form-campo busca_cep">
                            </div>
                            
                            <div class="col-4 mb-3">
                                    <label class="text-label">Logradouro</label>	
                                    <input type="text" name="logradouro" id="logradouro" value="{{isset($gestor->logradouro) ? $gestor->logradouro : old('logradouro') }}"  class="form-campo rua">
                            </div>
                            <div class="col-2 mb-4">
                                    <label class="text-label">Numero</label>	
                                    <input type="text" name="numero" id="numero" value="{{isset($gestor->numero) ? $gestor->numero : old('numero') }}"  class="form-campo">
                            </div>
                            <div class="col-4 mb-3">
                                     <label class="text-label">Bairro</label>	
                                     <input type="text" name="bairro" id="bairro" value="{{isset($gestor->bairro) ? $gestor->bairro : old('bairro') }}"  class="form-campo bairro">
                             </div>
                             <div class="col-4 mb-3">
                                     <label class="text-label">Complemento</label>	
                                     <input type="text" name="complemento" id="complemento" value="{{isset($gestor->complemento) ? $gestor->complemento : old('complemento') }}"  class="form-campo">
                             </div>	
                            
        						 
                             <div class="col-2 mb-2">
                                 <label class="text-label">UF</label>	
                                 <input type="text" name="uf" id="uf" value="{{isset($gestor->uf) ? $gestor->uf : old('uf') }}"   class="form-campo estado"> 
                             </div>                    
                             
                             <div class="col-4 mb-3">
                                     <label class="text-label">Cidade</label>	
                                     <input type="text" name="cidade" id="cidade" value="{{isset($gestor->cidade) ? $gestor->cidade : old('cidade') }}"  class="form-campo cidade">
                             </div>	
                             <div class="col-2 mb-3">
                                     <label class="text-label">Ibge</label>	
                                     <input type="text" name="ibge" id="ibge" value="{{isset($gestor->ibge) ? $gestor->ibge : old('ibge') }}"  class="form-campo ibge ">
                             </div>  
        </div>
        </div>
	  </div>
	  
        <div id="tab-3">									
        <div class="p-2">									
            <span class="d-block h5 border-bottom text-uppercase">Valores padrão</span>										
            <div class="rows">
            					<div class="col-6 mb-3">
                                    <label class="text-label">CST/CSOSN Padrão</label>	
                                     <input type="text" name="cst_csosn_padrao" value="{{isset($gestor->cst_csosn_padrao) ? $gestor->cst_csosn_padrao : old('cst_csosn_padrao') }}"  class="form-campo ibge ">
                                 </div>
                                 
								<div class="col-6 mb-3">
                                    <label class="text-label">CST/PIS Padrão</label>	
                                     <input type="text" name="cst_pis_padrao" value="{{isset($gestor->cst_pis_padrao) ? $gestor->cst_pis_padrao : old('cst_pis_padrao') }}"  class="form-campo ibge ">
                                 </div>
                                <div class="col-6 mb-3">
                                    <label class="text-label">CST/COFINS Padrão</label>	
                                     <input type="text" name="cst_cofins_padrao" value="{{isset($gestor->cst_cofins_padrao) ? $gestor->cst_cofins_padrao : old('cst_cofins_padrao') }}"  class="form-campo ibge ">
                                   
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="text-label">CST/IPI Padrão</label>	
                                     <input type="text" name="cst_ipi_padrao" value="{{isset($gestor->cst_ipi_padrao) ? $gestor->cst_ipi_padrao : old('cst_ipi_padrao') }}"  class="form-campo ibge ">
                                </div>
                                
                                <div class="col-6 mb-3">
                                    <label class="text-label">Frete Padrão</label>	
                                    <select class="form-campo" name="frete_padrao">
                                            <option value="0">Emitente</option> 
                                            <option value="1">Destinatario</option> 
                                            <option value="2">Terceiro</option> 
                                            <option value="9">Sem Frete</option> 
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="text-label">Tipo de pagamento Padrão</label>	
                                    <select class="form-campo" name="tipo_pagamento_padrao">
                                            <option value="01">Dinheiro</option> 
                                            <option value="02">Cheque</option> 
                                            <option value="03">Cartão de Crédito</option> 
                                            <option value="04">Cartão de Débito</option> 
                                            <option value="05">Crédito Loja</option> 
                                            <option value="10">Vale Alimentação</option> 
                                            <option value="11">Vale Refeição</option> 
                                            <option value="12">Vale Presente</option> 
                                            <option value="13">Vale Combustível</option> 
                                            <option value="14">Duplicata Mercantil</option> 
                                            <option value="15">Boleto Bancário</option> 
                                            <option value="90">Sem pagamento</option> 
                                            <option value="99">Outros</option> 
                                    </select>
                                </div>
                                
                                <div class="col-4 mb-3">
                                    <label class="text-label">Ambiente</label>	
                                    <select class="form-campo" name="ambiente">
                                            <option value="2">2 - Homologação</option> 
                                            <option value="1">1 - Produção</option>  
                                    </select>
                                </div>                                
                                
								<div class="col-4 mb-3">
										<label class="text-label">Nº Serie</label>	
										<input type="text" name="numero_serie_nfe" value="{{isset($gestor->numero_serie_nfe) ? $gestor->numero_serie_nfe : old('numero_serie_nfe') }}"  class="form-campo">
								</div>
											   
								<div class="col-4 mb-3">
										 <label class="text-label">Ultimo Nº NFE</label>	
										 <input type="text" name="ultimo_numero_nfe" value="{{isset($gestor->ultimo_numero_nfe) ? $gestor->ultimo_numero_nfe : old('ultimo_numero_nfe') }}"  class="form-campo">
								 </div>
            
                    </div>
         </div>
         </div>
   
          <div id="tab-4">
		<div class="p-2">									
        <span class="d-block h5 border-bottom text-uppercase">Certificado Digital</span>										
        <div class="rows">	
              <div class="col-8 mb-3">
				<label class="text-label">Nome do Arquivo</label>	
				<input type="text" name="certificado_nome_arquivo" id="certificado_nome_arquivo" value="{{isset($gestor->certificado_nome_arquivo) ? $gestor->certificado_nome_arquivo : old('certificado_nome_arquivo') }}"  class="form-campo">
              </div>
              
              <div class="col-4 mb-3">
                      <label class="text-label">Senha</label>	
                      <input type="text" name="certificado_senha" value="{{isset($gestor->certificado_senha) ? $gestor->certificado_senha : old('certificado_senha') }}"  class="form-campo">
              </div>
              <div class="col-6 mb-4">
                      <span class="text-label">Arquivo</span>	
						<div class="file">
							<input type="file" name="file"  id="arquivo" class="form-campo"><label for="arquivo">selecionar arquivo </label>	
						</div>
              </div>
              <div class="col-3 mb-3">
                       <label class="text-label">CSC</label>	
                       <input type="text" name="csc" value="{{isset($gestor->csc) ? $gestor->csc : old('csc') }}"  class="form-campo">
               </div>
               <div class="col-3 mb-3">
                       <label class="text-label">CSC ID</label>	
                       <input type="text" name="csc_id" value="{{isset($gestor->csc_id) ? $gestor->csc_id : old('csc_id') }}"  class="form-campo">
               </div>	 
        </div>
        </div>
	  </div>
         

		<div class="col-12 text-center pb-4 mt-3">
			<input type="submit" value="Salvar alterações" class="btn btn-azul m-auto">
		</div>
	  </div>
	  </form>
 </div>	
 </div>	
 </div>	


@endsection