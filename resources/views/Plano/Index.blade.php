@extends("template_gestor")
@section("conteudo")

<div class="conteudo">
<section class="caixa">
<div class="thead border-bottom mb-3 px-2">
		<div class="titulo mb-0">
		<span><i class="fas fa-list-alt"></i> Planos</span>
		<span class="mig"><a href="{{route('index')}}" class="text-azul"> Home </a> <i class="fas fa-angle-double-right text-azul"></i> <b class="text-azul2">Lista de planos</b></span>
		</div>
		
	</div>
	<div class="px-md">					
	<div class="card blue-100 mb-3 bg-normal">					
					<div class="lst">
						@if(isset($plano))    
                           <form action="{{route('plano.update', $plano->id)}}" method="POST">
                           <input name="_method" type="hidden" value="PUT"/>
                         @else                       
                        	<form action="{{route('plano.store')}}" method="Post">
                        @endif
                        	@csrf
						<div class="rows">								
								<div class="col-4">
								        <label class="text-label d-block ">Nome </label>								
                    					<input type="text" name="nome" required value="{{($plano->nome) ?? old('nome')}}" placeholder="Nome" class="form-campo" >
								</div>							
								<div class="col-2">
								        <label class="text-label d-block ">Limite Usuário </label>								
                    					<input type="number" name="limite_usuario" required placeholder="Limite Usuário" value="{{($plano->limite_usuario) ?? old('limite_usuario')}}" class="form-campo" >
								</div>
								<div class="col-2">
								        <label class="text-label d-block ">Limite Nfe </label>								
                    					<input type="number" name="limite_nfe" required placeholder="Limite Nfe" value="{{($plano->limite_nfe) ?? old('limite_nfe')}}" class="form-campo" >
								</div>
								<div class="col-2">
								        <label class="text-label d-block ">Limite Nfce </label>								
                    					<input type="number" name="limite_nfce" required placeholder="Limite Nfce" value="{{($plano->limite_nfce) ?? old('limite_nfce')}}" class="form-campo" >
								</div>
								
								<div class="col-2">
								        <label class="text-label d-block ">Limite PDV </label>								
                    					<input type="number" name="limite_pdv" required placeholder="Limite Nfe" value="{{($plano->limite_pdv) ?? old('limite_pdv')}}" class="form-campo" >
								</div>
								
								<div class="col-2">
								        <label class="text-label d-block ">Valor Setup </label>								
                    					<input type="text" name="valor_setup"  placeholder="Valor Setup" value="{{($plano->valor_setup) ?? old('valor_setup')}}" class="form-campo mascara-float" >
								</div>
								
								<div class="col-2">
								        <label class="text-label d-block ">Destaque </label>
								       	<select name="destaque" class="form-campo">
								        	<option value="S" {{($plano->destaque ?? null) == "S" ? "selected" : "" }}>Sim</option>
								        	<option value="N" {{($plano->destaque ?? null) == "N" ? "selected" : "" }} >Não</option>
								        </select>								
								</div>
								
								<div class="col-2">
								        <label class="text-label d-block ">.</label>								
									<input type="submit" class="btn btn-azul2 width-100" value="Salvar">
								</div>
						</div>
						</form>
					</div>
		</div>
						
	
	<div class="card caixa blue-100 mb-3">				
				<div class="tabela-responsiva">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" id="dataTable" class="tabela">
						<thead> 
						  <tr>
						  <th align="left">ID</th>
							<th align="left">Nome</th>
							<th align="left">Limite Usuário</th>
							<th align="left">Limite NFE</th>
							<th align="left">Limite NFCE</th>
							<th align="left">Limite PDV</th>
							<th align="left">Valor Setup</th>
							<th align="left">Destaque</th>
							<th align="center">Preço</th>
							 <th align="center">Módulos</th>
							<th align="center" >Editar</th>
							<th align="center" >Excluir</th>
						  </tr>
						</thead> 
						<tbody>
						@foreach($lista as $v)
							<tr>
								<td class="text-center">{{$v->id}}</td>
								<td class="text-center">{{$v->nome}}</td>
								<td class="text-center">{{$v->limite_usuario}}</td>
								<td class="text-center">{{$v->limite_nfe}}</td>
								<td class="text-center">{{$v->limite_nfce}}</td>
								<td class="text-center">{{$v->limite_pdv}}</td>
								<td class="text-center">{{$v->valor_setup}}</td>
								<td class="text-center">{{$v->destaque}}</td>
								<td class="text-center"><a href="{{route('plano.precos', $v->id)}}" class="d-inline-block btn btn-laranja btn-pequeno" title="Preços"><i class="fas fa-dollar-sign"></i> Preços</a>  </td>									
								<td class="text-center"><a href="{{route('plano.modulos', $v->id)}}" class="d-inline-block btn btn-roxo btn-pequeno" title="Módulos"><i class="fas fa-grip-horizontal"></i> Módulos</a>  </td>									
								<td class="text-center"><a href="{{route('plano.edit', $v->id)}}" class="d-inline-block btn btn-verde btn-pequeno btn-circulo" title="Editar"><i class="fas fa-edit"></i></a>  </td>									
                               
                                <td class="text-center">
                                <a href="#" onclick="confirm('Se você excluir este plano, vai excluir também todas as assinaturas relacionadas a ele, Deseja Realmente Excluir?') ? document.getElementById('apagar{{$v->id}}').submit() : '';" class="d-inline-block btn btn-vermelho btn-circulo btn-pequeno" title="Excluir"><i class="fas fa-trash-alt"></i></a>
                                    <form action="{{route('plano.destroy', $v->id)}}" method="POST" id="apagar{{$v->id}}">
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