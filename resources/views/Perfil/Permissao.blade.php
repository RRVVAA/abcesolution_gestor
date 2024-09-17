@extends("template_gestor")
@section("conteudo")

<div class="conteudo">
<section class="caixa">
	<div class="thead border-bottom mb-3 px-2">
		<div class="titulo mb-0">
			<span><i class="fas fa-list-alt"></i> Lista de Permissões do Perfil: <span class="text-azul">{{$perfil->nome}}</span></span>
			<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <a href="{{route('perfil.index')}}" class="text-azul"> Lista de perfil </a> <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2"> {{$perfil->nome}}</b></span> 
		</div>		
	</div>
	<div class="px-md">					
	<div class="card caixa blue-100">					
					<div class="lst text-right border-bottom mb-3 pb-2">
						<a href="{{route('perfil.vincular', $perfil->id)}}" class="btn btn-azul2 d-inline-block"><i class="fas fa-plus-circle"></i> Vincular Novas Permissões</a>
                    </div>
						
				
				<div class="tabela-responsiva">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable">
						<thead> 
						  <tr>
						  		<th align="center" width="40">Id</th>
                                    <th class="text-left" >Permissao</th>
                                    <th align="center">Perfil</th>
                                    <th align="center">Excluir</th>
						  </tr>
						</thead> 
						<tbody>
						 @foreach($perfil_permissoes as $p)
							<tr>
								<td class="text-center">{{$p->id}}</td>
								<td class="text-left">{{$p->permissao->permissao}}</td>
								<td class="text-center">{{$p->perfil->nome}}</td>
                                <td class="text-center">
                                <a href="#" onclick="confirm('Tem Certeza?') ? document.getElementById('apagar{{$p->id}}').submit() : '';" class="d-inline-block btn btn-vermelho btn-circulo btn-pequeno" title="Excluir"><i class="fas fa-trash-alt"></i></a>
                                    <form action="{{route('perfilpermissao.destroy', $p->id)}}" method="POST" id="apagar{{$p->id}}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{csrf_field()}}
                                    </form>
                                 </td>
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