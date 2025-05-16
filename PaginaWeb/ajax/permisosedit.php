<div class="permisosper" id="permisosper">
  <div class="ribbon">PERMISOS</div>
    <div class="separator"></div>
  <div class="spacer fwei">* Selecciona las casillas a las que <u>NO</u> tendrá acceso el usuario. <button class="nputbtn" onclick="check();">Marcar todo</button></div>
    <div class="miniseparator"></div>
    <div class="module">
      <div class="ribbonsub">RESIDENTES</div>
        <div class="rbmsbsub">
          <table>
            <tr>
              <td><input type="checkbox" value="res_nbtn" <?php if (in_array("res_nbtn", $perms)) echo "checked"; ?> name="permisos_personal[]">Nuevo</td>          
            </tr>
            <tr>
              <td><input type="checkbox" value="res_sbtn" <?php if (in_array("res_sbtn", $perms)) echo "checked"; ?> name="permisos_personal[]">Buscar</td>          
            </tr>
            <tr>
              <td><input type="checkbox" value="res_rbtn" <?php if (in_array("res_rbtn", $perms)) echo "checked"; ?> name="permisos_personal[]">Buscar enseres</td>          
            </tr>
            <tr>
              <td><input type="checkbox" value="res_bajas" <?php if (in_array("res_bajas", $perms)) echo "checked"; ?> name="permisos_personal[]">Bajas</td>          
            </tr>
            <tr>
              <td><input type="checkbox" value="gral2" <?php if (in_array("gral2", $perms)) echo "checked"; ?> name="permisos_personal[]">Contactos</td>
            </tr>
            <tr>
              <td><input type="checkbox" value="gral3" <?php if (in_array("gral3", $perms)) echo "checked"; ?> name="permisos_personal[]">Enseres</td>
            </tr>
            <tr>
              <td><input type="checkbox" value="gral4" <?php if (in_array("gral4", $perms)) echo "checked"; ?> name="permisos_personal[]">Medicamentos</td>
            </tr>
            <tr>
              <td><input type="checkbox" value="gral5" <?php if (in_array("gral5", $perms)) echo "checked"; ?> name="permisos_personal[]">Tratamiento</td>
            </tr>
          </table>
        </div>
    </div>
    <div class="module">
      <div class="ribbonsub">FARMACIA</div>
      <table>
          <tr>
            <td><input type="checkbox" value="mdmedica" <?php if (in_array("mdmedica", $perms)) echo "checked"; ?> name="permisos_personal[]">Nuevo</td>          
          </tr>
          <tr>
            <td><input type="checkbox" value="far_cbtn" <?php if (in_array("far_cbtn", $perms)) echo "checked"; ?> name="permisos_personal[]">Cendix</td>          
          </tr>
          <tr>
            <td><input type="checkbox" value="far_sbtn" <?php if (in_array("far_sbtn", $perms)) echo "checked"; ?> name="permisos_personal[]">Buscar</td>          
          </tr>
      </table>
    </div>
    <div class="module">
      <div class="ribbonsub">PERSONAL</div>
      <table>
          <tr>
            <td><input type="checkbox" value="per_nbtn" <?php if (in_array("per_nbtn", $perms)) echo "checked"; ?> name="permisos_personal[]">Nuevo</td>          
          </tr>
          <tr>
            <td><input type="checkbox" value="per_sbtn" <?php if (in_array("per_sbtn", $perms)) echo "checked"; ?> name="permisos_personal[]">Buscar</td>          
          </tr>
      </table>
    </div>
    <div class="module">
      <div class="ribbonsub">MÉDICO</div>
      <table>
          <tr>
            <td><input type="checkbox" value="medico_sbtn" <?php if (in_array("medico_sbtn", $perms)) echo "checked"; ?> name="permisos_personal[]">Buscar</td>          
          </tr>
      </table>
    </div>
    <div class="module">
      <div class="ribbonsub">ENFERMERÍA</div>
      <table>
          <tr>
            <td><input type="checkbox" value="enfer_sbtn" <?php if (in_array("enfer_sbtn", $perms)) echo "checked"; ?> name="permisos_personal[]">Buscar</td>          
          </tr>
          <tr>
            <td><input type="checkbox" value="export_sbtn" <?php if (in_array("export_sbtn", $perms)) echo "checked"; ?> name="permisos_personal[]">Reporte</td>          
          </tr>
      </table>
    </div>
    <div class="module">
      <div class="ribbonsub">SUPERVISIÓN</div>
      <table>
          <tr>
            <td><input type="checkbox" value="super_sbtn" <?php if (in_array("super_sbtn", $perms)) echo "checked"; ?> name="permisos_personal[]">Buscar</td>          
          </tr>
          <tr>
            <td><input type="checkbox" value="super_hbtn" <?php if (in_array("super_hbtn", $perms)) echo "checked"; ?> name="permisos_personal[]">Historial</td>          
          </tr>
          <tr>
            <td><input type="checkbox" value="super_nbtn" <?php if (in_array("super_nbtn", $perms)) echo "checked"; ?> name="permisos_personal[]">Nota</td>          
          </tr>
      </table>
    </div>
     <div class="module">
      <div class="ribbonsub">INVENTARIO</div>
      <table>
          <tr>
            <td><input type="checkbox" value="inve_sbtn" <?php if (in_array("inve_sbtn", $perms)) echo "checked"; ?> name="permisos_personal[]">Buscar</td>          
          </tr>
      </table>
    </div>
    <div class="module">
      <div class="ribbonsub">ECONÓMICO</div>
      <table>
          <tr>
            <td><input type="checkbox" value="econo_sbtn" <?php if (in_array("econo_sbtn", $perms)) echo "checked"; ?> name="permisos_personal[]">Buscar</td>          
          </tr>
          <tr>
            <td><input type="checkbox" value="sales_vbtn" <?php if (in_array("sales_vbtn", $perms)) echo "checked"; ?> name="permisos_personal[]">Ventas</td>          
          </tr>
          <tr>
            <td><input type="checkbox" value="export_ebtn" <?php if (in_array("export_ebtn", $perms)) echo "checked"; ?> name="permisos_personal[]">Exportar</td>          
          </tr>
      </table>
    </div>
    <div class="module">
      <div class="ribbonsub">UTILERÍAS</div>
      <table>
          <tr>
            <td><input type="checkbox" value="edifsw" <?php if (in_array("edifsw", $perms)) echo "checked"; ?> name="permisos_personal[]">Edificios altas</td>    
          </tr>
          <tr>
            <td><input type="checkbox" value="varssw" <?php if (in_array("varssw", $perms)) echo "checked"; ?> name="permisos_personal[]">Generales</td>          
          </tr>
          <tr>
            <td><input type="checkbox" value="varsmed" <?php if (in_array("varsmed", $perms)) echo "checked"; ?> name="permisos_personal[]">Medicamentos</td>          
          </tr>
          <tr>
            <td><input type="checkbox" value="varspers" <?php if (in_array("varspers", $perms)) echo "checked"; ?> name="permisos_personal[]">Personal</td>          
          </tr>
          <tr>
            <td><input type="checkbox" value="varsens" <?php if (in_array("varsens", $perms)) echo "checked"; ?> name="permisos_personal[]">Enseres</td>          
          </tr>
          <tr>
            <td><input type="checkbox" value="varresi" <?php if (in_array("varresi", $perms)) echo "checked"; ?> name="permisos_personal[]">Residentes</td>          
          </tr>
          <tr>
            <td><input type="checkbox" value="varecon" <?php if (in_array("varecon", $perms)) echo "checked"; ?> name="permisos_personal[]">Economico</td>          
          </tr>
          <tr>
            <td><input type="checkbox" value="varmedics" <?php if (in_array("varmedics", $perms)) echo "checked"; ?> name="permisos_personal[]">Medico</td>          
          </tr>
          <tr>
            <td><input type="checkbox" value="varbeds" <?php if (in_array("varbeds", $perms)) echo "checked"; ?> name="permisos_personal[]">Camas</td>          
          </tr>
      </table>
    </div>    
</div>