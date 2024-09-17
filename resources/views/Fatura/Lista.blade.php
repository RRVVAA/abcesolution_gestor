<?php
use App\Service\ConstanteService;
?>
@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
	<div class="thead border-bottom mb-3 p-1">
		<div class="titulo mb-0">
			<span><i class="fas fa-list-alt"></i> Faturas</span>
			<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2">Lista de Faturas</b></span>
		</div>
		
	</div>
			<div class="px-md mb-4">
			<div class="rows">
		
				<div class="col-12">
				<div class="card caixa blue-100">
					
						
				
				<div class="tabela-responsiva">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable">
						<thead> 
						  <tr>
							<th class="text-center">ID</th>
							<th class="text-center">Empresa</th>
							<th class="text-center">Data Lançamento</th>
							<th class="text-center">Data Vencimento</th>
							<th class="text-center">Data Pagamento</th>
							<th class="text-center">Descrição</th>
							<th class="text-center">Valor</th>
							<th class="text-center">Status</th>
							
							<th class="text-center">Opções</th>
						  </tr>
						</thead> 
						<tbody>
						@foreach($lista as $v)						
							<tr>
								<td  class="text-center">{{$v->id}}</td>
								<td  class="text-center">{{$v->empresa->razao_social}}</td>
								<td  class="text-center">{{databr($v->data_lancamento)}}</td>
								<td  class="text-center">{{databr($v->data_vencimento)}}</td>
								<td  class="text-center">{{isset($v->pagamento) ? databr($v->pagamento->data_pagamento) : '--'}}</td>
								<td  class="text-center">{{$v->descricao}}</td>
								<td  class="text-center">{{moedaBr($v->valor)}}</td>
                                <td align="center"><span class="{{ strtolower($v->status->status) }}">{{ $v->status->status }}</span></td>
							  
									<td  class="text-center">
									<a href="{{route('fatura.faturar', $v->id)}}" class="d-inline-block btn btn-roxo btn-pequeno" title="Faturar"><i class="fas fa-donate"></i> </a>  
									<a href="{{route('fatura.edit', $v->id)}}" class="d-inline-block btn btn-verde btn-pequeno btn-circulo" title="Editar"><i class="fas fa-edit"></i></a> 								
    								
                                    <a href="#" onclick="confirm('Tem Certeza?') ? document.getElementById('afatura{{$v->id}}').submit() : '';" class="d-inline-block btn btn-vermelho btn-circulo btn-pequeno"><i class="fas fa-trash-alt"></i></a>
                                        <form action="{{route('fatura.destroy', $v->id)}}" method="POST" id="afatura{{$v->id}}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{csrf_field()}}
                                        </form>
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
		window.location.href=base_url + "fatura/pormes/?ano=" + ano + "&mes=" + mes;
	}
</script>
@endsection