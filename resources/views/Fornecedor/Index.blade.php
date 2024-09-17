@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<div class="caixa">
		<div class="thead border-bottom p-1">
				<span class="titulo mb-0"><i class="far fa-list-alt mr-1"></i> Lista de fornecedores </span></span>
				<div>
					<a href="{{route('fornecedor.create')}}" class="btn btn-azul d-inline-block" title="Adicinar novo"><i class="fas fa-plus-circle"></i></a>
					<a href="" class="btn btn-roxo filtro ml-1 d-inline-block" title="Filtrar"><i class="fas fa-filter"></i></a>
				</div>
		</div>
       <div class="px-md">	              
				<div class=""> 
					<form name="busca" action="" method="GET">
					<div class="mostraFiltro lst mt-3">
						 <div class="rows">	
							<div class="col-6">
									<span class="text-label">Fornecedor</span>
									<input type="text" name="fornecedor" value="" placeholder="Digite aqui..." class="form-campo">
							</div>
							<div class="col-4">
									<span class="text-label">Categoria</span>
									<select class="form-campo" name="idCategoria">
									<option value="">Escolha uma Opção</option>
									<option value="1">Panela</option><option value="2">Cuzcuzeira</option><option value="3">Copo</option><option value="4">Caneca</option><option value="5">Papeiro</option><option value="6">Leiteira</option><option value="7">Frigideira</option><option value="8">Bacia</option><option value="9">Balde</option><option value="10">Assadeira</option><option value="11">Baquelite</option><option value="12">yyy</option>                                         </select>
							</div>
							 <div class="col-2 pt-1 mt-1">
								  <input type="submit" value="Pesquisar" class="btn btn-azul width-100 text-uppercase">
							  </div>
						</div>								 
                    </div>								 
                     </form>
				</div>
            		
   
        <div class="card caixa alt blue-100 mb-3 mt-3">
            <table cellpadding="0" cellspacing="0" id="dataTable" width="100%">
                    <thead>
                            <tr>
                                    <th align="center">Id</th>
                                    <th align="left" width="380">Razão Social</th>
                                    <th align="center">CNPJ</th>
                                    <th align="center">Email</th>
                                    <th align="center">Celular</th>
                                    <th align="center">Editar</th>
                                    <th align="center">Excluir</th>
                            </tr>
                    </thead>
                    <tbody>	
                    @foreach($lista as $l)
						<tr>
							<td align="center">{{$l->id}}</td>
							<td align="left">{{$l->razao_social}}</td>
							<td align="center">{{$l->cpf_cnpj}}</td>
							<td align="center">{{$l->email}}</td>
							<td align="center">{{$l->fone}}</td>
							<td align="center"><a href="{{route('fornecedor.edit', $l->id)}}" class="d-inline-block btn btn-verde btn-circulo btn-pequeno" title="Editar"><i class="fas fa-edit"></i></a></td>
							 <td align="center">
							<a href="#" onclick="confirm('Tem Certeza?') ? document.getElementById('apagar{{$l->id}}').submit() : '';" class="d-inline-block btn btn-vermelho btn-circulo btn-pequeno" title="Excluir"><i class="fas fa-trash-alt"></i></a>
                                    <form action="{{route('fornecedor.destroy', $l->id)}}" method="POST" id="apagar{{$l->id}}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{csrf_field()}}
                                    </form>
                                 </td>						
                            </tr>
					@endforeach
					</tbody>
			</table>   
	</div>
								
								<!-- qunado não hover pedido 
								
								<div class="caixa p-2">
									<div class="msg msg-verde">
									<p><b><i class="fas fa-check"></i> Mensagem de boas vindas</b> Parabéns seu fornecedor foi inserido com sucesso</p>
									</div>
									<div class="msg msg-vermelho">
									<p><b><i class="fas fa-times"></i> Mensagem de Erro</b> Houve um erro</p>
									</div>
									<div class="msg msg-amarelo">
									<p><b><i class="fas fa-exclamation-triangle"></i> Mensagem de aviso</b> Tem um aviso pra você</p>
									</div>
								</div>
								-->
	
							
	</div>
</div>
@endsection