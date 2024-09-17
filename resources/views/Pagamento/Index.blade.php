<?php
use App\Service\ConstanteService;
?>
@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
		<div class="thead border-bottom mb-3 p-1">
			<div class="titulo mb-0">
				<span><i class="fas fa-list-alt"></i> Pagamentos</span>
				<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2">Lista de Pagamentos</b></span>
			</div>
			
		</div>
		
				<div class="px-md">
				<div class="rows">
				<div class="col-2">
					<div class="">
				<!--<div class="titulo mb-0 h5 text-left"><i class="fas fa-exchange-alt"></i> Atalhos</div>-->
				<div class="card mb-2 p-0">
					<ul class="atalho">
						<li style="padding:5px">
							
							<select class="form-campo width-100" id="ano">
							 @for($i=1;$i<=10; $i++ )
							 	<?php $ano =2021+$i ?>
								<option value="{{$ano}}" {{($ano==date('Y')) ? 'selected' : '' }}>{{$ano}}</option>
							@endfor
							</select>
						
						</li>
						<li>
						<div class="state-movi">
    						@foreach(ConstanteService::listaMeses() as $c=>$v)
    							<a href="javascript:;" onclick="pesquisar({{$c}})" class="status status-{{(zeroEsquerda($c,2)==$mes) ? 'vermelho' : 'neutro'}} mb-0">{{$v}}</a>
    						@endforeach
						</div>
						
						</li>
						<li><a href="">link aqui</a></li>
						<li><a href="">link aqui</a></li>
					</ul>
				</div>
				<div class="titulo mb-0 h5 text-left"><i class="fas fa-exchange-alt"></i> Outros</div>
				<div class="card p-0 mb-2 ">
					<ul class="atalho">
						<li><a href="">link aqui</a></li>
						<li><a href="">link aqui</a></li>
						<li><a href="">link aqui</a></li>
						<li><a href="">link aqui</a></li>
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
                           <th class="text-left">Descrição</th>
                           <th align="center">Data Recebimento</th>
                           <th align="center">Número</th>
                           <th align="center">Valor Original</th>
                           <th align="center">Juros</th>
                           <th align="center">Desconto</th>
                           <th align="center">Multa</th>
                           <th align="center">Valor Pago</th>
                           <th align="center">Forma Pagto</th>
                           <th align="center">Opções</th>
						  </tr>
						</thead> 
						<tbody>
						@foreach($lista as $lancamento)
							<tr>
                               <td align="center">{{ $lancamento->id }}</td>
                               <td align="left">{{ $lancamento->descricao_pagamento }} </td>
                               <td align="center">{{ databr($lancamento->data_pagamento) }}</td>
                               <td align="center">{{ $lancamento->numero_documento }}</td>
                               <td align="center">{{ moedaBr($lancamento->valor_original) }}</td>
                               <td align="center">{{ moedaBr($lancamento->juros) }}</td>
                               <td align="center">{{ moedaBr($lancamento->desconto) }}</td>
                               <td align="center">{{ moedaBr($lancamento->multa) }}</td>
                               <td align="center">{{ moedaBr($lancamento->valor_pago) }}</td>
                               <td align="center">{{ $lancamento->forma_pagto->forma_pagto ?? null }}</td>
                               <td align="center">
									<a href="{{route('pagamento.show', $lancamento->id)}}" class="btn btn-roxo d-inline-block"><i class="fas fa-eye" title="Visualizar"></i></a>
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