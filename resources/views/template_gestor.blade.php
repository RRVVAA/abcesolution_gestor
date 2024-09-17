<!doctype html>
<html language="pt-br">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<head>
		<title>mjailton</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">		
		<link href="{{asset('assets/gestor/img/ico-athenas.svg')}}" type="image/x-icon" rel="icon" />
		<link href="{{asset('assets/gestor/img/ico-athenas.svg')}}" type="image/x-icon" rel="shortcut icon" />
		<link href="{{asset('assets/gestor/img/ico-athenas.svg')}}" rel="apple-touch-icon" />
		
		<link rel="stylesheet" href="{{asset('assets/gestor/css/auxiliar.css')}}">
		<link rel="stylesheet" href="{{asset('assets/gestor/css/grade.css')}}">
		<link rel="stylesheet" href="{{asset('assets/gestor/css/style.css')}}">
		<link rel="stylesheet" href="{{asset('assets/gestor/css/style-m.css')}}">
		
		<!--css-->
		<link rel="stylesheet" href="{{asset('assets/gestor/js/datatables/css/jquery.dataTables.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/gestor/js/datatables/css/responsive.dataTables.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/gestor/js/datatables/css/style_dataTable.css')}}">
		<!--font icones-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
		
		<!--Css Componentes-->
		<link rel="stylesheet" href="{{asset('assets/componentes/css/style_Componente.css')}}">
		<script>
			var base_url = "{{asset('')}}";
			var _token   = "{{csrf_token()}}";			
		</script>
		
		<script src="{{asset('assets/gestor/js/jquery.min.js')}}"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		
	</head>
	<body>
	<div class="site">
		@include("cabecalho")
		@include('inc.erros')
        @include('inc.msg')
        <div id="mostrarErros"></div>
        <div id="mostrarUmErro"></div>
        <div id="mostrarSucesso"></div>	
	<div class="contain">	
		@yield("conteudo")	
		<!--CARREGA O GIRA GIRA-->
        <div class="window load" id="giragira">
        	<span class="text-load">Carregando...</span>
        </div>    
	</div>	
	</div>	
    	<script src="{{asset('assets/gestor/js/datatables/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('assets/gestor/js/datatables/js/dataTables.responsive.min.js')}}"></script>	
    	<script src="{{asset('assets/gestor/js/jquery.mask.js')}}"></script>
	
	
    	@if(isset($gestorJs))
    		<script type="text/javascript" src="{{asset('assets/gestor/js/js_gestor.js')}}"></script>
    	@endif
    	
    	@if(isset($fornecedorJs))
    		<script type="text/javascript" src="{{asset('assets/gestor/js/js_fornecedor.js')}}"></script>
    	@endif
	
		<script src="{{asset('assets/componentes/js/js_data_table.js')}}"></script>
		<script src="{{asset('assets/componentes/js/js_modal.js')}}"></script>
    	<script src="{{asset('assets/componentes/js/js_util.js')}}"></script>
    	<script src="{{asset('assets/componentes/js/js_mascara.js')}}"></script>
    	<script src="{{asset('assets/componentes/js/upload.js')}}"></script> 
    	<script src="{{asset('assets/gestor/js/js.js')}}"></script> 
    	
		@if(isset($graficoJs))		
    		<script src="{{url('assets/gestor/js/chart.js/Chart.min.js')}}"></script>
    		<script src="{{asset('assets/gestor/js/grafico.js')}}"></script>		
		@endif
		
		
	</body>
</html>