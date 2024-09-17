@extends("template_gestor")
@section("conteudo")

<div class="conteudo">
<section class="caixa">
<div class="thead border-bottom mb-3 px-2">
		<div class="titulo mb-0">
			<span><i class="fas fa-list-alt"></i> Lista de Perfil</span>
			<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2"> Lista de Perfil</b></span> 
		</div>
		
	</div>
	<div class="px-md">					
	<div class="card blue-100 mb-3 bg-normal">					
					<div class="lst ">
						@if(isset($perfil))    
                       <form action="{{route('perfil.update', $perfil->id)}}" method="POST" >
                           <input name="_method" type="hidden" value="PUT"/>
                         @else                       
                        	<form action="{{route('perfil.store')}}" method="Post" >
                        @endif
                        	@csrf
						<div class="rows">
								
								<div class="col-6">
                    					<input type="text" name="nome" value="{{isset($perfil->nome) ? $perfil->nome : old('nome')}}" placeholder="Nome" class="form-campo" >
								</div>
								<div class="col-4">
                    					<input type="text" name="descricao" value="{{isset($perfil->descricao) ? $perfil->descricao : old('descricao')}}"   placeholder="Descrição"class="form-campo" >
								</div>
							
								
								<div class="col-2">
								<input type="hidden" name="id" value="{{isset($perfil->id) ? $perfil->id: NULL }}">
									<input type="submit" class="btn btn-azul2 width-100" value="Salvar">
								</div>
						</div>
						</form>
					</div>
	</div>
						
	
	<div class="card caixa blue-100 mb-3 alt">			
				<div class="tabela-responsiva">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable">
						<thead> 
						  <tr>
						  <th align="left">ID</th>
							<th align="left">Nome</th>
							<th align="left">Descrição</th>
							<th align="left">Permissões</th>
							<th align="left">Vincular</th>
							<!--  <th align="center">Módulos</th>-->
							<th align="center" width="30">Editar</th>
							<th align="center" width="30">Excluir</th>
						  </tr>
						</thead> 
						<tbody>
						@foreach($lista as $perfil)
							<tr>
								<td class="text-center">{{$perfil->id}}</td>
								<td class="text-center">{{$perfil->nome}}</td>
								<td class="text-center">{{$perfil->descricao}}</td>
								<td class="text-center"><a href="{{route('perfil.permissao',$perfil->id)}}" class="d-inline-block btn btn-roxo btn-pequeno" title="Permissões"><i class="fas fa-check"></i> Permissões</a>  </td>									
							    <td class="text-center"><a href="{{route('perfil.vincular', $perfil->id)}}" class="d-inline-block btn btn-azul btn-pequeno" title="Vincular"><i class="fas fa-external-link-square-alt"></i> Vincular</a> </td>									
                            	<td class="text-center"><a href="{{route('perfil.edit', $perfil->id)}}" class="d-inline-block btn btn-verde btn-pequeno btn-circulo" title="Editar"><i class="fas fa-edit"></i></a> </td>									
                               
                                <td class="text-center">
                                <a href="#" onclick="confirm('Tem Certeza?') ? document.getElementById('apagar{{$perfil->id}}').submit() : '';" class="d-inline-block btn btn-vermelho btn-circulo btn-pequeno" title="Excluir"><i class="fas fa-trash-alt"></i></a>
                                    <form action="{{route('perfil.destroy', $perfil->id)}}" method="POST" id="apagar{{$perfil->id}}">
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