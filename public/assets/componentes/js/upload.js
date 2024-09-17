$.ajaxSetup({
	headers:{
		'X-CSRF-TOKEN': _token
	}
});
$(document).ready(function(){   
	
});
function pegaArquivo(file){
	const fileReader = new FileReader();
	fileReader.onloadend = function(){
		$("#imgUp").attr("src", fileReader.result);
	}
	fileReader.readAsDataURL(file);
	
}

function valida_imagem (nome){	
	var elemento 	= $("#"+nome);
	var allowedTypes= ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
	var file 		= elemento[0].files[0];
	var fileType 	= file.type;
	if(!allowedTypes.includes(fileType)){
	    alert('Por favor selecione um arquivo (JPEG/JPG/PNG/GIF).');
	    $("#fileInput").val('');
	    return false;
	}else{
		pegaArquivo(file);
	}
	  
}

function valida_arquivo (nome){	
	var elemento 	= $("#"+nome);
	var allowedTypes= ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
	var file 		= elemento[0].files[0];
	var fileType 	= file.type;
	
	
	if(!allowedTypes.includes(fileType)){
	    alert('Por favor selecione um arquivo (PDF/DOC/DOCX/JPEG/JPG/PNG/GIF).');
	    $("#fileInput").val('');
	    return false;
	}else{
		$(".bt_foto").hide();
		$("#bt_" +nome).show();
	}   
}

function upload_qualquer(nome_id,nome, id, tabela, caminho){
	var data = new FormData();	
	var arquivos = $('#'+nome)[0].files;
	
	if(arquivos.length > 0) {
		
		data.append('imagem', arquivos[0]);
		data.append('campo', nome);
		data.append('tabela', tabela);
		data.append('nome_id', nome_id);
		data.append('valor_id', id);
		data.append('caminho', caminho);
		
		$.ajax({
			type:'POST',
			url:base_url + 'upload/subir',
			data:data,
			contentType:false,
			processData:false,
			dataType: "json",
			beforeSend: function(){
				$('#uploadStatus').html('<img src=' + base_url + '"assets/img/loading.gif"/>');
			},
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">Falha no arquivo, tente novamente.</p>');
            },
			success:function(data){	
				$("#img_"+nome).attr("src", base_img + caminho + '/' + data.msg);
			}
		});
	}
}

