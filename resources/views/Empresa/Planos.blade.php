@extends("Gestor.template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
	<div class="thead border-bottom mb-3 p-2">
		<div class="titulo mb-0"><i class="fas fa-list-alt"></i> Planos</div>
		<div class="text-end d-flex">
			<a href="{{route('gestor.planoempresa.create')}}" class="btn btn-verde d-inline-block mx-1"><i class="fas fa fa-plus-circle" aria-hidden="true"></i> Contratar Novo Plano</a>
			<a href="" class="btn btn-azul d-inline-block filtro"><i class="fas fa fa-filter" aria-hidden="true"></i> Filtrar</a>
		</div>
	</div>
				
		<div class=" px-md">
		<span class="titulo h5">Lista de Planos da Empresa: <b class="text-azul">{{$empresa->razao_social}}</b></span>
		<div class="card caixa blue-100">
					<div class="lst mostraFiltro py-4">
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
									<input type="text"  name="" placeholder="Valor da pesquisar..."  class="form-campo">
								</div>
								<div class="col-2">
									<input type="submit" class="btn btn-azul2 width-100" value="pesquisar">
								</div>
						</div>
						</form>
					</div>
						
				
				<div class="tabela-responsiva">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable">
						<thead> 
						  <tr>
						  <th align="left">ID</th>
							<th align="left">Data Aquisição</th>
							<th align="left">Plano</th>							
							<th align="center">Valor Recorrente</th>
							<th align="center">Próximo Vencimento</th>
							<th align="center">Status</th>
							<th align="center">Editar</th>
							<th align="center">Excluir</th>
						  </tr>
						</thead> 
						<tbody>
						@foreach($lista as $v)
							<tr>
								<td>{{$v->id}}</td>
								<td>{{databr($v->data_aquisicao)}}</td>
								<td>{{$v->plano->nome}}</td>
								
								<td >{{$v->valor_recorrente}}</td>
								<td >{{databr($v->proximo_vencimento)}}</td>
								<td>{{$v->status->status}}</td>
								<td align="center"><a href="{{route('gestor.cliente.edit', $v->id)}}" class="d-inline-block btn btn-verde btn-pequeno  btn-circulo" title="Editar"><i class="fas fa-edit"></i> </a>  </td>									
                                <td align="center">
                                <a href="#" onclick="confirm('Tem Certeza?') ? document.getElementById('apagar{{$v->id}}').submit() : '';" class="d-inline-block btn btn-vermelho btn-circulo btn-pequeno" title="Excluir"><i class="fas fa-trash-alt"></i></a>
                                    <form action="{{route('gestor.cliente.destroy', $v->id)}}" method="POST" id="apagar{{$v->id}}">
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
				
			</section>
</div>
@endsection