<script type="text/javascript">
function mdlvari(msta, mclo, vari){
        $('#variante_tratamiento').val(vari);
        var span = document.getElementById(mclo);
        msta.style.display = "block";
        span.onclick = function() {
        msta.style.display = "none";
    }   
}

function mdledit(msta, mclo, idt, rid){
        var span = document.getElementById(mclo);
        msta.style.display = "block";
        span.onclick = function() {
        msta.style.display = "none";
    }   
    ld_edtrata(idt, rid);
}

function mdlmodif(msta, mclo, idt, rid){
        var span = document.getElementById(mclo);
        msta.style.display = "block";
        span.onclick = function() {
        msta.style.display = "none";
    }   
    ld_modiftrata(idt, rid);
}

function ld_edtrata(idt, rid){
   $.ajax({
      type: "POST",
      url: "./ajax/load_tratedit.php",
      data: {idt:idt, rid:rid},
      beforeSend: function(objeto){
         $('#tratedit').html(loadershowmini);
        },
      success: function(data2){   
        $('#tratedit').html(data2);  
        }
  })  
   event.preventDefault();
}

function ld_modiftrata(idt, rid){
   $.ajax({
      type: "POST",
      url: "./ajax/load_tratmodif.php",
      data: {idt:idt, rid:rid},
      beforeSend: function(objeto){
         $('#tratmodif').html(loadershowmini);
        },
      success: function(data2){   
        $('#tratmodif').html(data2);  
        }
  })  
   event.preventDefault();
}
</script>