$(function () {
	$('.mobmenu').click (function(){
	$('.menu-lateral').slideToggle();
	$(this).toggleClass('active');
		return false;
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
	
	//SliderShow
	(function(){
		var curr = 0;
		$("#jsNav .trigger").each(function(i){
			$(this).click(function(){
				curr = i;
				$("#js img").eq(i).fadeIn("slow").siblings("img").hide();
				$(this).siblings(".trigger").removeClass("imgSelected").end().addClass("imgSelected");
				return false;
			});
		});
		
		var pg = function(flag){
			if (flag) {
				if (curr == 0) {
					todo = 4;
				} else {
					todo = (curr - 1) % 5;
				}
			} else {
				todo = (curr + 1) % 5;
			}
			$("#jsNav .trigger").eq(todo).click();
		};
		
		//ǰ
		$("#prev").click(function(){
			pg(true);
			return false;
		});
		
		//
		$("#next").click(function(){
			pg(false);
			return false;
		});
		
		//Զ
		var timer = setInterval(function(){
			todo = (curr + 1) % 5;
			$("#jsNav .trigger").eq(todo).click();
		},5000);
		
		$("#js,#prev,#next").hover(function(){
				clearInterval(timer);
			},
			function(){
				timer = setInterval(function(){
					todo = (curr + 1) % 5;
					$("#jsNav .trigger").eq(todo).click();
				},5000);			
			}
		);
	})();
	
	$( function() {
		$( "#tabs" ).tabs();
	  } );

});	

function converteMoedaFloat(valor){    
	 
      if(valor === ""){
         valor =  0;
      }else{
         valor = valor.replace(".","");
         valor = valor.replace(",",".");
		//if (valor.length > 6) valor = valor.replace(".", "");
         valor = parseFloat(valor);
      }
      return valor;

}

function formatarFloat(v) {
	return v.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}

function converteFloatMoeda(valor){
      var inteiro = null, decimal = null, c = null, j = null;
      var aux = new Array();
      valor = ""+valor;
      c = valor.indexOf(".",0);
      //encontrou o ponto na string
      if(c > 0){
         //separa as partes em inteiro e decimal
         inteiro = valor.substring(0,c);
         decimal = valor.substring(c+1,valor.length);
      }else{
         inteiro = valor;
      }
      
      //pega a parte inteiro de 3 em 3 partes
      for (j = inteiro.length, c = 0; j > 0; j-=3, c++){
         aux[c]=inteiro.substring(j-3,j);
      }
      
      //percorre a string acrescentando os pontos
      inteiro = "";
      for(c = aux.length-1; c >= 0; c--){
         inteiro += aux[c]+'.';
      }
      //retirando o ultimo ponto e finalizando a parte inteiro
      
      inteiro = inteiro.substring(0,inteiro.length-1);
      
      decimal = parseInt(decimal);
      if(isNaN(decimal)){
         decimal = "00";
      }else{
         decimal = ""+decimal;
         if(decimal.length === 1){
            decimal = decimal+"0";
         }
      }
      
      
      valor = inteiro+","+decimal;
      
      
      return valor;

   }
function formatReal(v) {
	return v.toLocaleString('pt-br', { style: 'currency', currency: 'BRL' });;
}

function moedaEn(v) {
	return v.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}

function moedaBr(v) {
	var valor = v.toLocaleString('pt-br', { style: 'currency', currency: 'BRL' });
	let cifrao = valor.substring(0, 2);
	if (cifrao == 'R$') 
		valor = valor.substring(3, valor.length)
	return valor;
}

function dataEn(data){
	let temp = data.split('/')
	
	return temp[2] + '-' + temp[1] + '-' + temp[0]
}
function dataBr(data){
	let temp = data.split('-')
	
	return temp[2] + '/' + temp[1] + '/' + temp[2]
}
function adicionaZero(numero){
    if (numero <= 9) 
        return "0" + numero;
    else
        return numero; 
}

function mascaraCpfCnpj(id, tipo){
	var campo = "#"+id;
    try {
    	$(campo).unmask();
    } catch (e) {}
    
    //var tamanho = $(campo).val().length;
	
    if(tipo=="F"){
        $(campo).mask("999.999.999-99");
    } else if(tipo=="J"){
        $(campo).mask("99.999.999/9999-99");
    }
    
/*    // ajustando foco
    var elem = this;
    setTimeout(function(){
    	// mudo a posição do seletor
    	elem.selectionStart = elem.selectionEnd = 10000;
    }, 0);
    // reaplico o valor para mudar o foco
    var currentValue = $(this).val();
    $(this).val('');
    $(this).val(currentValue);*/

}

function tira_mascara(valor){
	return valor.replace(/[^\d]+/g,"");
}
function formatarData(dat){
		var data = new Date(dat);
        var dia  = (data.getDate()+1).toString();
        var diaF = (dia.length == 1) ? '0' + dia : dia;

        var mes  = (data.getMonth()+1).toString(); //+1 pois no getMonth() Janeiro começa com zero.
        var mesF = (mes.length == 1) ? '0' + mes : mes;
        var anoF = data.getFullYear();
	return diaF + "/" + mesF + "/" + anoF ;

}	
function fecharMsg(){
	//inicio();	
	$("#fundo_preto").hide();
    $(".msg").hide();
}

function giraGira(){
	abrirModal('#giragira')
}

function MostrarMsgErros(data){
	html='<span class="msg msg-vermelho position-fixed right top"><i class="fas fa-bug"></i> <b>Ops!</b> Erros Encontrados<ul>';
	   for(var i in data){
			html +='<li>'+data[i]+'</li>'
		}
	html +='</ul><a href="javascript:;" onclick="fecharMsg()" class="sair">x</a></span>';
	return html;
}

function MostrarUmaMsgErro(msg){	
	html='<span class="msg msg-vermelho position-fixed right top">';
	html +='<i class="fas fa-bug"></i> <b>Ops!</b> '+ msg + ' <a href="javascript:;" onclick="fecharMsg()" class="sair">x</a></span>';		
	return html;
}

function MostrarUmaMsgSucesso(msg){
	html='<span class="msg msg-verde position-fixed right top">';
	html +='<i class="fas fa-bug"></i> <b>Sucesso!</b> '+ msg + ' <a href="javascript:;" onclick="fecharMsg()" class="sair">x</a></span>';		
	return html;
}