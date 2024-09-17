<header class="cabecalho">
			<div class="conteudo">
				<a href="" class="mobmenu"><i class="fas fa-bars"></i></a>
				<a href="{{route('index')}}" class="logo"><img src="{{asset('assets/gestor/img/logo.svg')}}"></a>
				<nav class="menu-topo-text">
					<ul>
						<li><a href="{{route('index')}}"><i class="ico home"></i>Home</a></li>
						<li><a href="{{route('empresa.index')}}"><i class="ico cad"></i>Empresas</a></li>
						<li><a href="{{route('plano.index')}}"><i class="ico lista"></i>Planos</a></li> 
						
						<li><a href="{{route('modulo.index')}}"><i class="ico lista"></i>Módulo</a></li>
						
						<li><a href="{{route('fornecedor.index')}}"><i class="ico lista"></i>Fornecedor</a></li>
						<li><a href="{{route('chamado.index')}}"><i class="ico cad"></i>Chamados</a></li>
						<li><a href="{{route('ibpt.index')}}"><i class="ico lista"></i>Ibpt</a></li>
						<li class="sub"><a href=""><i class="ico lista"></i>Financeiro</a> 
							<ul>
								<li><a href="{{route('pagar.index')}}"><i class="ico lista"></i>Contas a Pagar</a></li>
								<li><a href="{{route('receber.index')}}"><i class="ico lista"></i>Contas a Receber</a></li>
								<li><a href="{{route('fatura.index')}}"><i class="ico lista"></i>Faturas</a></li>
								<li><a href="{{route('despesa.index')}}"><i class="ico lista"></i>Despesas</a></li>
								<li><a href="{{route('tipodespesa.index')}}"><i class="ico lista"></i>Tipo Despesa</a></li>
								<li><a href="{{route('recebimento.index')}}"><i class="ico lista"></i>Recebimentos</a></li>
								<li><a href="{{route('pagamento.index')}}"><i class="ico lista"></i>Pagamentos</a></li>
								
							</ul>
						</li>	
					<!--  	<li class="sub"><a href=""><i class="ico lista"></i>ACL</a> 
							<ul>
								<li><a href="{{route('perfil.index')}}"><i class="ico lista"></i>Perfil</a></li>
								<li><a href="{{route('permissao.index')}}"><i class="ico lista"></i>Permissão</a></li>
								<li><a href="{{route('usuario.index')}}"><i class="ico lista"></i>Usuário</a></li>
							</ul>
						</li>
					-->
						<li class="sub alt ml-3">
							<div class="thumb">
									@if(!auth()->user()->foto)
    									<img src="{{asset('assets/gestor/img/img-usuario.png')}}" class="img-fluido" id="imgUp">
    								@else									
    									<img src="{{ url(auth()->user()->foto) }}" class="img-fluido" id="imgUp">
    								@endif
    						</div>
							<ul>
								<li>							
									<a href="{{route('meuperfil.index')}}">Jailton sousa</a>
								</li>
								<li>							
									<a href="{{route('login.out')}}"><i class="ico sair"></i>Sair</a>
								</li>
							</ul>
						</li>
					</ul>
				</nav>				
			</div>
		</header>