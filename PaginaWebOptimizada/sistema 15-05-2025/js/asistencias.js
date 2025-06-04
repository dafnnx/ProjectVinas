var loadershowmini = '<img src="./img/vinasloader.svg" width="10%" style="margin: 0 auto;display: flex;">';

      function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function () {
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;
        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                checkqr(`${decodedText}`);
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 200 });
        html5QrcodeScanner.render(onScanSuccess);
    });


function checkqr(theres){
     $.ajax({
            type: "POST",
            url: "./saves/check_qr.php",
            data: {theres:theres},
            beforeSend: function(){
                 $('#qr-reader-results').html(loadershowmini);
              },
            success:function(dat){  
if (dat>0) {
  var pid = document.getElementById('pid').value;
$.ajax({
            type: "POST",
            url: "./saves/save_asistencia.php",
            data: {pid:pid, theres:theres},
                success:function(){          
                    Swal.fire({
                    icon: 'success',
                    title: 'Correcto!!',
                    showConfirmButton: false,
                    timer: 2500
                    })
                }
    })
  load_asistencias(pid);
} else {
    Swal.fire({
                    icon: 'error',
                    title: 'Residente no encontrado',
                    showConfirmButton: false,
                    timer: 3000
                    })   
  load_asistencias(pid);         
    }
                }
    })  
     event.preventDefault();
};



function load_asistencias(pid){
         $.ajax({
            async: true,
            type: "POST",
            url:'./ajax/buscar_asistencias.php',
            data: {pid:pid},
            success:function(data2){
               $("#qr-reader-results").html(data2).fadeIn('slow');   
            }
         })
      }  