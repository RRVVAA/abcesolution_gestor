$(function (){
	$('#Lista').click (function(){
	$('.listaProdutos').css("display","block");
		$('.listaProdutos li').click (function(){
			$('.listaProdutos').css("display","none");
		});
	});		
	
	$('.filtro').click (function(){
	$('.mostraFiltro').slideToggle();
	$(this).toggleClass('active');
		return false;
	});
	
	
	$('.senha').click (function(){
		$('.esquecisenha').slideToggle();
		$(this).toggleClass('active');
		return false;
	});
	
	$('.mobmenu').click (function(){
		$('.menu-topo-text').slideToggle();
		$(this).toggleClass('active');
		return false;
	});
	
	$('.fa-ellipsis-v').click (function(){
		$('.edicao').slideToggle();
		$(this).toggleClass('active');
		return false;
	});
					
	$( "#accordion" ).accordion({
		collapsible: true,
		autoHeight: false,
		active: false,
		heightStyle: "content" 
    });   
				
	$("#accordion2,.sub").accordion({
		heightStyle: "content",
		collapsible: false,
		active: false
	});   
	
	$( function() {
		$( "#tabs" ).tabs();
	  } );
	  
});
