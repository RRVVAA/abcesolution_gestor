@extends("template_gestor")
@section("conteudo")

<div class="conteudo">
<section class="caixa">
<div class="thead border-bottom mb-3 px-2">
		<div class="titulo mb-0">
			<span><i class="fas fa-list-alt"></i> Vincular Perfis do Plano: <span class="text-azul">{{$plano->nome}}</span></span>
			<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <a href="{{route('plano.index')}}" class="text-azul"> Lista de planos</a> <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2">{{$plano->nome}}</b></span>
		</div>
		
	</div>
	<div class="px-md">	
		<div class="card pb-2 bg-normal mb-3">
			 
           <form action="{{route('plano.vincular', $plano->id)}}" method="POST" > 
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
	<div class="card caixa alt blue-100">							
				<form action="{{ route('plano.vinculaModulo', $plano->id) }}" method="POST">
				@csrf
				<div class="tabela-responsiva">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable">
						<thead> 
						  <tr>
								<th align="center" width="50px">#</th>
                               <th class="text-left" >Módulo</th>
						  </tr>
						</thead> 
						<tbody>
						
                        
						 @foreach($lista as $p)
							<tr>
								<td class="text-center check"><input type="checkbox" name="modulos[]" value="{{ $p->id }}" id="{{ $p->id }}"></td>
							
								<td class="text-left"><label for="{{ $p->id }}">{{$p->nome}}</label></td>
                              
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