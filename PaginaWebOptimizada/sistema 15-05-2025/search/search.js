var loadershowmini = '<img src="./img/vinasloader.svg" width="10%" style="margin: 0 auto;display: flex;">';

	function seacli(){
		var ncliente= document.getElementById("ncliente").value;
		$.ajax({
			async: true,
			type: "POST",
			url:'./search/search_clientes.php',
			data: {ncliente:ncliente},
			beforeSend: function(objeto){
				 $('#loader').html(loadershowmini);
			  },
			  success:function(data2){
					$('#loader').html(data2).fadeIn('slow');
				}
				});
	}


	function slectcliente(idc, nomc){
		document.getElementById("cliente").value= nomc;
		document.getElementById("idcliente").value= idc;
		document.getElementById("clientcredit").style.visibility = "visible";
	}