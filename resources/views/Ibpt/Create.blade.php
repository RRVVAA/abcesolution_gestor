@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<div class="caixa">
  <div class="thead border-bottom mb-3 p-1">
		<div class="titulo mb-0"><i class="fas fa-plus-circle"></i> Importar IBPT</div>
		<div>
			<a href="{{route('ibpt.index')}}" class="btn btn-azul mx-1 d-inline-block btn-pequeno"><i class="fas fa-arrow-left"></i> Voltar</a>							
		</div>
	</div>                 
 		<form action="{{route('ibpt.store')}}" method="Post" enctype="multipart/form-data">
         	@csrf
   <div class="px-md">
   <div id="tabs">
	 
	  <div id="tab-1">
		<div class="p-2">
			<fieldset>
				<legend>Informações básicas</legend>
				
				<div class="rows">												
					<div class="col-4 mb-3">
							<label class="text-label" id="lblRazaoSocial">Arquivo</label>	
							<input type="file" name="file"  id="arquivo" class="form-campo">
					</div>                                    
					<div class="col-4 mb-3" id="divFantasia">
							<label class="text-label">Estado</label>	
							<select class="form-campo" name="uf" >
                                @foreach($estados as $e)
                              	<option value="{{$e->uf}}" >{{$e->estado}}</option>
                              @endforeach 
        				   </select>
					</div>		
					
					<div class="col-2 text-center pb-4 mt-4">
            			<input type="submit" value="Salvar" class="btn btn-azul m-auto">
            		</div>
				</div>
			</fieldset>
			
			
		</div>
	  </div>
	  
	  
		

         
 </div>
		
	  </div>
	
</form>
</div>

@endsection