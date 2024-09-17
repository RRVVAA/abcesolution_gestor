@if (isset($errors))
	
	@if(count($errors) ==1 )	 
     	<span class="msg msg-vermelho position-fixed right top">
     		@foreach($errors->all() as $erro)     			
      			<i class="fas fa-bug"></i> <b>Ops!</b> {{$erro}} <a href="javascript:;" onclick="fecharMsg()" class="sair">x</a>
      		@endforeach
      	</span>      	
    @elseif (count($errors) > 1)  	
         <span class="msg msg-vermelho position-fixed right top">
    		<i class="fas fa-bug"></i> <b>Ops!</b> Erros Encontrados
    		<ul>
    		@foreach($errors->all() as $erro)
    			<li>{{$erro}}</li>
    		@endforeach
    		</ul>
    		<a href="javascript:;" onclick="fecharMsg()" class="sair">x</a>			
    	</span>
   @endif  
@endif

