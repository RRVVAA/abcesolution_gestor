@extends("Gestor.template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
	<div class="thead border-bottom mb-3 p-2">
		<div class="titulo mb-0"><i class="fas fa-list-alt"></i> Lista de contratos</div>
		<div class="text-end d-flex">
			<a href="{{route('gestor.planoempresa.create')}}" class="btn btn-verde d-inline-block mx-1"><i class="fas fa fa-plus-circle" aria-hidden="true"></i> Contratar Novo</a>
			<a href="" class="btn btn-azul d-inline-block filtro"><i class="fas fa fa-filter" aria-hidden="true"></i> Filtrar</a>
		</div>
	</div>
				<div class="px-md">
				<div class="card">
					<div class="lst mostraFiltro">
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
							<th class="text-center">ID</th>
							<th class="text-center">Nome</th>
							<th class="text-center">Plano</th>
							<th class="text-center">Status</th>
							<th class="text-center" width="30">Editar</th>
							<th class="text-center"  width="30">Excluir</th>
						  </tr>
						</thead> 
						<tbody>
						@foreach($lista as $v)
							<tr>
								<td class="text-center">{{$v->id}}</td>
								<td class="text-center">{{$v->empresa->nome}}</td>
								<td class="text-center">{{$v->plano->nome}}</td>
								<td class="text-center">{{$v->status->nome}}</td>
								<td class="text-center"><a href="{{route('gestor.modulo.edit', $v->id)}}" class="d-inline-block btn btn-verde btn-circulo btn-pequeno" title="Editar"><i class="fas fa-edit"></i> </a>  </td>									
                                <td class="text-center">
                                <a href="#" onclick="confirm('Tem Certeza?') ? document.getElementById('apagar{{$v->id}}').submit() : '';" class="d-inline-block btn btn-vermelho btn-circulo btn-pequeno"><i class="fas fa-trash-alt"></i></a>
                                    <form action="{{route('gestor.modulo.destroy', $v->id)}}" method="POST" id="apagar{{$v->id}}">
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