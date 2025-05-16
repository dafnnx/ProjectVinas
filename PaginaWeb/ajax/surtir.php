      <div class="capcont mleft">
        <div class="capup">
          <div class="mleftmini">
<span class="input-number-decrement" onclick="tawayb('<?php echo $idres; ?>-v', '<?php echo $today; ?>')">–</span>  
<span class="input-number-increment" onclick="plusb('<?php echo $idres; ?>-v', '<?php echo $today; ?>')">+</span>
          </div>
          <div class="mleft">
<span class="input-number-decrement" onclick="tawayb('<?php echo $idres; ?>-w', '<?php echo $today; ?>')">–</span>  
<span class="input-number-increment" onclick="plusb('<?php echo $idres; ?>-w', '<?php echo $today; ?>')">+</span>
          </div>
          <div class="mleft">
<span class="input-number-decrement" onclick="tawayb('<?php echo $idres; ?>-x', '<?php echo $today; ?>')">–</span>  
<span class="input-number-increment" onclick="plusb('<?php echo $idres; ?>-x', '<?php echo $today; ?>')">+</span>
          </div>
          <div class="mleft">
<span class="input-number-decrement" onclick="tawayb('<?php echo $idres; ?>-y', '<?php echo $today; ?>')">–</span>  
<span class="input-number-increment" onclick="plusb('<?php echo $idres; ?>-y', '<?php echo $today; ?>')">+</span>
          </div>
          <div class="mleft">
<span class="input-number-decrement" onclick="tawayb('<?php echo $idres; ?>-z', '<?php echo $today; ?>')">–</span>  
<span class="input-number-increment" onclick="plusb('<?php echo $idres; ?>-z', '<?php echo $today; ?>')">+</span>
          </div>
        </div>
        <div class="capup">
          <div class="mleftmini">
           <input class="dwn" id="<?php echo $idres; ?>-v" value="0" type="text" readonly>
          </div>
          <div class="mleft">
           <input class="dwn" id="<?php echo $idres; ?>-w" value="0" type="text" readonly>
          </div>
          <div class="mleft">
           <input class="dwn" id="<?php echo $idres; ?>-x" value="0" type="text" readonly>
          </div>
          <div class="mleft">
           <input class="dwn" id="<?php echo $idres; ?>-y" value="0" type="text" readonly>
          </div>
          <div class="mleft">
           <input class="dwn" id="<?php echo $idres; ?>-z" value="0" type="text" readonly>
          </div>
        </div>
        <div class="capup">
          <div class="mleftmini">
           <input class="dwnlarge" type="text" autocomplete="off" placeholder="Observaciones.." id="<?php echo $idres; ?>obs" onblur="s_obs('<?php echo $idres; ?>', this.value, this.id);">
          </div>
        </div>
      </div>