@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
		<div class="thead border-bottom mb-3 px-2">
			<div class="titulo mb-0">
				<span><i class="fas fa-list-alt"></i> Planos</span>
				<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <a href="{{route('plano.index')}}"  class="text-azul">Lista de planos</a> <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2">{{$plano->nome}}</b></span>
			</div>
		</div>
			<div class="px-md">										
									                      
                     <div class="lst text-right border-bottom mb-3 pb-2">
						<a href="{{route('plano.vincular', $plano->id)}}" class="btn btn-azul2 d-inline-block"><i class="fas fa-plus-circle"></i> Vincular Novos Módulos</a>
                    </div>
					
			</div>			
		
		<div class="card caixa blue-100 mb-3">			
				<div class="tabela-responsiva">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable">
						<thead> 
						  <tr>
							<th class="text-left" width="40">ID</th>
							<th class="text-left">Módulo</th>
							<th class="text-center" width="30">Excluir</th>
						  </tr>
						</thead> 
						<tbody>
						@foreach($lista as $v)
							<tr>
								<td>{{$v->id}}</td>
								<td>{{$v->modulo->nome}}</td>
								 <td align="center">
                                <a href="#" onclick="confirm('Tem Certeza?') ? document.getElementById('apagar{{$v->id}}').submit() : '';" class="d-inline-block btn btn-vermelho btn-circulo btn-pequeno" title="Excluir"><i class="fas fa-trash-alt"></i></a>
                                    <form action="{{route('planomodulo.destroy', $v->id)}}" method="POST" id="apagar{{$v->id}}">
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
				
			</section>
		</div>
	</div>
</div>
@endsection