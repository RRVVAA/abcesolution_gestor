@extends("template_gestor")
@section("conteudo")

<div class="conteudo">
<section class="caixa">
	<div class="thead border-bottom mb-3 px-2">
		<div class="titulo mb-0">
		<i class="fas fa-list-alt"></i> Perfis do Plano <span class="text-azul"></span>
		<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a>  <i class="fas fa-angle-double-right text-azul"></i> <a href="{{route('plano.index')}}"  class="text-azul">Lista de planos</a> <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2">{{$plano->nome}}</b></span>
		</div>
		
	</div>
	<div class="px-md">					
	<div class="card caixa alt blue-100">					
					<div class="lst text-right border-bottom mb-3 pb-2">				
						<a href="{{route('plano.vincular', $plano->id)}}" class="d-inline-block btn btn-azul"><i class="fas fa-arrow-up"></i> Vincular perfil</a>                                  
					</div>
						
				
				<div class="tabela-responsiva">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable">
						<thead> 
						  <tr>
						  		<th align="center" width="60">Id</th>
                                <th class="text-center">Perfil</th>
                                <th align="center" width="40">Excluir</th>
						  </tr>
						</thead> 
						<tbody>
						
						 @foreach($perfis as $p)
							<tr>
								<td class="text-center">{{$p->id}}</td>
								<td class="text-center">{{$p->nome}}</td>
                                <td class="text-center">
                                <a href="#" onclick="confirm('Tem Certeza?') ? document.getElementById('apagar{{$p->id}}').submit() : '';" class="d-inline-block btn btn-vermelho btn-circulo btn-pequeno"><i class="fas fa-trash-alt"></i></a>
                                    <form action="{{route('planoperfil.destroy', $p->id)}}" method="POST" id="apagar{{$p->id}}">
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