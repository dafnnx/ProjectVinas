/*save*/
function save_pay_cons(rid){
$.ajax({
      type: "POST",
      url: "./saves/check_adeudo.php",
      data: {rid:rid},
         success:function(data){  
       proced(rid, data);
          }
   })
}

function proced(rid, deb){
if (deb=="0") {
    $('#concept_pay').val("");
 addebt(rid);
} 
else{ 
 addpaycons(rid);
}   }

function addpaycons(rid){
var concept = $('#concept_pay').val();
var invconcept = $('#invconcept_pay').val();
var fecha = $('#fecha_pay').val();
var qty = $('#cantidad_pay').val();
if (concept && fecha && qty || invconcept && fecha && qty) {
  $('#saveecon').attr("disabled", true);  
 var parametros = $('#paycon').find('select, input').serialize();
    $.ajax({
         type: "POST",
         url: "./saves/save_econo.php",
         data: parametros,
         beforeSend: function(objeto){
             $('#resiecon').html(loadershowmini);
           },
            success:function(){        
               Swal.fire({
               icon: 'success',
               title: 'Correcto!!',
               showConfirmButton: false,
               timer: 2500
               })
               $('#saveecon').attr("disabled", false);
            loadecono(rid);
            }
   })  
    event.preventDefault();
} else {
    Swal.fire({
                    icon: 'error',
                    title: 'Campos obligatorios: Fecha, Concepto, Cantidad.',
                    showConfirmButton: false,
                    timer: 2500
                    })
} }


function addebt(rid){
Swal.fire({
  title: 'Por favor indica el ultimo adeudo del residente. ( 0 "cero" si no hay adeudo )',
  input: 'number',
  inputAttributes: {
   min: 0,
   autocapitalize: 'off'
  },
  showCancelButton: true,
  confirmButtonText: 'Guardar',
  allowOutsideClick: () => !Swal.isLoading()
}).then((result) => {
  if (result.isConfirmed) {
   var deb= `${result.value}`;

    $.ajax({
         type: "POST",
         url: "./saves/save_adeudo.php",
         data: {rid:rid, deb:deb},
            success:function(){    
            loadecono(rid);  
            }
   })

  }
})
}
/*save*/
  /*show*/
function showhide2(){
   var x = document.getElementById("concept_pay");
   var y = document.getElementById("invconcept_pay");
  if (x.style.display === "none") {
    $('#concept_pay').val("");
    $('#invconcept_pay').val("");
    $('#precio_pay').val("");
    $('#debe_pay').val("");
    $('#cantidad_pay').val("");
    $('#aporta_pay').val("");
    x.style.display = "flex";
    y.style.display = "none";
  } else {
    $('#concept_pay').val("");
    $('#invconcept_pay').val("");
    $('#precio_pay').val("");
    $('#debe_pay').val("");
    $('#cantidad_pay').val("");
    $('#aporta_pay').val("");
    x.style.display = "none";
    y.style.display = "flex";
  }
}
/*show*/

/*calculo*/
function multi(){
var price = $('#precio_pay').val();
if (price) {
    var total = 1;
    var change= false; //
    $(".aaa").each(function(){
        if (!isNaN(parseFloat($(this).val()))) {
            change= true;
            total *= parseFloat($(this).val());
        }
    });
    total = (change)? total:0;
    document.getElementById('debe_pay').value = total;
} else {};
} 

function set_price(descs){
    var parts= descs.split(',');
    var price=parts[1];
    $('#precio_pay').val(parseFloat(price));
    $('#debe_pay').val(parseFloat(price));
}
/*precio*/
/*load*/
function loadecono(rid){
    $.ajax({
         type: "POST",
         url: "./ajax/load_economico.php",
         data: {rid:rid},
         beforeSend: function(objeto){
             $('#resiecon').html(loadershowmini);
           },
            success:function(data){    
            $('#resiecon').html(data);   
            }
   })  
    event.preventDefault();
}
/*load*/

/*load*/
function loadejers(rid){
    $.ajax({
         type: "POST",
         url: "./ajax/load_ejercicios.php",
         data: {rid:rid},
         beforeSend: function(objeto){
             $('#resiejers').html(loadershowmini);
           },
            success:function(data){    
            $('#resiejers').html(data);   
            }
   })  
    event.preventDefault();
}
/*load*/


function eliminar(id, table, wich, rid){
$.ajax({
         type: "POST",
         url: "./ajax/check_pool.php",
         data: {id:id},
            success:function(data){   
           if (data==0) { 

   swal.fire({
   icon: 'warning',
   title: 'Estas seguro de eliminar el registro?',
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   confirmButtonText: 'Eliminar',
   showLoaderOnConfirm: true,
   preConfirm: function() {
      return new Promise(function(resolve) {
  $.ajax({
             async: true,
            type: "POST",
            url:'./saves/delete.php',
            data: {id_id:id, table:table, wich:wich},
  })
  .done(function(response){
     swal.fire('Eliminado!', response.message, response.status);
     loadecono(rid);
         })
  .fail(function(){
     swal.fire('Oops...', 'ha ocurrido un error');
  });
      });
   },
   allowOutsideClick: false     
   }); 

}
else{
            Swal.fire({
                icon: 'error',
                title: 'El concepto forma parte de una venta, no puede ser eliminado',
                showConfirmButton: false,
                timer: 2500
                    })
    } 
}
});
}