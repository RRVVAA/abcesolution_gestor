<?php
use App\Service\ConstanteService;
?>
@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
		<div class="thead border-bottom mb-3 p-1">
			<div class="titulo mb-0">
				<span><i class="fas fa-list-alt"></i> Chamados</span>
				<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2">Lista de Chamados</b></span>
			</div>
			
		</div>
		
				<div class="px-md">
				<div class="rows">
				<div class="col-2">
					<div class="">
				
				<div class="titulo mb-0 h5 text-left"><i class="fas fa-exchange-alt"></i> Filtro</div>
				<div class="card p-0 mb-2 ">
					<ul class="atalho">
						<li><a href="">Abertos</a></li>
						<li><a href="">Aguardando Retorno</a></li>
						<li><a href="">Fechado</a></li>
						<li><a href="">Todos</a></li>
					</ul>
				</div>
			</div>
				</div>
				<div class="col-10">
				<div class="card">
					<div class="lst mostraFiltro mb-3">
						<form action="" method="">
						<div class="rows">
								<div class="col-4">
									<select name="txt_id_empresa" class="form-campo">
										<option selected>Selecione o valor...</option>
										<option value="1">Código</option>
										<option value="2">Nome</option>
										<option value="3">Email</option>
										<option value="4">Cidade</option>
										<option value="5">Site</option>
										<option value="6">Fone</option>
									</select>
								</div>
								<div class="col-6">
									<input type="text"  name="" placeholder="Valor da pesquisar..." class="form-campo">
								</div>
								<div class="col-2">
									<input type="submit" class="btn btn-azul2" value="pesquisar">
								</div>
						</div>
						</form>
					</div>
						
				
				<div class="tabela-responsiva">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable">
						<thead> 
						  <tr>
							<th align="center">Id</th>
                           <th class="text-left">Empresa</th>
                           <th align="center">Assunto</th>
                           <th align="center">Data</th>
                           <th align="center">Status</th>
                           <th align="center">Ver</th>
						  </tr>
						</thead> 
						<tbody>
						@foreach($lista as $l)
							<tr>
                               <td align="center">{{ $l->id }}</td>
                               <td align="left">{{ $l->empresa->razao_social}} </td>
                               <td align="center">{{ $l->assunto }}</td>
                               <td align="center">{{ $l->create_at }}</td>
                                <td align="center"><span class="{{ strtolower($l->status->status) }}">{{ $l->status->status }}</span></td>
                               <td align="center">
									<a href="{{route('chamado.edit', $l->id)}}" class="btn btn-roxo d-inline-block"><i class="fas fa-eye" title="Visualizar"></i></a>
							   </td>
                            </tr>
						@endforeach 						
						</tbody>
					</table>
					</div>
										
					
					</div>
					</div>
				</div>
				</div>
				
			</section>
</div>
<script>
	function pesquisar(mes){
		var ano = $("#ano").val();
		window.location.href=base_url + "receber/pormes/?ano=" + ano + "&mes=" + mes;
	}
</script>
@endsection