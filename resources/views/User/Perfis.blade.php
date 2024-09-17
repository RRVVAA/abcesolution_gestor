@extends("templates.template_admin")
@section("conteudo")
<div class="col-9 central mb-3">
<div class="rows">	
                <div class="col-12">
                <div class="caixa">
                    <div class="p-2 py-1 bg-title text-light text-uppercase h4 mb-0 text-branco d-flex justify-content-space-between">
						<span class="d-flex center-middle"><i class="far fa-list-alt mr-1"></i> Lista de perfil  </span>
						
					</div>
                        
					  
                       <form action="{{route('usuario.atribuirperfil', $usuario->id)}}" method="POST">
                    
                    	@csrf
                        
                        <div class="px-2 pt-2">	
							  <div class=" bg-padrao mt-2 p-2 radius-4">
							  <div class="rows">
                                        <div class="col-2">	
                                                <label class="text-label d-block text-branco">usuário </label>
                            					<input class="form-campo bg-secondary" value="{{$usuario->name}}" disabled>
                                        </div>
                                        <div class="col-3">	
                                                <label class="text-label d-block text-branco">email </label>
                            					<input class="form-campo disabled" value="{{$usuario->email}}" disabled>
                                        </div>   
                                        
                                        <div class="col-4">	
                                                <label class="text-label d-block text-branco">Selecione o perfil </label>
                            					<select class="form-campo" id="perfil" name="perfil">
                                                    @foreach($perfis as $p)
                                                        <option value="{{$p->nome}}">{{$p->nome}}</option>
                                                    @endforeach
                                                </select>
                                        </div>                                    
                                        
                                        <div class="col-2 mt-1 pt-1">
                                        		<input type="hidden" name="id" value="{{isset($perfil->id) ? $perfil->id: NULL }}">
                                                <input type="submit" value="Salvar" class="btn btn-roxo text-uppercase">
                                        </div>
                                </div>
                                </div>
                        </div>
                    </form>
                </div>
                </div>

		    <div class="col-12">
        <div class="px-2 pb-4">
            <table cellpadding="0" cellspacing="0" id="dataTable" width="100%">
                    <thead>
                            <tr>
                                    <th align="center">Id</th>
                                    <th align="left" >Perfil</th>
                                    <th align="center">Excluir</th>
                            </tr>
                    </thead>
                    <tbody>	
                   	 	@foreach($usuario->perfis as $key => $p)
						<tr>
							<td align="center">{{$p->id}}</td>
							<td align="left">{{$p->nome}}</td>							
							 <td align="center">
                                <a href="#" onclick="confirm('Tem Certeza?') ? document.getElementById('apagar-{{$key}}').submit() : '';" class="btn btn-vermelho d-inline-block"><i class="fas fa-trash-alt"></i></a>
                                    <form action="{{route('usuario.atribuirperfil', $usuario->id)}}" method="POST" id="apagar-{{$key}}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="perfil" value="{{$p->nome}}">
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
        </div>
        @endsection