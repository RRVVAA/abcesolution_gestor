@if(Session::has('msg_sucesso'))  
    <span class="msg msg-verde position-fixed right top">
    	<i class="fas fa-check"></i> <b>Sucesso!</b> {{Session::get('msg_sucesso')}}<a href="javascript:;" onclick="fecharMsg()" class="sair">x</a>
    </span>
@endif

@if(Session::has('msg_erro'))  
    <span class="msg msg-vermelho position-fixed right top">
    	<i class="fas fa-check"></i> <b>Erro!</b> {{Session::get('msg_erro')}}<a href="javascript:;" onclick="fecharMsg()" class="sair">x</a>
    </span>
@endif

@if(Session::has('msg_atencao'))  
    <span class="msg msg-azul position-fixed right top">
    	<i class="fas fa-check"></i> <b>Atenção!</b> {{Session::get('msg_erro')}}<a href="javascript:;" onclick="fecharMsg()" class="sair">x</a>
    </span>
@endif

@if(Session::has('msg_aviso'))  
    <span class="msg msg-amarelo position-fixed right top">
    	<i class="fas fa-check"></i> <b>Aviso!</b> {{Session::get('msg_erro')}}<a href="javascript:;" onclick="fecharMsg()" class="sair">x</a>
    </span>
@endif
