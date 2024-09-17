<div class="col menu-lateral position-relative">

<nav class="menuprincipal" id="principal">				
					<ul class="menu-ul icones">
						<li><a href="{{route('home')}}"><i class="fas fa-home"></i> Home</a></li>
						<li><a href="{{route('pdv')}}"><i class="fas fa-home"></i> PDV</a></li>
						<li><a href="#menu_cadastro"><i class="icon fas fa-file"></i> Cadastro <span>+</span></a></li>
						<li><a href="#menu_compras"><i class="icon fas fa-cart-plus"></i> Compras <span>+</span></a></li>	

						<li><a href="#menu_estoque"><i class="icon fas fa-cart-plus"></i> Estoque <span>+</span></a></li>
						<li><a href="#menu_venda"><i class="icon fas fa-cart-plus"></i> Venda <span>+</span></a></li>	
						<li><a href="#menu_pedido"><i class="icon fas fa-cart-plus"></i> Pedido <span>+</span></a></li>	
						<li><a href="#menu_CTE"><i class="icon fas fa-cart-plus"></i> CTE <span>+</span></a></li>
						<li><a href="#menu_MDFE"><i class="icon fas fa-cart-plus"></i> MDFE <span>+</span></a></li>			

						<li><a href="#menu_loja"><i class="icon fas fa-shopping-basket"></i> Loja Virtual <span>+</span></a></li>					
						<li><a href="#menu_delivery"><i class="fas fa-shipping-fast"></i> Delivery <span>+</span></a></li>					
						<li><a href="#menu_financeiro"><i class="icon fas fa-hand-holding-usd"></i> Financeiro/contábil <span>+</span></a></li>					
					</ul>
</nav>

<!-- MENU CADASTRO -->
<nav class="menuprincipal" id="menu_cadastro">
	<ul class="menu-lista">
		<li class="icones voltar"><a href="" title="Recolher menu"><i class="far fa-file ativo"></i> <i class="fas fa-fw fa-arrow-left"></i></a></li>
		<h1 class="tt px-2"><b> Cadastros</b></h1>
			<div id="accordion" >
				<h3>Emitente</h3>
					<ul>
						<li><a href="{{route('emitente.index')}}">Lista todos</a></li>
						<li><a href="{{route('emitente.create')}}">Cadastrar novo</a></li>							
					</ul>
					
				  <h3>Categoria</h3>
					<ul>
						<li><a href="{{route('categoria.index')}}">Lista todos</a></li>
						<li><a href="{{route('categoria.create')}}"> Cadastrar novo</a></li>							
					</ul>				  
				  <h3>Produto</h3>
					<ul>
						<li><a href="{{route('produto.index')}}">Lista todos</a></li>
						<li><a href="{{route('produto.create')}}"> Cadastrar novo</a></li>							
					</ul>
				  <h3>Estado</h3>
				  <ul>
						<li><a href="index.php?link=8">Lista todos</a></li>
				  </ul>
				  <h3>Contato</h3>
					<ul>
						<li><a href="index.php?link=10">Lista todos</a></li>
						<li><a href="index.php?link=11"> Cadastrar novo</a></li>							
					</ul>
				  <h3>Usuário</h3>
					<ul>
						<li><a href="index.php?link=12">Lista</a></li>
						<li><a href="index.php?link=14"> Tabela</a></li>							
						<li><a href="index.php?link=16"> Ações</a></li>							
					</ul>
				  <h3>Diversos</h3>
				  <ul>
						<li><a href="lst-categoria.html">Tipo de movimento </a></li>
						<li><a href="lst-categoria.html">Status entrega </a></li>
						<li><a href="lst-categoria.html">Status cotação </a></li>
						<li><a href="lst-categoria.html">Status item cotação </a></li>
						<li><a href="lst-categoria.html">Status ordem de compra </a></li>
						<li><a href="lst-categoria.html">Status ordem de produção </a></li>
						<li><a href="lst-categoria.html">Status pedidos</a></li>
				  </ul>
			</div>
	</ul>
</nav>

<!-- MENU COMPRAS -->
<nav class="menuprincipal" id="menu_compras">
	<ul class="menu-lista">
		<li class="icones voltar"><a href="" title="Recolher menu"><i class="fas fa-cart-plus ativo"></i><i class="fas fa-fw fa-arrow-left"></i></a></li>
		<h1 class="tt px-2"><b> Compras</b></h1>
		<li><a href="{{route('compra.index')}}"> Lista Compras</a></li>
		<li><a href="{{route('compra.create')}}">Compra Manual</a></li>
		<li><a href="{{route('nfe.lerArquivo')}}">Importar NFE</a></li>
		<li><a href="{{route('solicitacao.index')}}"> Solicitação</a></li>
		<li><a href="{{route('cotacao.index')}}"> Cotação</a></li>
		<li><a href="{{route('ordemcompra.index')}}"> Ordem de compra</a></li>
		
	</ul>
</nav>

<!-- MENU ESTOQUE -->
<nav class="menuprincipal" id="menu_estoque">
	<ul class="menu-lista">
		<li class="icones voltar"><a href="" title="Recolher menu"><i class="fas fa-cubes ativo"></i><i class="fas fa-fw fa-arrow-left"></i></a></li>
		<h1 class="tt px-2"><b> Estoque</b></h1>
		<li><a href="">Tipo de Movimento</a></li>
		<li><a href="">Entrada Avulsa</a></li>
		<li><a href="">Saída Avulsa</a></li>
		<li><a href="">Ficha Razão</a></li>
		<li><a href="">Pedidos</a></li>		
	</ul>
</nav>

<nav class="menuprincipal" id="menu_venda">
	<ul class="menu-lista">
		<li class="icones voltar"><a href="" title="Recolher menu"><i class="fas fa-shopping-bag ativo"></i><i class="fas fa-fw fa-arrow-left"></i></a></li>
		<h1 class="tt px-2"><b> Vendas</b></h1>
		<li><a href="{{route('compra.index')}}"> Lista</a></li>
		<li><a href="{{route('nfe.lerArquivo')}}"> Nova Venda</a></li>
		<li><a href="{{route('compra.create')}}"> Frente de Caixa</a></li>
		<li><a href="index.php?link=19"> Orçamentos</a></li>
		<li><a href="index.php?link=19"> Ordem de Serviço</a></li>
		<li><a href="index.php?link=19"> Conta Crédito</a></li>
		<li><a href="index.php?link=19"> Devolução</a></li>
		<li><a href="index.php?link=19"> Agendamentos</a></li>		
	</ul>
</nav>

<!-- MENU PEDIDO -->
<nav class="menuprincipal" id="menu_pedido">
	<ul class="menu-lista">

		<li class="icones voltar"><a href="" title="Recolher menu"><i class="far fa-file-alt ativo"></i><i class="fas fa-fw fa-arrow-left"></i></a></li>
		<h1 class="tt px-2"><b> Pedido</b></h1>
		<li><a href="{{route('compra.index')}}"> Lista Compras</a></li>
		<li><a href="{{route('nfe.lerArquivo')}}"> Importar NFE</a></li>
		<li><a href="{{route('compra.create')}}"> Compra Manual</a></li>
		<li><a href="index.php?link=19"> Ordem de compra</a></li>

	</ul>
</nav>

<!-- MENU COMPRAS -->
<nav class="menuprincipal" id="menu_CTE">
	<ul class="menu-lista">
		<li class="icones voltar"><a href="" title="Recolher menu"><i class="far fa-far fa-copyright ativo"></i><i class="fas fa-fw fa-arrow-left"></i></a></li>
		<h1 class="tt px-2"><b> CTE</b></h1>
		<li><a href="{{route('compra.index')}}"> Lista</a></li>
		<li><a href="{{route('nfe.lerArquivo')}}"> Nova CTE</a></li>
		<li><a href="{{route('compra.create')}}"> Categoria de Despesas</a></li>
	</ul>
</nav>

<!-- MENU COMPRAS -->
<nav class="menuprincipal" id="menu_MDFE">
	<ul class="menu-lista">
		<li class="icones voltar"><a href="" title="Recolher menu"><i class="fab fa-medium-m ativo"></i><i class="fas fa-fw fa-arrow-left"></i></a></li>
		<h1 class="tt px-2"><b> MDFE</b></h1>
		<li><a href="{{route('compra.index')}}"> Lista</a></li>
		<li><a href="{{route('nfe.lerArquivo')}}">Nova</a></li>
	</ul>
</nav>

<!-- MENU Loja Virutal -->
<nav class="menuprincipal" id="menu_loja">
	<ul class="menu-lista">
		<li class="icones voltar"><a href="" title="Recolher menu"><i class="fas fa-shopping-basket ativo"></i><i class="fas fa-fw fa-arrow-left"></i></a></li>
		<h1 class="tt px-2"><b> Loja Virtual</b></h1>
		<li><a href="">Categorias</a></li>
		<li><a href="">Produtos</a></li>
		<li><a href="{{route('pedidoloja')}}">Pedidos</a></li>
		<li><a href="">Configuração</a></li>
		<li><a href="">Contatos</a></li>
		<li><a href="">Clientes</a></li>
		<li><a href="">Ver Site</a></li>
	</ul>
</nav>

<!-- MENU PRODUÇÃO -->
<nav class="menuprincipal" id="menu_delivery">
	<ul class="menu-lista">
		<li class="icones voltar"><a href="" title="Recolher menu"><i class="fas fa-shipping-fast ativo"></i><i class="fas fa-fw fa-arrow-left "></i></a></li>
		<h1 class="tt px-2"><b> Delivery</b></h1>
		
		<li><a href="{{route('deliveryconfig.index')}}">Configuração</a></li>
		<li><a href="{{route('deliverycategoria.index')}}">Categoria</a></li>
		<li><a href="{{route('deliveryproduto.index')}}">Produto</a></li>
		<li><a href="{{route('deliverypedido.index')}}">Pedidos de Delivery</a></li>
		<li><a href="{{route('frentedelivery.index')}}">Frente Delivery</a></li>
		<li><a href="{{route('categoriaadicional.index')}}">Categoria de Adicional</a></li>
		<li><a href="{{route('deliverycomplemento.index')}}">Complementos Adicionais</a></li>
		<li><a href="{{route('funcionamentodelivery.index')}}">Funcionamento</a></li>
		<li><a href="{{route('deliverybairro.index')}}">Bairros</a></li>
		<li><a href="{{route('deliverytamanhopizza.index')}}">Tamanhos de Pizza</a></li>
		<li><a href="{{route('deliverymotoboy.index')}}">Motoboys</a></li>	
		
	</ul>
</nav>

<!-- MENU FANACEIRO CONTABIL -->
<nav class="menuprincipal" id="menu_financeiro">
	<ul class="menu-lista">
		<li class="icones voltar"><a href="" title="Recolher menu"><i class="fas fa-hand-holding-usd ativo"></i><i class="fas fa-arrow-left fa-fw"></i></a></li>
		<h1 class="tt px-2"><b> Financeiro</b></h1>
		
		<small><b>Financeiro</b></small>
		<li><a href="{{route('financeiro.lista_aprovar_ordem_compra')}}" class="nav-link text-light">Aprovar Ordem de compra</a></li>
		<li><a href="{{route('financeiro.lista_faturar_ordem_compra')}}" class="nav-link text-light"> Faturar Ordem de Compra</a></li>
		<li><a href="{{route('financeiro.lista_faturar_pedido')}}" class="nav-link text-light"> Faturar Pedido</a></li>
	
			
		<small><b>Contábil</b></small>
		<li><a href="{{ route('lancamentopagar.index') }}" class="nav-link text-light"> Contas a Pagar</a>	</li>
		<li><a href="{{ route('lancamentoreceber.index') }}" class="nav-link text-light"> Contas a Receber</a></li>
		<li><a href="{{ route('lancamentodespesa.index') }}" class="nav-link text-light"> Lançar Despesas</a></li>
		
		
		<small><b>Controle de Acesso</b></small>
		<li><a href="{{ route('permissao.index') }}" class="nav-link text-light"> Permissões</a>	</li>
		<li><a href="{{ route('perfil.index') }}" class="nav-link text-light"> Perfil</a></li>
		<li><a href="{{ route('usuario.index') }}" class="nav-link text-light"> Usuários</a></li>
	</ul>
</nav>

<!--
<div class=" d-none">
	
	
	<h1 class="tt"><b><i class="fas fa-cubes"></i> Estoque</b></h1>
	<ul class="alt">
		<small><b>Entradas</b></small>
		
		
	</ul>
	
	<h1 class="tt"><b><i class="fas fa-hand-holding-usd"></i>  FINANCEIRO/CONTÁBIL</b></h1>
	<ul class="alt">					
		
								
	</ul>
	</div>-->
</div>