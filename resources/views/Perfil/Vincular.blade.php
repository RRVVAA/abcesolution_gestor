@extends("template_gestor")
@section("conteudo")

<div class="conteudo">
<section class="caixa">
<div class="thead border-bottom mb-3 px-2">
		<div class="titulo mb-0">
			<span><i class="fas fa-list-alt"></i> Vincular Permissões do Perfil: <span class="text-azul">{{$perfil->nome}}</span></span>
			<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <a href="{{route('perfil.index')}}" class="text-azul"> Lista de perfil </a> <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2"> {{$perfil->nome}}</b></span>
		</div>
		
	</div>
	<div class="px-md">		
		<div class="card bg-normal mb-3">
			 
           <form action="{{route('perfil.vincular', $perfil->id)}}" method="POST" > 
           @csrf           
			<div class="rows">
					
					<div class="col-10">
        					<input type="text" name="filtro" value="{{ $filtro['filtro'] ?? '' }}" placeholder="Nome" class="form-campo" >
					</div>
					<div class="col-2">
						<input type="submit" class="btn btn-azul2 width-100" value="Filtrar">
					</div>
			</div>
			</form>
		</div>	
	<div class="card caixa blue-100">							
				<form action="{{ route('perfil.vincularPermissao', $perfil->id) }}" method="POST">
				@csrf
				<div class="tabela-responsiva">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable">
						<thead> 
						  <tr>
						  		<th class="text-center" width="70px">#marcar</th>
                                <th class="text-left" >Permissao</th>
						  </tr>
						</thead> 
						<tbody>
						
                        
						 @foreach($lista as $p)
							<tr>
								<td class="text-center check"><input type="checkbox" name="permissoes[]" value="{{ $p->id }}" id="{{ $p->id }}"></td>
							
								<td class="text-left"><label for="{{ $p->id }}">{{$p->permissao}}</label></td>
                              
							</tr>
						@endforeach 						
                        
											
						</tbody>
					</table>
					<div class="col-2">
						<input type="submit" class="btn btn-verde width-100" value="Vincular">
					</div>
					</div>
					</form>						
					
		</div>
	</div>
				
			</section>
</div>
@endsection