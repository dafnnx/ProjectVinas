  $(document).ready(function() {
    $("#upimg").on('click', function() {
        var pro_id = $("#resic_id").val();
if (pro_id>0) {
		var formData = new FormData();
        var files = $('#image')[0].files[0];
        var files2 = $("#image").val().replace(/.*(\/|\\)/, '');
        formData.append('file',files);
        $.ajax({
            url: './saves/upload.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {            
    if (response != 0) {
              $.ajax({
              async: true,
              type: "POST",
              url:'./saves/upload2.php',
              data: {pro_id:pro_id, files2:files2},
              })
                    $(".card-img-top").attr("src", response);
    } else {          
      Swal.fire({
            icon: 'warning',
            title: 'Formato de imagen incorrecto!',
            showConfirmButton: true,
          })     } }
        });
    return false;
}
else {
	Swal.fire({
  	icon: 'error',
  	title: '¡No hay residente seleccionado!',
  	showConfirmButton: false,
  	timer: 1500
	})

}        
    });
});