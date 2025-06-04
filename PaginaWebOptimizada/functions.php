<?php require_once('cn/connect2.php'); ?>
<script type="text/javascript">
  {  var loadershow = '<img src="./img/vinasloader.svg" width="30%" style="margin: 0 auto;display: flex;">';   }

function toggle(opt, id) {
  var x = document.getElementById(opt);
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }

}

	function show(place, uid, perid){
      var uid= uid;
      var perid= perid;
		$.ajax({
      type: "POST",
		url: './pages/'+place+'.php',
      data: {uid:uid, perid:perid},
      async: true, 
			beforeSend: function(objeto){
				$('#main').html(loadershow);
			},
				success: function(datos){
				$("#main").html(datos).delay(4000).fadeIn();
			}
		});
	}

     async function showresi(uid){
      $.ajax({
      type: "POST",
         url: './ajax/buscar_residentes.php',
      data: {uid:uid},
         async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershow);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
         }
      });
   }

   async function showpros(uid){
      $.ajax({
      type: "POST",
         url: './ajax/buscar_prospectos.php',
      data: {uid:uid},
         async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershow);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
         }
      });
   }

       async function showbajas(uid){
      $.ajax({
      type: "POST",
         url: './ajax/buscar_bajas.php',
      data: {uid:uid},
         async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershow);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
         }
      });
   }

          async function showperbajas(uid){
      $.ajax({
      type: "POST",
      url: './ajax/buscar_perbajas.php',
      data: {uid:uid},
         async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershow);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
         }
      });
   }

    async function showenseres(uid){
      $.ajax({
      type: "POST",
         url: './ajax/buscar_enseres.php',
      data: {uid:uid},
         async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershow);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
         }
      });
   }

   async function shownext(uid, perid){
      $.ajax({
      type: "POST",
      url: './pages/infogral.php',
      data: {uid:uid, perid:perid},
      async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershow);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
         }
      });
   }

   async function shownextpros(uid, perid){
      $.ajax({
      type: "POST",
      url: './pages/infogralpros.php',
      data: {uid:uid, perid:perid},
      async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershow);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
         }
      });
   }


function mdlhelp(msta, mclo, tgt){
      var span = document.getElementById(mclo);
         msta.style.display = "block";
         span.onclick = function() {
         msta.style.display = "none";
}
$.ajax({
      type: "POST",
      url: './pages/info_'+tgt+'.php',
      async: true, 
         beforeSend: function(objeto){
            $('#hlpcont').html(loadershow);
         },
            success: function(datos){
            $("#hlpcont").html(datos);
         }
      });

}

function subload(tgt){
$.ajax({
      type: "POST",
      url: './pages/'+tgt+'.php',
      async: true, 
         beforeSend: function(objeto){
            $('#content').html(loadershow);
         },
            success: function(datos){
            $("#content").html(datos);
         }
      });

}
  
</script>
<?php
function check_fpagos(){ 
   global $db2;
   $cate = $db2->prepare("SELECT * FROM fpagos ORDER BY nombre_fpago ASC");
   $cate->execute();
   return($cate->fetchAll()); }
?>