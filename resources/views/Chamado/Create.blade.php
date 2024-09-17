<?php
use App\Service\ConstanteService;
?>
@extends("template_gestor")
@section("conteudo")
<div class="conteudo">
<div class="caixa">
  <div class="thead border-bottom mb-3 p-1">
		<div class="titulo mb-0"><i class="fas fa-plus-circle"></i> Chamado: {{$chamado->assunto }}</div>
		<div>
			<a href="{{route('index')}}" class="btn btn-azul2 ml-1 d-inline-block btn-pequeno" title="Voltar"><i class="fas fa-arrow-left"></i> </a>							
		</div>
	</div>                 
                      
	
   <div class="px-md mb-5">
   <div id="" class="rows">
	 
	  <div id="tab-1" class="col-10 m-auto">
		<div class="p-2">			
			
		 @php
        	$url = getenv('APP_URL_ERP') . $chamado->anexo;
        @endphp	
			
			<fieldset  class="mb-3">					
				<legend>Dados do Chamado</legend>
																
				<div class="rows">
				
					<div class="col-6 mb-3 border-bottom pb-2">
                            <label class="text-label"><i class="fas fa-city"></i> Empresa</label>
							<input type="text"  value="{{ $chamado->empresa->razao_social }}"  class="fw-700 form-campo limpo p-0 min" readonly>							
                    </div>
                    
                    <div class="col-2 mb-3 border-bottom pb-2">
                            <label class="text-label"><i class="fas fa-calendar-alt"></i> Data e Hora</label>
							<input type="text"   value="{{ dataHoraBr($chamado->created_at) }}"  class="fw-700 form-campo limpo p-0 min" readonly>							
                    </div>
                    <div class="col-2 mb-3 border-bottom pb-2 text-center">
                            <label class="text-label"><i class="fas fa-check"></i> Status</label>	
                            <input type="text"   value="{{ $chamado->status->status }}"  class="text-center fw-700 form-campo limpo p-0 min" readonly>
                    </div> 
					 <div class="col-2  mb-3 border-bottom pb-2 "> 
                        <label class="text-label"><i class="fas fa-download"></i> Baixar anexos</label>
                        @if($chamado->anexo)
							<a href="{{ $url }}" class="btn btn-min px-3 btn-outline-azul d-inline-block text-uppercase"> Baixar</a>
						@else
							sem Anexo
						@endif
					</div>
                    <div class="col-12 mb-3 border-bottom pb-2 cham">
                            <label class="text-label fw-700 mb-3">Descrição</label>	
                            <span class="form-campo limpo p-0 min" >{{ $chamado->descricao }}</span>
                    </div> 
                   
				</div>
			
			</fieldset>
		@if(count($respostas) > 0)
			<fieldset  class="mb-3" style="background: #f3f4f5;">					
				<legend>Interaçoes</legend>

				@foreach($respostas as $resposta)												
    				<div class="rows border-bottom inter">
					<div class="col-12 mb-3 pb-0">                           
                            <small class="form-campo limpo p-0 min"><i class="fas fa-calendar-alt"></i> Data e hora <b>{{ dataHoraBr($resposta->created_at) }}</b> &nbsp; &nbsp; </b></small>
                    </div>					

                        <div class="col-12 mb-4">
                                <span class="form-campo limpo p-0 min" >{{ $resposta->descricao }}</span>
                        </div> 
                       
    				</div>
    			@endforeach
			
			</fieldset>
		@endif
		<form action="{{route('chamado.store')}}" method="Post">
				@csrf
			<fieldset  class="mb-3">					
				<legend>Nova Interação</legend>												
    				<div class="rows"> 
                        <div class="col-12 mb-4">
                                <label class="text-label fw-700">Nova Interação</label>	
                                <textarea class="form-campo min" name="descricao" rows="9"></textarea>
                        </div>  
    				</div>
					<div class="col-12">
					<input type="hidden" name="chamado_id" value="{{$chamado->id}}" />
					<input type="submit" value="Salvar Informações" class="btn btn-azul m-auto">
				</div>
			</fieldset>
			
					
			</form>	
				</div>
			
		</div>
	 

  </div>	
	  </div>
</div>	

</div>
@endsection