var baseUrl = "http://10.15.216.153/central/";

$(function() {
      $( "#categoria_pai" ).autocomplete({
      source: "categoria/categorias_complete"
    });

       $( "#categoria_filha" ).autocomplete({
      source: "categoria/categorias_complete"
    });
  });


$("#busca").keypress(function(e){
	if(e.which == 13){
		 	window.location.href = baseUrl+"categoria/listar/" + $("#busca").val();		
	}	
});

$(".lista").click(function(){
	$(".lista").removeClass('active');
	$(this).addClass('active');
});

function ver_detalhe(id){
	$("#tbl").html("<img src='"+baseUrl+"resources/img/loading_3.gif' />");

	
	$.ajax({
		url: baseUrl+"basedeconhecimento/detalhe/"+id,
		success: function(data){
			$("#tbl").html(data);
		}
	});

	
}

function aguarde(){
	$("#tbl").html("<img src='"+baseUrl+"resources/img/loading_3.gif' />");
}

$(document).ready(function(){
	get_todo();
	get_doing();
	get_done();
	get_avisos();

	setInterval(get_avisos, 1000);
	setInterval(get_todo, 1000);
	setInterval(get_doing, 1000);
	setInterval(get_done, 1000);

	$("#txt_aviso").keypress(function(e){
		if(e.which == 13){
			e.preventDefault();
			if($("#txt_aviso").val() != "")
			 	registra_aviso();
		}	
	});

	$("#btn-aviso").click(function(){
		if($("#txt_aviso").val() != ""){
			registra_aviso();
		}
	});

	function registra_aviso(){
		$.ajax({
			url: "painel/add_aviso",
			data: { aviso : $("#txt_aviso").val() },
			method: "POST",
			success: function(data){
				$("#txt_aviso").val("");
				$("#avisos_chat").html(data);
			}
		});
	}

	function get_avisos(){
		$.ajax({
			url: "painel/get_avisos",
			success: function(data){
				console.log(data);
				$("#avisos_chat").html(data);
			}
		});
	}

	function get_todo(){
		$.ajax({
			url: "painel/get_todo",
			success: function(data){
				$("#chamados-todo").html(data);
			}
		});
	}

	function get_doing(){
		$.ajax({
			url: "painel/get_doing",
			success: function(data){
				$("#chamados-doing").html(data);
			}
		});
	}

	function get_done(){
		$.ajax({
			url: "painel/get_done",
			success: function(data){
				$("#chamados-done").html(data);
			}
		});
	}
});




   
   
