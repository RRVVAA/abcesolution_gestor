@extends("template_gestor")
@section("conteudo")

<div class="conteudo">
<section class="caixa">
<div class="thead border-bottom mb-3 px-2">
		<div class="titulo mb-0"><i class="fas fa-list-alt"></i> Lista de permissão</div>
		
	</div>
	<div class="px-md">					
		<div class="card mb-3 blue-100 bg-normal">					
					<div class="lst ">
						 @if(isset($permissao))    
                       <form action="{{route('permissao.update', $permissao->id)}}" method="POST" >
                       <input name="_method" type="hidden" value="PUT"/>
                     @else                       
                    	<form action="{{route('permissao.store')}}" method="Post" >
                    @endif
                    	@csrf
						<div class="rows">								
								<div class="col-4">	
                                        <label class="text-label d-block ">permissao </label>
										<input type="text" name="permissao" value="{{isset($permissao->permissao) ? $permissao->permissao : old('permissao')}}" class="form-campo">
                                </div>
                                <div class="col-6">	
                                        <label class="text-label d-block ">Descrição </label>
										<input type="text" name="descricao" value="{{isset($permissao->descricao) ? $permissao->descricao : old('descricao')}}" class="form-campo">
                                </div>                                       
                                
                                <div class="col-2 mt-1 pt-1">
                                		<input type="hidden" name="id" value="{{isset($permissao->id) ? $permissao->id: NULL }}">
                                        <input type="submit" value="Salvar" class="btn btn-azul2 text-uppercase width-100">
                                </div>
							
						</div>
						</form>
					</div>
			</div>
						
		<div class="card caixa blue-100">		
				<div class="tabela-responsiva">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable">
						<thead> 
						  <tr>
								<th align="center">Id</th>
                                <th class="text-left">Permissão</th>
                                <th class="text-left">Descrição</th>
                                <th align="center">Editar</th>
                                <th align="center">Excluir</th>
						  </tr>
						</thead> 
						<tbody>
						 @foreach($lista as $permissao)
							<tr>
							<td align="center">{{$permissao->id}}</td>
							<td class="text-left">{{$permissao->permissao}}</td>
							<td class="text-left">{{$permissao->descricao}}</td>
							<td align="center"><a href="{{route('permissao.edit', $permissao->id)}}" class="btn d-inline-block btn btn-verde btn-circulo btn-pequeno" title="Editar"><i class="fas fa-edit"></i></a></td>
							 <td align="center">
							<a href="#" onclick="confirm('Tem Certeza?') ? document.getElementById('apagar{{$permissao->id}}').submit() : '';" class="d-inline-block btn btn-vermelho btn-circulo btn-pequeno" title="Excluir"><i class="fas fa-trash-alt"></i></a>
                                    <form action="{{route('permissao.destroy', $permissao->id)}}" method="POST" id="apagar{{$permissao->id}}">
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