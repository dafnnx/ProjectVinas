<div class="infosub gral">
<?php
 $rid= $_POST['nrid'];
    require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM inventarios WHERE id_residente=:id");
    $count_query->bindParam(':id', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
    $query=$db2->prepare("SELECT * FROM inventarios WHERE id_residente=:id ORDER BY fecha_inv DESC");
    $query->bindParam(':id', $rid);
    $query->execute(); ?>
    
    <!-- Estilos para las alertas -->
    <style>
    .alert-icon {
        display: inline-block;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: #ff4444;
        color: white;
        text-align: center;
        line-height: 20px;
        font-size: 12px;
        cursor: pointer;
        margin-left: 5px;
        position: relative;
        animation: pulse 2s infinite;
    }
    
    .alert-icon:hover {
        background-color: #cc0000;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    .alert-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
    }
    
    .alert-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 400px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    .alert-close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }
    
    .alert-close:hover {
        color: black;
    }
    
    .alert-icon-large {
        font-size: 48px;
        color: #ff4444;
        margin-bottom: 15px;
    }
    
    .alert-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }
    
    .alert-message {
        font-size: 14px;
        color: #666;
        margin-bottom: 20px;
    }
    
    .alert-button {
        background-color: #ff4444;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }
    
    .alert-button:hover {
        background-color: #cc0000;
    }
    
    .stock-cell, .expiry-cell {
        position: relative;
    }
    </style>
    
    <?php 
    if ($numrows>0){  ?>
      <div class="">
        <table class="table" data-responsive="table" id="resultTable">
          <thead>
        <tr>
          <th class='text-center'>Fecha</th>
          <th class='text-center'>Descripción</th>
          <th class='text-center'>Stock</th>
          <th class='text-center'>Fecha Caducidad</th>
          <th class='text-center'>Modif.</th>
          <th class='text-center'>*</th>
        </tr>
        </thead>
        <?php
        for($i=0; $row = $query->fetch(); $i++){    
          $id_inv= $row['id_inventario'];      
          $medinv= $row['medicamento_inv'];
          $fechainv= $row['fecha_inv'];
          $talla= $row['talla_inv'];
          $unidad= $row['unidad_inv']; 
          $marca= $row['marca_inv']; 
          $cantidad= $row['cantidad_inv'];
          $vencimiento= $row['vencimiento_inv'];
          
          // Verificar si el stock es bajo (menor a 10)
          $stock_bajo = (int)$cantidad < 10;
          
          // Verificar si la fecha de caducidad está próxima (5 días o menos)
          $caducidad_proxima = false;
          $dias_restantes = 0;
          if (!empty($vencimiento)) {
              $fecha_actual = new DateTime();
              $fecha_vencimiento = new DateTime($vencimiento);
              $diferencia = $fecha_actual->diff($fecha_vencimiento);
              $dias_restantes = $diferencia->days;
              
              // Si la fecha ya pasó o faltan 5 días o menos
              if ($fecha_vencimiento < $fecha_actual || $dias_restantes <= 5) {
                  $caducidad_proxima = true;
              }
          }
          ?>
          <tr>
            <td><?php 
              $fecha = new DateTime($fechainv);
              $cadfe = $fecha->format("d-M-Y");
              echo $cadfe;  
            ?></td>
            
            <?php
            $cquery= $db2->prepare("SELECT nombre_medica AS nm FROM medicamentos WHERE id_medica=:id");
            $cquery->bindParam(':id', $medinv);
            $cquery->execute();
            for($j=0; $row2 = $cquery->fetch(); $j++){ $nm = $row2['nm'];  ?>
            <td><?php echo $nm; ?></td> 
            <?php } ?>
            
            <td class="textcenter stock-cell">
                <?php echo $cantidad; ?>
                <?php if ($stock_bajo): ?>
                    <span class="alert-icon" onclick="showStockAlert('<?php echo $nm; ?>', <?php echo $cantidad; ?>)" title="Stock bajo">
                        ⚠
                    </span>
                <?php endif; ?>
            </td>
            
            <td class="textcenter expiry-cell">
                <?php 
                if (!empty($vencimiento)) {
                    $fecha_venc = new DateTime($vencimiento);
                    echo $fecha_venc->format("d-M-Y");
                    
                    if ($caducidad_proxima): ?>
                        <span class="alert-icon" onclick="showExpiryAlert('<?php echo $nm; ?>', '<?php echo $fecha_venc->format("d-M-Y"); ?>', <?php echo $dias_restantes; ?>)" title="Próximo a caducar">
                            ⚠
                        </span>
                    <?php endif;
                } else {
                    echo "Sin fecha";
                }
                ?>
            </td>
            
            <td>
                <div class="invopera">
                  <div class="qty_opera">
                    <input type="number" class="nputsopera ta_opera" placeholder="Cantidad..." id="ta_opera-<?php echo $id_inv; ?>">
                  </div>
                  <div class="sel_opera">
                   <select class="nputs wh100" name="sel-<?php echo $id_inv; ?>" onchange="inve_live_up('inventarios', 'cantidad_inv', this.value, '<?php echo $id_inv; ?>', '<?php echo $rid; ?>');">
                    <option disabled selected>Operación</option>
                    <option value="1">Sumar</option>
                    <option value="2">Restar</option>
                   </select>
                  </div>
                </div>
            </td>   
            <td class="textcenter"><a href="#" class='del' title='Eliminar' onclick="eliminarinv('<?php echo $id_inv; ?>', 'inventarios', 'id_inventario', '<?php echo $rid; ?>')"></a></td>
          </tr>
          <?php } ?>
        </table>
      </div>
      
      <!-- Modal para alertas -->
      <div id="alertModal" class="alert-modal">
          <div class="alert-content">
              <span class="alert-close" onclick="closeAlert()">&times;</span>
              <div class="alert-icon-large">⚠</div>
              <div class="alert-title" id="alertTitle"></div>
              <div class="alert-message" id="alertMessage"></div>
              <button class="alert-button" onclick="closeAlert()">Entendido</button>
          </div>
      </div>
      
      <script>
      function showStockAlert(medicamento, cantidad) {
          document.getElementById('alertTitle').innerHTML = '¡Stock Bajo!';
          document.getElementById('alertMessage').innerHTML = 
              'El medicamento <strong>' + medicamento + '</strong> tiene solo <strong>' + cantidad + '</strong> unidades en stock.<br><br>' +
              'Es necesario que se vuelva a llenar el inventario lo antes posible.';
          document.getElementById('alertModal').style.display = 'block';
      }
      
      function showExpiryAlert(medicamento, fechaCaducidad, diasRestantes) {
          document.getElementById('alertTitle').innerHTML = '¡Medicamento Próximo a Caducar!';
          let mensaje = 'El medicamento <strong>' + medicamento + '</strong> ';
          
          if (diasRestantes <= 0) {
              mensaje += 'ya ha caducado el ' + fechaCaducidad + '.<br><br>';
              mensaje += 'Es necesario retirar este medicamento del inventario inmediatamente.';
          } else {
              mensaje += 'caduca el ' + fechaCaducidad + ' (faltan ' + diasRestantes + ' días).<br><br>';
              mensaje += 'Es necesario utilizar este medicamento pronto o reemplazarlo.';
          }
          
          document.getElementById('alertMessage').innerHTML = mensaje;
          document.getElementById('alertModal').style.display = 'block';
      }
      
      function closeAlert() {
          document.getElementById('alertModal').style.display = 'none';
      }
      
      // Cerrar modal al hacer clic fuera de él
      window.onclick = function(event) {
          var modal = document.getElementById('alertModal');
          if (event.target == modal) {
              modal.style.display = 'none';
          }
      }
      </script>
      
<?php }
else {  echo "Sin captura de inventario";   } ?>
</div>