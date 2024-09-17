@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<div class="caixa">
		<div class="thead border-bottom p-1">
				<span class="titulo mb-0"><i class="far fa-list-alt mr-1"></i> Lista de Comprovante </span>
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
                                <th class="text-center">#</th>
                                <th class="text-center">Descricao</th>
								<th class="text-center">Data Pagamento</th>
								<th class="text-center">Empresa</th>
								<th class="text-center">Confirmado</th>
								<th class="text-center">Valor</th>
								<th class="text-center">Visualizar</th>
								<th class="text-center">Confirmar</th>
                        </tr>
                    </thead>
                    <tbody>	
                    @foreach($lista as $comprovante)
                     @php
                    	$url = getenv('APP_URL_ERP') . $comprovante->nome_arquivo;
                    @endphp
						<tr>
							<td class="text-center">{{$comprovante->id}}</td>
							<td class="text-center">{{$comprovante->descricao}}</td>
							<td class="text-center">{{databr($comprovante->data_pagamento)}}</td>
							<td class="text-center">{{$comprovante->empresa->razao_social}}</td>														
							<td class="text-center">{{$comprovante->valor_pago}}</td>
							<td class="text-center">{{$comprovante->confirmado}}</td>	
							<td class="text-center"><a href="{{ $url}}" class="d-inline-block p-1 text-azul" title="visualizar empresas"><i class="fas fa-eye"></i> </a>  </td>
							<td class="text-center"><a href="{{route('comprovante.confirmarPagamento', $comprovante->id)}}" class="d-inline-block p-1 text-azul" title="visualizar empresas">Confirmar Pagamento</a>  </td>
						</tr>
					@endforeach
					</tbody>
			</table>   
	</div>
								
	
							
	</div>
</div>
@endsection