@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
				<div class="thead border-bottom mb-3 px-2">
					<div class="titulo mb-0"><i class="fas fa-list-alt"></i> <i class="ico lista"></i> Lista de Modulos</div>
					
				</div>
				<div class="px-md">
					
			
				
	<div class="card caixa blue-100 mb-4">			
				
				<div class="tabela-responsiva">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable">
						<thead> 
						  <tr>
							<th class="text-center" width="40">ID</th>
							<th class="text-left">Nome</th>
						  </tr>
						</thead> 
						<tbody>
						@foreach($lista as $v)
							<tr>
								<td>{{$v->id}}</td>
								<td>{{$v->nome}}</td>
                              
							</tr>
						@endforeach 						
						</tbody>
					</table>
					</div>
										
					
					</div>
				
			</section>
</div>
@endsection