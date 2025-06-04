var loadershowmini = '<img src="./img/vinasloader.svg" width="10%" style="margin: 0 auto;display: flex;">';
var loadershow = '<img src="./img/vinasloader.svg" width="30%" style="margin: 0 auto;display: flex;">';

$(document).ready(function(){
         load(1);
      });

      function load(){
         var action="ajax";
         var q= $("#q").val();
         $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/buscar_panahist.php',
            data: {action:action, q:q},
             beforeSend: function(objeto){
             $('#subsea_per').html(loadershowmini);
           },
            success:function(data2){
               $("#subsea_per").html(data2).fadeIn('slow');   
            }
         })
      }  


 async function showbuilds(eds, nomed){
      $.ajax({
         type: "POST",
         url: './ajax/buscar_edificios.php',
         data: {eds:eds, nomed:nomed},
         async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershow);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
         }
      });
   }

      function set_edif(ideds, nomedifs, idpis, nompis){
         $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/buscar_posicion.php',
            data: {ideds:ideds, nomedifs:nomedifs, idpis:idpis, nompis:nompis},
             beforeSend: function(objeto){
             $('#mdboard').html(loadershowmini);
           },
            success:function(data2){
               $("#mdboard").html(data2).fadeIn('slow');   
            }
         })
      }  

 async function showpanhist(){
      $.ajax({
         type: "POST",
         url: './ajax/buscar_panhist.php',
         async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershow);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
         }
      });
   }