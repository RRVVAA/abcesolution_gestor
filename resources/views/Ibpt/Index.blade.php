@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<div class="caixa">
		<div class="thead border-bottom p-1">
				<span class="titulo mb-0"><i class="far fa-list-alt mr-1"></i> Lista de Ibt </span></span>
				<div>
					<a href="{{route('ibpt.create')}}" class="btn btn-azul d-inline-block" title="Adicinar novo"><i class="fas fa-plus-circle"></i></a>
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
                                    <th align="left" >NCM</th>
                                    <th align="center">Descrição</th>
                                    <th align="center">estadual</th>
                                    <th align="center">municipal</th>
                                    <th align="center">nacionalfederal</th>
                                    <th align="center">importadosfederal</th>
                                    <th align="center">ex</th>
                            </tr>
                    </thead>
                    <tbody>	
                   @foreach($lista as $l)
						<tr>
							<td align="center">{{$l->id}}</td>
							<td align="left">{{$l->ncm}}</td>
							<td align="center">{{$l->descricao}}</td>
							<td align="center">{{$l->estadual}}</td>
							<td align="center">{{$l->municipal}}</td>
							<td align="center">{{$l->nacionalfederal}}</td>
							<td align="center">{{$l->importadosfederal}}</td>
							<td align="center">{{$l->ex}}</td>	 
                            </tr>
					@endforeach
					</tbody>
			</table>   
	</div>
	
							
	</div>
</div>
@endsection