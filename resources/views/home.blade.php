@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa cat-home">
				<div class="p-2">
					<div class="rows">
					<div class="col-3">
						<div class="home-admin">
							<div class="thumb mb-3">
								@if(!auth()->user()->foto)
									<img src="{{asset('assets/gestor/img/img-usuario.png')}}" class="img-fluido" id="imgUp">
								@else									
									<img src="{{ url(auth()->user()->foto) }}" class="img-fluido" id="imgUp">
								@endif
    								
							</div>							
							<span><i class="fas fa-user"></i> <b>Nome:</b> {{session('gestor')->razao_social}}</span>
							<span><i class="fas fa-school"></i> <b>CNPJ.:</b> {{session('gestor')->cnpj}}</span>
							<span><i class="fas fa-calendar"></i> <b>Acesso:</b> 15/01/2020 - 12:00</span>
							<span class="d-block text-center"><a href="{{route('meuperfil.index')}}" class="btn btn-min btn-azul d-inline-block"><i class="fas fa-edit"></i> Editar</a></span>
						</div>	
						
						<div class="home-admin p-0 mt-2" style="background:none">
							<div class="titulo h6 p-1 mb-0 border-bottom text-uppercase fw-600">
							<i class="fas fa-calculator"></i> Contas em atraso
							<span class="alert">{{count($atraso->get())}}</span>
							</div>
							<div class="p-2">	
								<small>Você tem <b class="text-vermelho">{{count($atraso->get())}}</b> conta em atraso (s) com um saldo total devido de <b class="text-vermelho">R$ {{$atraso->sum('valor')}}</b>.</small>
								<a href="{{route('pagar.index')}}" class="btn btn-min btn-verde d-inline-block px-1">Ver Contas</a>
								<a href="{{route('despesa.index')}}" class="btn btn-min btn-vermelho d-inline-block px-1">Ver Despesas</a>
							</div>					
						</div>
						
						<div class="home-admin p-0 mt-2" style="background:none">
							<div class="titulo h6 p-1 mb-0 border-bottom text-uppercase fw-600">
								<i class="fas fa-exchange-alt"></i> atalhos
							</div>
							<div class="p-2 text-center">	
								<a href="{{route('empresa.index')}}" class="my-alt-1 btn btn-min btn-azul2 d-inline-block">Clientes</a>
								<a href="{{route('plano.index')}}" class="my-alt-1 btn btn-min btn-azul2 d-inline-block">Planos</a>
								<a href="{{route('modulo.index')}}" class="my-alt-1 btn btn-min btn-azul2 d-inline-block">Módulos</a>
								<a href="{{route('pagar.index')}}" class="my-alt-1 btn btn-min btn-azul2 d-inline-block">Contas a pagar</a>
								<a href="{{route('receber.index')}}" class="my-alt-1 btn btn-min btn-azul2 d-inline-block">Contas a receber</a>
								<a href="" class="my-alt-1 btn btn-min btn-azul2 d-inline-block">Sair</a>
							</div>					
						</div>					
					</div>
					<div class="col-9">
						<div class="col-12">		
						<div class="rows">		
							
						
						<div class="col-12">							
						<div class="rows">
						<div class="col-12">
							<article class="card p-0">
									<div class="titulo Thome h6 p-1 mb-0 text-uppercase fw-600 text-escuro d-flex justify-content-space-between align-vertical-center">
										<span class="width-50"><i class="fas fa-exchange-alt"></i> Pagamentos e Recebimentos <span class="text-azul h5 d-inline-block mb-0">Esta semana</span></span>
										<div class="group-btn d-flex" id="filtrar">											
											<a href="javascript:;" onclick="filtrarConta('hoje')" id="hoje" class="btn btn-padrao">Hoje</a>
											<a href="javascript:;" onclick="filtrarConta('semana')" id="semana" class="btn btn-padrao btn-ativo">Esta Semana</a>
											<a href="javascript:;" onclick="filtrarConta('mes')" id="mes" class="btn btn-padrao">Este Mês</a>
										</div>
									</div>
								
									<div class="cx-body p-2 border-top planos">
										<div class="rows rows2">
										<div class="col-3 d-flex">
										<article class="card blue-100 p-1 border-0" style="background:#59e7b2">
    										<div class="titulo h6 p-1 mb-0 text-uppercase fw-600 text-escuro  text-center"><i class="fas fa-arrow-right"></i> A receber</div>
    										<div class="cx-body p-0 border-top planos border-top-0">																				
    											<div class="p-2 d-flex justify-content-space-between align-vertical-center">
													<div>
														<span>Conta:<br> <strong class="h6 mb-0 d-inline-block" style="color:#2a9595!important" id="total_receber"> R$ {{moedaBr($total_receber)}}</strong> 
													</span>
													<br>	<a href="{{route('receber.index')}}" class="btn btn-amarelo btn-min fas fa-eye" title="Ver lista"></a>	
													</div>
													<div>
														<span>Fatura: <br><strong class="h6 mb-0 d-inline-block" style="color:#2a9595!important" id="total_fatura">R$ {{moedaBr($total_fatura)}}</strong> </span>
														
														<br>	<a href="{{route('fatura.index')}}" class="btn btn-amarelo btn-min fas fa-eye" title="Ver lista"></a>	
													</div>	
												</div>
												<div class="tfooter end" style="border-color:#6abd9e">													
    											    <span>Total: <strong class="h5 mb-0 d-inline-block" style="color:#2a9595!important" id="saldo_receber">R$  {{moedaBr($saldo_receber)}}</strong> </span>
    											</div>
    											
    										</div>										
    									</article>
										</div>
    									<div class="col-3 d-flex">
    									<article class="card blue-100 p-1 border-0" style="background:#f7b9af">
										<div class="titulo h6 p-1 mb-0 text-uppercase fw-600 text-escuro text-center"><i class="fas fa-arrow-left"></i> A pagar</div>
										<div class="cx-body p-0 border-top planos border-top-0">																				
											<div class="p-2 d-flex justify-content-space-between align-vertical-center">
											<div>
												<span>Conta:<br> <strong class="text-vermelho h6 mb-0 d-inline-block" id="total_pagar">R$ {{moedaBr($total_pagar)}}</strong></span>
												
												<br><a href="{{route('pagar.index')}}" class="btn btn-vermelho btn-min fas fa-eye" title="Ver lista"></a>
												</div>
												<div>
												<span>Despesa:<br> <strong class="text-vermelho h6 mb-0 d-inline-block" id="total_despesa">R$ {{moedaBr($total_despesa)}}</strong></span>
												<br><a href="{{route('despesa.index')}}" class="btn btn-vermelho btn-min fas fa-eye" title="Ver lista"></a>
												</div>
											</div>
											<div class="tfooter end" style="border-color:#ff8f8f">
												<span>Total: <strong class="text-vermelho h5 mb-0 d-inline-block" id="saldo_pagar"> R$ {{moedaBr($saldo_pagar)}}</strong></span>
											
											</div>
										</div>
									</article>
									</div>
									
										<div class="col-3 d-flex">
											<div class="card width-100 border p-1 radius-4 text-center" style="border-color:#6bc5a3!important;background:#fff!important">
												<span class="d-block h6 mb-0 p-1 text-uppercase fw-700"><i class="fas fa-arrow-right"></i> Recebimentos</span>
												
												<div class="cx-body p-0 border-top planos border-top-0">
													<div class="mb-3 p-2 d-flex justify-content-space-between align-vertical-center">
													
													<div class="text-left"><span>Conta: <br><strong class="text-azul fw-700 h6 mb-0 d-inline-block"  style="color:#6bc5a3!important" id="total_recebimento"> R$ {{ moedaBr($total_recebimento) }}</strong></span>
													<br>
													</div>
													<div class="text-left">
													<span>Juros/multa:<br> <strong class="text-verde h6 mb-0 d-inline-block" id=total_juros_recebido>R$ {{moedaBr($total_recebimento_juros - $total_recebimento)}}</strong></span>
													</div>
													</div>
													
											<div class="tfooter between" style="border-color:#6bc5a3">
											
													<a href="{{route('recebimento.index')}}" class="btn btn-verde btn-min fas fa-eye" title="Ver lista"></a>									
												<span>Total: <strong class="text-verde h5 mb-0 d-inline-block" id="total_recebimento_juros"> R$ {{moedaBr($total_recebimento_juros)}}</strong></span>
											
											</div>
												</div>
											</div>
										</div>
										<div class="col-3 d-flex">
											<div class="card width-100 border p-2 radius-4 text-center" style="border-color:#e98181!important;background:#fff!important">
												
												<span class="d-block h6 p-1 mb-0 text-uppercase fw-700"><i class="fas fa-arrow-left"></i> Pagamentos</span>
												
												<div class="cx-body p-0 border-top planos border-top-0">
													<div class="mb-3 p-2 d-flex justify-content-space-between align-vertical-center">
														<div class="text-left"><span>Conta<br>
															<strong class="text-vermelho fw-700 h6 mb-0 d-inline-block" id="total_pagamento">{{ moedaBr($total_pagamento) }}</strong></span>
															<br>
														</div>
														<div class="text-left">
														<span>juros/multa:<br> <strong class="text-vermelho h6 mb-0 d-inline-block" id="total_juros_pago">R$ {{moedaBr($total_pagamento_juros - $total_pagamento)}}</strong></span>
														</div>													
													</div>
												<div class="tfooter between" style="border-color:#ff8f8f">
															<a href="{{route('pagamento.index')}}" class="btn btn-vermelho btn-min fas fa-eye" title="Ver lista"></a>
												<span>Total: <strong class="text-vermelho h5 mb-0 d-inline-block" id="total_pagamento_juros"> R$ {{moedaBr($total_pagamento_juros)}}</strong></span>
											
											</div>
											</div>
											</div>
										</div>
										</div>
										
									</div>
									
							</article>
						</div>
						
							</div>
						</div>

						<div class="col-12 pt-3">
							<div class="rows">
								<div class="col-4 mb-2 d-flex">
									<article class="card blue-100 p-0" style="background: var(--blue-grey-050)">
										<div class="titulo h6 p-3 mb-0 text-uppercase fw-600"><i class="fas fa-list"></i> Comprovantes Enviados</div>
										<div class="cx-body p-2 border-top planos">
											<strong class="text-vermelho">{{count($comprovantes)}}</strong>
											<span>Iten(s) encontrado</span>
										</div>
										<div class="tfooter end border-0">
											<a href="{{route('comprovante.index')}}" class="btn btn-azul2 btn-min fas fa-eye" title="Ver lista"></a>
										</div>
									</article>
								</div>
								<div class="col-4 d-flex mb-2">
								<article class="card blue-100 p-0" style="background: var(--blue-grey-050)">
									<div class="titulo h6 p-3 mb-0 text-uppercase fw-600"><i class="fas fa-list"></i> Clientes em Prospecção</div>
									<div class="cx-body p-2 border-top planos">
										<strong class="text-vermelho">{{count($prospectos)}}</strong>
										<span>Iten(s) encontrado</span>
									</div>
									<div class="tfooter end border-0">
										<a href="{{route('prospectos')}}" class="btn btn-azul2 btn-min fas fa-eye" title="Ver lista"></a>

									</div>
								</article>
							</div>
							<div class="col-4 d-flex mb-2">
								<article class="card blue-100 p-0" style="background: var(--blue-grey-050)">
									<div class="titulo h6 p-3 mb-0 text-uppercase fw-600"><i class="fas fa-list"></i> Chamados Abertos</div>
									<div class="cx-body p-2 border-top planos">
										<strong class="text-vermelho">{{count($chamados)}}</strong>
										<span>Iten(s) encontrado</span>
									</div>
									<div class="tfooter end border-0">
										<a href="{{route('chamado.index')}}" class="btn btn-azul2 btn-min fas fa-eye" title="Ver lista"></a>

									</div>
								</article>
							</div>
							</div>
						</div>
						
						
						<div class="col-12 mt-3">
						<div class="card p-0 pb-4">
							<div class="col-9 m-auto pt-3">
							<canvas class="mt-2 img-fluido" id="myChart" width="400" height="250"></canvas>
							</div>
						</div>
						</div>
						
						
						<div class="col-12 mb-3 mt-4">
								<article class="card blue-100 p-0">
									<div class="titulo h6 p-1 mb-0 text-uppercase fw-600"><i class="fas fa-user"></i> Comprovantes Enviados</div>
									<div class="cx-body">
										<div class="tabela-responsiva border-top">
											<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela">
												<thead> 
												  <tr>
												  	<th class="text-center">#</th>
													<th class="text-center">Data Envio</th>
													<th class="text-center">Empresa</th>
													<th class="text-center">Confirmado</th>
													<th class="text-center">Visualizar</th>													
												  </tr>
												</thead> 
												<tbody>
												@foreach($comprovantes as $comprovante)
													<tr>
														<td class="text-center">{{$comprovante->id}}</td>
														<td class="text-center">{{databr($comprovante->data_emissao)}}</td>
														<td class="text-center">{{$comprovante->empresa->razao_social}}</td>														
														<td class="text-center">{{$comprovante->confirmado}}</td>	
														<td class="text-center"><a href="{{route("comprovante.show", $comprovante->id)}}" class="d-inline-block p-1 text-azul" title="visualizar empresas"><i class="fas fa-eye"></i> </a>  </td>
													</tr>	
												@endforeach			
												</tbody>
											</table>
										</div>
									</div>
								</article>
							</div>
							
						
							<div class="col-12 mb-3 mt-4">
								<article class="card blue-100 p-0">
									<div class="titulo h6 p-1 mb-0 text-uppercase fw-600"><i class="fas fa-user"></i> Clientes em Atraso</div>
									<div class="cx-body">
										<div class="tabela-responsiva border-top">
											<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela">
												<thead> 
												  <tr>
												  	<th class="text-center">#</th>
													<th class="text-center">Nome</th>
													<th class="text-center">email</th>
													<th class="text-center">Celular</th>
													<th class="text-center">Vencimento</th>
													<th class="text-center">visualizar</th>
												  </tr>
												</thead> 
												<tbody>
												@foreach($atrasados as $emp)
													<tr>
														<td class="text-center">{{$emp->id}}</td>
														<td class="text-center">{{$emp->razao_social}}</td>
														<td class="text-center">{{$emp->email}}</td>
														<td class="text-center">{{$emp->celular}}</td>
														<td class="text-center">{{databr($emp->data_vencimento)}}</td>
														<td class="text-center"><a href="{{route('empresa.show', $emp->id)}}" class="d-inline-block p-1 text-azul" title="visualizar empresas"><i class="fas fa-eye"></i> </a>  </td>																							
													</tr>	
												@endforeach			
												</tbody>
											</table>
										</div>
									</div>
								</article>
							</div>
							
							<div class="col-12 mb-3">
								<article class="card blue-100 p-0">
									<div class="titulo h6 p-1 mb-0 text-uppercase fw-600"><i class="fas fa-users"></i> Últimos Prospectos</div>
									<div class="cx-body">
										<div class="tabela-responsiva border-top">
											<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela">
												<thead> 
												  <tr>
												  	<th class="text-center">#</th>
													<th class="text-center">Nome</th>
													<th class="text-center">email</th>
													<th class="text-center">Telefone</th>
													<th class="text-center">Data</th>
													<th class="text-center">visualizar</th>
												  </tr>
												</thead> 
												<tbody>
												@foreach($prospectos as $p)
													<tr>
														<td class="text-center">{{$p->id}}</td>
														<td class="text-center">{{$p->razao_social}}</td>
														<td class="text-center">{{$p->email}}</td>
														<td class="text-center">{{$p->celular}}</td>
														<td class="text-center">{{databr($p->data_aquisicao)}}</td>
														<td class="text-center"><a href="{{route('empresa.show', $p->id)}}" class="d-inline-block p-1 text-azul" title="visualizar empresas"><i class="fas fa-eye"></i> </a>  </td>																							
													</tr>
												@endforeach				
												</tbody>
											</table>
										</div>
									</div>
								</article>
							</div>
							</div>
							<!--
							<div class="col-12 mb-3 d-flex">
								<article class="card blue-100 p-0">
									<div class="titulo h6 p-1 mb-0 text-uppercase fw-600"><i class="fas fa-grip-horizontal"></i> Planos Atuais</div>
									<div class="cx-body p-1 border-top planos">
										<div class="rows rows2">
											<a href="{{route('empresa.index')}}" class="col-2">
												<div class="p-1 card">
													<span class="pl1">plano 1</span>
													<span class="pl2">Módulo Completo</span>
													<span class="pl1">valor - R$ 100,00</span>
												</div>
											</a>
											<a href="{{route('empresa.index')}}" class="col-2">
												<div class="p-1 card">
													<span class="pl1">plano 3</span>
													<span class="pl2">Módulo básico</span>
													<span class="pl1">valor - R$ 100,00</span>
												</div>
											<a href="{{route('empresa.index')}}" class="col-2">
												<div class="p-1 card">
													<span class="pl1">plano 4</span>
													<span class="pl2">Módulo mensal</span>
													<span class="pl1">valor - R$ 100,00</span>
												</div>
											</a>
											<a href="{{route('empresa.index')}}" class="col-2">
												<div class="p-1 card">
													<span class="pl1">plano 5</span>
													<span class="pl2">Módulo Anual</span>
													<span class="pl1">valor - R$ 100,00</span>
												</div>
											</a>
											<a href="{{route('empresa.index')}}" class="col-2">
												<div class="p-1 card">
													<span class="pl1">plano 6</span>
													<span class="pl2">Módulo Anual</span>
													<span class="pl1">valor - R$ 100,00</span>
												</div>
											</a>
											<a href="{{route('empresa.index')}}" class="col-2">
												<div class="p-1 card">
													<span class="pl1">plano 7</span>
													<span class="pl2">Módulo Anual</span>
													<span class="pl1">valor - R$ 100,00</span>
												</div>
											</a>
										</div>
									</div>
								</article>
							</div>
							-->
							
						</div>
					</div>
					</div>
					
				</div>
			</section>
</div>

<script>	
	var entradas = <?php echo json_encode(array_values($entradas)) ?>;
	var saidas = <?php echo json_encode(array_values($saidas)) ?>;
	function filtrarConta(tipo){
    	$('#hoje').removeClass("btn-ativo");
    	$('#semana').removeClass("btn-ativo");
    	$('#mes').removeClass("btn-ativo");
		$('#'+tipo).addClass("btn-ativo");
		$.ajax({
		  url: base_url + "resumoContas/" + tipo,
		  type: "GET",
		  dataType: "json",
		  data:{},
		  success: function (data){
		      $("#total_despesa").html(data.total_despesa);
		      $("#total_pagar").html(data.total_pagar);
		      $("#saldo_pagar").html(data.saldo_pagar);
		      $("#total_pagamento").html(data.total_pagamento);		      
		      $("#total_pagamento_juros").html(data.total_pagamento_juros);
		      $("#total_juros_pago").html(data.total_juros_pago);
		      
		      $("#total_fatura").html(data.total_fatura);
		      $("#total_receber").html(data.total_receber);
		      $("#total_recebimento").html(data.total_recebimento);
		      $("#total_recebimento_juros").html(data.total_recebimento_juros);		      
		      $("#saldo_receber").html(data.saldo_receber);
		      $("#total_juros_recebido").html(data.total_juros_recebido);
			  console.log(data) 
		  }
	   });	
	}
</script>
@endsection