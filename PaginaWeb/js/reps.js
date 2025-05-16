var loadershowmini = '<img src="./img/vinasloader.svg" width="10%" style="margin: 0 auto;display: flex;">';
        function sventasfecha(idr){
            var q1= $("#q1").val();
            var q2= $("#q2").val();
            $("#resultrep").fadeIn('slow');
            $.ajax({
                async: true,
                type: "POST",
                url:'./ajax/reporte_fecha.php',
                data: {q1:q1, q2:q2, idr:idr},
                 beforeSend: function(objeto){
                 $('#resultrep').html(loadershowmini);
              },
                success:function(data){
                    $('#resultrep').html(data);         
                }
            })
        }   


        function xventasfecha(){
            var q1= $("#q1").val();
            var q2= $("#q2").val();
            $("#xresultrep").fadeIn('slow');
            $.ajax({
                async: true,
                type: "POST",
                url:'./ajax/reporte_xfecha.php',
                data: {q1:q1, q2:q2},
                 beforeSend: function(objeto){
                 $('#xresultrep').html(loadershowmini);
              },
                success:function(data){
                    $('#xresultrep').html(data);         
                }
            })
        }   


         function xenferfecha(){
            var q1= $("#q1").val();
            var q2= $("#q2").val();
            var q3= $("#q3").val();
            var orient= $("#orient").val();
    if (q1 && q2 && q3 && orient) {
        var parametros = $('#repenfer').find('select, input, checkbox').serialize();
            $.ajax({
                async: true,
                type: "POST",
                url:'./ajax/reporte_enferfecha.php',
                data: parametros,
                 beforeSend: function(objeto){
                 $('#xresuenfe').html(loadershowmini);
              },
                success:function(data){
                    $('#xresuenfe').html(data);         
                }
            })
        }
        }   