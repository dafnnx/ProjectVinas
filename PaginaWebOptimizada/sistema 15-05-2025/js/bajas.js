   var loadershowmini = '<img src="./img/vinasloader.svg" width="10%" style="margin: 0 auto;display: flex;">';
  var loadershow = '<img src="./img/vinasloader.svg" width="50%" style="margin: 0 auto;display: flex;">';
  $(document).ready(function(){
         loadbajas(1);
      });

      function loadbajas(){
         var action="ajax";
         var q= $("#q").val();
         $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/buscar_bajs.php',
            data: {action:action, q:q},
             beforeSend: function(objeto){
             $('#subsea_res').html(loadershow);
           },
            success:function(data2){
               $("#subsea_res").html(data2).fadeIn('slow');   
            }
         })
      } 


      async function detalles(id, uid){
      $.ajax({
      type: "POST",
      url: './ajax/detalles_residente.php',
      data: {id:id, uid:uid},
         async: true, 
         beforeSend: function(objeto){
            $('#contmargin').html(loadershow);
         },
            success: function(datos){
            $("#contmargin").html(datos).delay(4000).fadeIn();
         }
      });
   }

/*status residente */

function save_sta(){
   var s_status = $('#ssta').val(); 
   var f_status = $('#fecha_status').val();
   var m_status = $('#motivo_status').val();
   var x_status = $('#situa_status').val();
if (m_status == "" || m_status == null || f_status == "" || f_status == null || s_status=="N/A" || x_status == "" || x_status == null) {
   Swal.fire({
               icon: 'error',
               title: 'Todos los campos son requeridos',
               showConfirmButton: false,
               timer: 1500
               })
}
else {
 var parametros = $('#save_stat').find('select, input').serialize();

    $.ajax({
         type: "POST",
         url: "./saves/save_status.php",
         data: parametros,
         beforeSend: function(objeto){
             $('#resitrtable').html(loadershowmini);
           },
            success:function(data){  
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 1500
               })
               console.log(data);
            loadstat(data);
            }
   })  
    event.preventDefault();
} 
   }


   function loadstat(id){
      $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/status_chk.php',
            data: {id:id},
             beforeSend: function(objeto){
             $('#stasta').html(loadershowmini);
           },
            success:function(data2){
               $("#stasta").html(data2).fadeIn('slow');   
            }
         })
   }

   /*status residente */