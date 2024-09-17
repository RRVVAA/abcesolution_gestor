<?php
use App\Service\ConstanteService;
?>
@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
		<div class="thead border-bottom mb-3 p-1">
			<div class="titulo mb-0">
				<span><i class="fas fa-list-alt"></i> Contas a Receber</span>
				<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2">Lista de contas a receber</b></span>
			</div>
			<div class="text-end d-flex">

				<a href="{{route('receber.create')}}" class="btn btn-azul d-inline-block ml-1" title="Adicionar Novo"><i class="fas fa fa-plus-circle" aria-hidden="true"></i> </a>

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
							<th class="text-center">ID</th>
							<th class="text-left">Cliente</th>
							<th class="text-center">Data Lançamento</th>
							<th class="text-center">Data Vencimento</th>
							<th class="text-center">Data Recebimento</th>
							<th class="text-center">Descrição</th>
							<th class="text-center">Valor</th>
							<th class="text-center">Status</th>
							
							<th class="text-center" style="width: 115px;">Opções</th>
						  </tr>
						</thead> 
						<tbody>
						@foreach($lista as $v)
							<tr>
								<td  class="text-center">{{$v->id}}</td>
								<td  class="text-left">{{$v->empresa->razao_social}}</td>
								<td  class="text-center">{{databr($v->data_lancamento)}}</td>
								<td  class="text-center">{{databr($v->data_vencimento)}}</td>
								<td  class="text-center">{{isset($v->recebimento) ? databr($v->recebimento->data_recebimento) : '--'}}</td>
								<td  class="text-center">{{$v->descricao}}</td>
								<td  class="text-center">{{moedaBr($v->valor)}}</td>
                                <td align="center"><span class="{{ strtolower($v->status->status) }}">{{ $v->status->status }}</span></td>
							  
									<td  class="text-center"><a href="{{route('receber.faturar', $v->id)}}" class="d-inline-block btn btn-roxo btn-pequeno" title="Faturar"><i class="fas fa-donate"></i> </a>  
									<a href="{{route('receber.edit', $v->id)}}" class="d-inline-block btn btn-verde btn-pequeno btn-circulo" title="Editar"><i class="fas fa-edit"></i></a> 								
    								
                                    <a href="#" onclick="confirm('Tem Certeza?') ? document.getElementById('areceber{{$v->id}}').submit() : '';" class="d-inline-block btn btn-vermelho btn-circulo btn-pequeno"><i class="fas fa-trash-alt"></i></a>
                                        <form action="{{route('receber.destroy', $v->id)}}" method="POST" id="areceber{{$v->id}}">
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
		window.location.href=base_url + "receber/pormes/?ano=" + ano + "&mes=" + mes;
	}
</script>
@endsection