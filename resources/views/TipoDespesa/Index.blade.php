@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<section class="caixa">
				<div class="thead border-bottom mb-3 px-2">
					<div class="titulo mb-0"><i class="fas fa-list-alt"></i> <i class="ico lista"></i> Lista de Tipo de Despesa</div>
					
				</div>
				<div class="px-md">
					
			<div class="card mb-3 blue-100 bg-normal">
					<div class="lst ">
						@if(isset($tipodespesa))    
						   <form action="{{route('tipodespesa.update', $tipodespesa->id)}}" method="POST">
						   <input name="_method" type="hidden" value="PUT"/>
						 @else                       
							<form action="{{route('tipodespesa.store')}}" method="Post">
						@endif
							@csrf
						<div class="rows">								
							<div class="col-10">
								<input type="text" name="nome"  value="{{($tipodespesa->nome) ?? old('nome')}}" placeholder="Nome" class="form-campo">
							</div>
							<div class="col-2">
								<input type="submit" class="btn btn-azul2 width-100" value="Salvar">
							</div>
						</div>
						</form>
					</div>
			</div>
				
	<div class="card caixa blue-100 mb-4">			
				
				<div class="tabela-responsiva">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable">
						<thead> 
						  <tr>
							<th class="text-center" width="40">ID</th>
							<th class="text-left">Nome</th>
							<th class="text-center" width="30">Editar</th>
							<th class="text-center" width="30">Excluir</th>
						  </tr>
						</thead> 
						<tbody>
						@foreach($lista as $v)
							<tr>
								<td>{{$v->id}}</td>
								<td>{{$v->nome}}</td>
								<td class="text-center"><a href="{{route('tipodespesa.edit', $v->id)}}" class="d-inline-block btn btn-verde btn-pequeno btn-circulo" title="Editar"><i class="fas fa-edit"></i> </a>  </td>									
                                <td class="text-center">
                                <a href="#" onclick="confirm('Tem Certeza?') ? document.getElementById('apagar{{$v->id}}').submit() : '';" class="d-inline-block btn btn-vermelho btn-circulo btn-pequeno" title="Excluir"><i class="fas fa-trash-alt"></i></a>
                                    <form action="{{route('tipodespesa.destroy', $v->id)}}" method="POST" id="apagar{{$v->id}}">
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
@endsection