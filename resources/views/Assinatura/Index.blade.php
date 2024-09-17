@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
		<div class="thead border-bottom mb-3 p-1">					
			<div class="titulo mb-0">
			<span><i class="fas fa-warehouse"></i> Empresas</span>
			<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2">Lista de Empresas</b></span>
			</div>
			<div class="text-end d-flex">
				<a href="{{route('empresa.create')}}" class="btn btn-azul d-inline-block mx-1" title="Adicionar Novo"><i class="fas fa fa-plus-circle" aria-hidden="true"></i> </a>
				<a href="" class="btn btn-roxo d-inline-block filtro" title="Filtrar"><i class="fas fa fa-filter" aria-hidden="true"></i></a>
			</div>
		</div>
	<div class="px-md">		
	<div class="rows">		
		<div class="col-12 mb-3">
			<div class="lst mostraFiltro py-4 width-100">
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
							<input type="submit" class="btn btn-azul2" value="pesquisar" class="form-campo">
						</div>
				</div>
				</form>
			</div>
		</div>
		<div class="col-12  d-flex">
		<div class="card caixa blue-100 alt">
				<div class="base-lista">
				
				<div class="tabela-responsiva">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable" class="tabela">
						<thead> 
						  <tr>
						  <th align="left">ID</th>
							<th align="left">Nome</th>
							<th align="left">Email</th>
							<th align="center">Telefone</th>
							<th align="center">Planos Atual</th>
							<th align="center">Status Financeiro</th>
							<th align="center">Status Plano</th>
							<th align="center" width="200">Opções</th>
						  </tr>
						</thead> 
						<tbody>
						@foreach($lista as $v)						
							<tr>
								<td>{{$v->id}}</td>
								<td>{{$v->razao_social}}</td>
								<td>{{$v->email}}</td>
								<td align="center">{{$v->fone}}</td>
								<td align="center">{{($v->planopreco) ? $v->planopreco->plano->nome: "--"}}</td>
                                <td align="center"><span class="{{ strtolower($v->statusplano->status) }}">{{ $v->statusplano->status }}</span></td>
                                 <td align="center"><span class="{{ strtolower($v->status->status) }}">{{ $v->status->status }}</span></td>
                               	 
                                <td align="center">
                                	<a href="{{route('empresa.edit', $v->id)}}" class="btn btn-laranja d-inline-block" title="Editar Empresa"><i class="fas fa-edit"></i></a>
                                	<a href="{{route('empresa.show', $v->id)}}" class="d-inline-block btn btn-roxo btn-pequeno" title="Detalhes da Empresa"> <i class="fas fa-eye"></i> </a>
                                 @if(!$v->plano_preco_id)
                                	<a href="{{route('empresa.criarplano', $v->id)}}" class="d-inline-block btn btn-roxo btn-pequeno" title="Criar Plano"> <i class="fas fa-file-pdf"></i> </a>
                                 @else                                  
                                    <a href="{{route('empresa.fatura', $v->id)}}" class="btn btn-laranja d-inline-block" title="Visualizar Faturas"><i class="ico-ver-fatura"></i></a> 
                                @endif
                                <a href="#" onclick="confirm('Tem Certeza?') ? document.getElementById('apagar{{$v->id}}').submit() : '';" class="d-inline-block btn btn-vermelho btn-circulo btn-pequeno" title="Excluir"><i class="fas fa-trash-alt"></i></a>
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
		</div>
				
			</section>
</div>			
@endsection