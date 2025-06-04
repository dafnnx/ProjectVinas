      <div class="gralmid" id="gral6">   
        <div class="cmap">
       <main>
        <div class="textcenter pd15">Carga de archivos</div>

        <div id="dropzone">
            <p>Arrastre los archivos a esta zona <label for="archivos">o haga click aquí</label></p>
            <input type="file" id="archivos" name="archivos" multiple />
        </div>



        <div id="fotos" class="fotos">


        <?php         
        /*
            $contenido = glob( "../saves/$rid/*" );
            foreach($contenido as $imagen){
                echo "<li>nombre: <strong> $imagen </strong></li>";
            }
        */
                   ?>

        </div>



    </main>
        </div>
     </div>

<script type="text/javascript" >
     /*upfiles*/
var rid= $('[name="resic_cont"]').val();
var dropzone = document.getElementById('dropzone');
var archivos = document.getElementById('archivos');
var fotos = document.getElementById('fotos');

dropzone.addEventListener('dragover', e =>{
    e.preventDefault( );
} );
dropzone.addEventListener('drop', uploadArchivos );
archivos.addEventListener('change', uploadArchivos );

function uploadArchivos( e ){
    e.preventDefault( );
    const FD = new FormData( ); 
    const listado_archivos = e.target.id =='archivos' ? 
                                archivos.files : 
                                e.dataTransfer.files;

    for( let file of listado_archivos ){
        FD.append( 'files[]', file);
        FD.append( 'rid', rid);
    }
    fetch( './saves/upload_files.php', { method: 'POST', body: FD } ).
    then( rta => rta.json( ) ). //es lo mismo JSON.parse( variable )
    then( json => {

        thelist(rid);   

    }). 
    catch( e => { console.error( e ); } );

    archivos.value = '';
}

function thelist(rid){

  $.ajax({
      type: "POST",
      url: "./ajax/list_files.php",
      data: {rid:rid},
       beforeSend: function(objeto){
            $('#fotos').html(loadershow);
         },
            success: function(datos){
            $("#fotos").html(datos).delay(4000).fadeIn();
         }
         }) 


/*
    fotos.innerHTML = '';
        for( img of json ){
            fotos.innerHTML += `
                <li>
                nombre: <strong> ${ img } </strong></br>
                </li>
            `;
        }
*/

}
</script>   