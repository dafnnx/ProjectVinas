/*load*/
function loadecomonth(rid){
    $.ajax({
         type: "POST",
         url: "./ajax/load_ecomonth.php",
         data: {rid:rid},
         beforeSend: function(objeto){
             $('#resiemont').html(loadershowmini);
           },
            success:function(data){    
            $('#resiemont').html(data);   
            }
   })  
    event.preventDefault();
}

function loadyearm(rid, tr){
    $.ajax({
         type: "POST",
         url: "./ajax/load_yearm.php",
         data: {rid:rid},
         beforeSend: function(objeto){
             $('#resiemont').html(loadershowmini);
           },
            success:function(data){    
            $('#resiemont').html(data);   
            }
   })  
    event.preventDefault();
}

/*load*/
/*save*/
function save_pay_months(rid){
  var fin= $('[name="fecha_month"]').val();
  var mes= $('[name="month_month"]').val();
  var abo= $('[name="abono_month"]').val();
  var fpa= $('[name="fpago_month"]').val();
  var fpe= $('[name="persona_month"]').val();
if (fin && mes && abo && fpa) {
  $('#saveecomnt').attr("disabled", true);  
    $.ajax({
         type: "POST",
         url: "./saves/save_tarifa.php",
         data: {rid:rid, fin:fin, mes:mes, abo:abo, fpa:fpa, fpe:fpe},
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
               $('#saveecomnt').attr("disabled", false);
               ld_ecomonc(rid, mes);
            }
   })  
    event.preventDefault();
} else {
    Swal.fire({
                    icon: 'error',
                    title: 'Campos obligatorios: Fecha, Mes, Abono',
                    showConfirmButton: false,
                    timer: 2500
                    })
} }


function addebtm(rid){
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

function load_count(rid, mes){
    clean_count();
 $.ajax({
         type: "POST",
         url: "./ajax/check_tarifa.php",
         data: {rid:rid, mes:mes},
            success:function(tarifa){  
                if (!tarifa) {    
                    addtarifa(rid, mes);
                }
                else {
                    chkabono(rid, mes, tarifa);
                }
                                    }
   })  
}


function clean_count(){
    $('[name="saldo_month"]').val("");
    $('[name="tarifa_month"]').val("");
    $('[name="dife_month"]').val("");
    $('[name="abono_month"]').val("");
}

function addtarifa(rid, mes){
    
     $.ajax({
         type: "POST",
         url: "./ajax/check_hint.php",
         data: {rid:rid, mes:mes},
            success:function(hint){  
              proctarifa(rid, mes, hint)  
                                    }
   }) 

}

function proctarifa(rid, mes, hint){
var rid=rid;
var mes=mes;
var hint=hint;
    Swal.fire({
  title: 'Especfica la tarifa que corresponde al mes',
  input: 'number',
  inputValue : hint,
  inputAttributes: {
   min: 0,   
   autocapitalize: 'off'
  },
  showCancelButton: true,
  confirmButtonText: 'Guardar',
  allowOutsideClick: () => !Swal.isLoading()
}).then((result) => {
  if (result.isConfirmed) {
   var tar= `${result.value}`;
    $.ajax({
         type: "POST",
         url: "./saves/spec_tarifa.php",
         data: {rid:rid, mes:mes, tar:tar},
            success:function(){   
            $('[name="tarifa_month"]').val(tar); 
            }
   })

  }
})
}


function chkabono(rid, mes, tarifa){
 $.ajax({
         type: "POST",
         url: "./ajax/check_saldo.php",
         data: {rid:rid, mes:mes},
            success:function(data){  
                var dif= parseInt(tarifa)-parseInt(data);
                $('[name="saldo_month"]').val(data); 
                $('[name="tarifa_month"]').val(tarifa); 
                $('[name="dife_month"]').val(dif); 
            },
   })  
}



/*load*/

function ld_ecomonc(rid, mes){
$.ajax({
         type: "POST",
         url: "./ajax/load_ecomonth.php",
         data: {rid:rid, mes:mes},
         beforeSend: function(objeto){
             $('#resiemont').html(loadershowmini);
           },
            success:function(data){    
            $('#resiemont').html(data);   
            }
   })  
    event.preventDefault();
}

/*load*/