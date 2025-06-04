var loadershowmini = '<img src="./img/vinasloader.svg" width="10%" style="margin: 0 auto;display: flex;">';
/*closet*/
function plus(targ) {
  var base= document.getElementById(targ).value ;
  if (base=="") {    base="0";  } else {    base=base;  }
if (targ) {
   var result=parseFloat(base)+parseFloat(1);
document.getElementById(targ).value=result;
  saav(targ, result);
}
 };

 function taway(targ) {
  var base= document.getElementById(targ).value ;
  if (base=="") {    base="0";  } else {    base=base;  }
  if (targ) {
   var result=parseFloat(base)-parseFloat(1);
document.getElementById(targ).value=result;
  saav(targ, result);
}
 };

 function saav(targ, result){
   $.ajax({
      type: "POST",
      url: "./saves/save_plus.php",
      data: {targ:targ, result:result},
      beforeSend: function(){
        },
        success:function(){     
          document.getElementById(targ+"show").value=result;
        }
  }) 
   event.preventDefault();
 }
 /*closet*/

 /*surtir*/
 function plusb(targ, today) {
$.ajax({
      type: "POST",
      url: "./ajax/check_days.php",
      data: {targ:targ, today:today},
        success:function(multi){     
         ntxpb(targ, today, multi);
        }
  })
};

function ntxpb(targ, today, multi){
if (!multi){  
Swal.fire({
            icon: 'error',
            title: '¡Indica los días!',
            showConfirmButton: false,
            timer: 1500
          })
} else{
  var base=document.getElementById(targ).value;
  var possi = targ.split("-", 2);
  var pivot=possi[1];
  var rid=possi[0];
switch(pivot) {  case "v":    var subpivot="a";    break;
                 case "w":    var subpivot="b";    break;
                 case "x":    var subpivot="c";    break;
                 case "y":    var subpivot="d";    break;
                 case "z":    var subpivot="e";    break;
}
var numera= rid+"-"+subpivot+"show";
var subnumera=document.getElementById(numera).value ;
  if (base=="") {    base="0";  } else {    base=base;  }
if (targ) {
   var result=parseFloat(base)+parseFloat(1);
   var opera=result*multi;
   var operafin=opera-subnumera;
  document.getElementById(targ).value=result;
  document.getElementById(targ+"res").value=operafin;
  saavb(targ, result, opera);
  save_dresult(targ, result, operafin, opera);
    }    }    }   


 function tawayb(targ, today) {
$.ajax({
      type: "POST",
      url: "./ajax/check_days.php",
      data: {targ:targ, today:today},
        success:function(multi){     
         ntypb(targ, today, multi);
        }
  })
};

function ntypb(targ, today, multi){
if (!multi){
Swal.fire({
            icon: 'error',
            title: '¡Indica los días!',
            showConfirmButton: false,
            timer: 1500
          })
} else{
  var base=document.getElementById(targ).value;
  var possi = targ.split("-", 2);
  var pivot=possi[1];
  var rid=possi[0];
switch(pivot) {  case "v":    var subpivot="a";    break;
                 case "w":    var subpivot="b";    break;
                 case "x":    var subpivot="c";    break;
                 case "y":    var subpivot="d";    break;
                 case "z":    var subpivot="e";    break;
}
var numera= rid+"-"+subpivot+"show";
var subnumera=document.getElementById(numera).value ;
  if (base=="") {    base="0";  } else {    base=base;  }
if (targ) {
   var result=parseFloat(base)-parseFloat(1);
   var opera=result*multi;
   var operafin=opera-subnumera;
  document.getElementById(targ).value=result;
  document.getElementById(targ+"res").value=operafin;
  saavb(targ, result, opera);
  save_dresult(targ, result, operafin, opera);
    }    }    } 


 function saavb(targ, result, opera){
   $.ajax({
      type: "POST",
      url: "./saves/save_plusb.php",
      data: {targ:targ, result:result, opera:opera},
        success:function(){     
          document.getElementById(targ+"show").value=result;
        }
  }) 
   event.preventDefault();
 }

  function save_dresult(targ, result, operafin, opera){
   $.ajax({
      type: "POST",
      url: "./saves/save_dayresult.php",
      data: {targ:targ, result:result, operafin:operafin, opera:opera},
      beforeSend: function(){
        },
        success:function(){     
          document.getElementById(targ+"show").value=opera;
        }
  }) 
   event.preventDefault();
 }
 /*surtir*/


 function s_obs(idres, obs, idobs){
    $.ajax({
      type: "POST",
      url: "./saves/save_sobs.php",
      data: {idres:idres, obs:obs},
      beforeSend: function(){
        $('#'+idobs).val("Guardando");
        },
      success:function(){  
        $('#'+idobs).val(obs);   
        }
  }) 
   event.preventDefault();
       
      }


 function s_adds(idres){
    $.ajax({
      type: "POST",
      url: "./saves/save_sobs.php",
      data: {idres:idres, obs:obs},
      beforeSend: function(){
        $('#'+idobs).val("Guardando");
        },
      success:function(){  
        $('#'+idobs).val('Ok');   
        }
  }) 
   event.preventDefault();
       
      }

function mdlhisto(msta, mclo, idres){
var span = document.getElementById(mclo);
msta.style.display = "block";
span.onclick = function() {
  msta.style.display = "none";
}
load_histo(idres);
}


function load_histo(idres){
  $.ajax({
         type: "POST",
         url: './ajax/load_historial.php',
         data: {idres:idres},
         async: true, 
         beforeSend: function(objeto){
            $('#histmargin').html(loadershow);
         },
            success: function(datos){
            $("#histmargin").html(datos).delay(4000).fadeIn();
         }
      });
}


function set_days(days){
 $.ajax({
         type: "POST",
         url: './saves/save_daysno.php',
         data: {days:days},
         async: true, 
            success: function(datos){
         }
      });
};



function add_live_up(tbl, cant, edif, vari){
if (!cant) {  }
else  { 
$.ajax({
      type: "POST",
      url: "./saves/save_add.php",
      data: {tbl:tbl, cant:cant, edif:edif, vari:vari},
      async: true,
        success:function(data){        }
         });
      }
}