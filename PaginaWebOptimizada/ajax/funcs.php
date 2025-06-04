<script type="text/javascript">

  /* first */ 
    $(document).ready(function(){
   $("#fmedica").select2({
        ajax: {
        url: "./ajax/fmedica.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {            
           return {
              searchTerm: params.term // search term
           };
           
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});


$(document).ready(function(){
   $("#rmvia").select2({
      ajax: {
        url: "./ajax/viaxmed.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});

$(document).ready(function(){
   $("#rmunidad").select2({
      ajax: {
        url: "./ajax/unidadxmed.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});


/*
$(document).ready(function(){
   $("#rmpatologia").select2({
      ajax: {
        url: "./ajax/patologiaxmed.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});
*/

/* first */


  /* edit */ 
    $(document).ready(function(){
   $("#fmedicaed").select2({
        ajax: {
        url: "./ajax/fmedica.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {            
           return {
              searchTerm: params.term // search term
           };
           
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});


$(document).ready(function(){
   $("#rmviaed").select2({
      ajax: {
        url: "./ajax/viaxmed.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});

$(document).ready(function(){
   $("#rmunidaded").select2({
      ajax: {
        url: "./ajax/unidadxmed.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});


/*
$(document).ready(function(){
   $("#rmpatologia").select2({
      ajax: {
        url: "./ajax/patologiaxmed.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        cache: true
      }
   });
});
*/

/* edit */


</script>