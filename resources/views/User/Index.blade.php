@extends("template_gestor")
@section("conteudo")

<div class="conteudo">
<section class="caixa">
	<div class="thead border-bottom mb-3 px-2">
		<div class="titulo mb-0">
			<span><i class="fas fa-list-alt"></i> Lista de Usuário</span>
			<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2"> Lista de usuário</b></span>
		</div>
		
	</div>
	<div class="px-md">					
			<div class="card bg-normal mb-3 blue-100">					
					<div class="lst ">
						@if(isset($usuario))    
                       <form action="{{route('usuario.update', $usuario->id)}}" method="POST" >
                           <input name="_method" type="hidden" value="PUT"/>
                         @else                       
                        	<form action="{{route('usuario.store')}}" method="Post" >
                        @endif
                        	@csrf
						<div class="rows">
								
								<div class="col-6">
                    					<input type="text" name="nome" value="{{isset($usuario->nome) ? $usuario->nome : old('nome')}}" placeholder="Nome" class="form-campo" >
								</div>
								<div class="col-4">
                    					<input type="text" name="descricao" value="{{isset($usuario->descricao) ? $usuario->descricao : old('descricao')}}"   placeholder="Descrição"class="form-campo" >
								</div>
															
								<div class="col-2">
								<input type="hidden" name="id" value="{{isset($usuario->id) ? $usuario->id: NULL }}">
									<input type="submit" class="btn btn-azul2 width-100" value="Salvar">
								</div>
						</div>
						</form>
					</div>
			</div>
					
	
	<div class="card caixa alt blue-100 mb-3">				
				<div class="tabela-responsiva">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable">
						<thead> 
						  <tr>
						  <th align="left">ID</th>
							<th align="left">Nome</th>
							<th align="left">Email</th>
							<th align="left">Empresa</th>
							<th align="left">Permissões</th>
							<!--  <th align="center">Módulos</th>-->
							<th align="center" width="30">Editar</th>
							<th align="center" width="30">Excluir</th>
						  </tr>
						</thead> 
						<tbody>
						@foreach($usuarios as $usuario)
							<tr>
								<td class="text-center">{{$usuario->id}}</td>
								<td class="text-center">{{$usuario->name}}</td>
								<td class="text-center">{{$usuario->email}}</td>
								<td class="text-center">{{$usuario->empresa->razao_social}}</td>
								<td class="text-center"><a href="{{route('perfil.permissao',$usuario->id)}}" class="d-inline-block btn btn-roxo btn-pequeno" title="Módulos"><i class="fas fa-edit"></i> Permissões</a>  </td>									
                            	<td class="text-center"><a href="{{route('perfil.edit', $usuario->id)}}" class="d-inline-block btn btn-verde btn-pequeno btn-circulo" title="Editar"><i class="fas fa-edit"></i></a>  </td>									
                               
                                <td class="text-center">
                                <a href="#" onclick="confirm('Tem Certeza?') ? document.getElementById('apagar{{$usuario->id}}').submit() : '';" class="d-inline-block btn btn-vermelho btn-circulo btn-pequeno"><i class="fas fa-trash-alt"></i></a>
                                    <form action="{{route('perfil.destroy', $usuario->id)}}" method="POST" id="apagar{{$usuario->id}}">
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