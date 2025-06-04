<?php  require_once('functions.php');
error_reporting(0); ?>
<div id="contenidocaja" class="staticinfo">        
    <div id="sta" class="sta">
    	<div id="tit" class="tit">PRODUCTOS MAS VENDIDOS</div>
    <div class="conte"> 
          <div class="table-responsive" style="font-size: 10.5px;">
              <table class="table2">
                <tr>
                    <th>Nombre</th>
                    <th>Vendidos</th>
                    <th>Stock</th>            
                </tr>                
                <?php
                $resultas= mas_v();
                 foreach ($resultas as  $resultass): ?> 
                      <tr>    
                        <td><?php echo $resultass['nombre']; ?></td>            
                        <td><?php echo $resultass['totalSold']; ?></td>
                        <td><?php echo $resultass['totalQty']; ?></td>
                        <?php  endforeach;  ?>                     
                    </tr>
              </table>
            </div>
    </div></div>    
    <div id="sta" class="sta"><div id="tit" class="tit">PRODUCTOS RECIENTES</div><div class="conte">
      <div class="table-responsive" style="font-size: 10.5px;">
              <table class="table2">
                  <tr>
                    <th>Nombre</th>
                    <th>Precio</th>            
                  </tr>
                  <?php
                $resultas3= recent_add();
                 foreach ($resultas3 as  $resultass3): ?> 
                      <tr>    
                        <td><?php echo $resultass3['nombre_producto']; ?></td>
                        <td>$ <?php echo $resultass3['venta_producto']; ?></td>
                        <?php  endforeach;  ?>                    
                      </tr>
              </table>
            </div>
    </div></div>
    <div id="sta" class="sta"><div id="tit" class="tit">STOCK BAJO</div><div class="conte">
      <div class="table-responsive" style="font-size: 10.5px;">
              <table class="table2">
                  <tr>
                    <th>Nombre</th>
                    <th>Stock</th>            
                  </tr>
                  <?php
                $resultasx= less_stock();
                 foreach ($resultasx as  $resultasxx): ?> 
                      <tr>    
                        <td><?php echo $resultasxx['nombre_producto']; ?></td>
                        <td><?php echo $resultasxx['qty_producto']; ?></td>
                        <?php  endforeach;  ?>                    
                      </tr>
              </table>
            </div>
    </div></div>
    <div id="sta" class="sta"><div id="tit" class="tit">ULTIMAS VENTAS</div><div class="conte">
      <div class="table-responsive" style="font-size: 10.5px;">
              <table class="table2">
                  <tr>
                    <th>Recibo</th>
                    <th>Fecha</th>
                    <th>Total</th>            
                  </tr>
                  <?php
                $resultas2= last_v();
                 foreach ($resultas2 as  $resultass2): ?> 
                      <tr>    
                       <td><?php echo $resultass2['sale_id']; ?></td>             
                        <td><?php echo $resultass2['fecha']; ?></td> 
                        <td>$ <?php echo number_format($resultass2['amount'], 2); ?></td> 
                        <?php  endforeach;  ?>                   
                    </tr>
              </table>
            </div>
    </div></div>
    <div id="sta" class="sta"><div id="tit" class="tit">ULTIMOS CORTES</div><div class="conte">
      <div class="table-responsive" style="font-size: 10.5px;">
              <table class="table2">
                  <tr>
                    <th>Corte</th>
                    <th>Fecha</th>
                    <th>Monto</th>             
                  </tr>
                  <?php
                $resultas4= last_c();
                 foreach ($resultas4 as  $resultass4): ?> 
                      <tr>
                        <td><?php echo $resultass4['cid_corte']; ?></td>    
                        <td><?php echo $resultass4['fecha_corte']; ?></td>
                        <td>$ <?php echo number_format($resultass4['monto_corte'], 2); ?></td>
                        <?php  endforeach;  ?>                  
                      </tr>
              </table>
            </div>
    </div></div>	
</div>	