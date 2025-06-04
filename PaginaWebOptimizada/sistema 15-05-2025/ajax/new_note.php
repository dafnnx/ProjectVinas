<script type="text/javascript" src="js/supervision.js"></script>
	<div class="info gral">
		<div class="gralmain">	
	<div class="supnote">		
  <div class="miniseparator"></div>
<div id="selnotasuper">
<div class="miniseparator"></div>
<input type="hidden" id="uid_note" name="uid_note" value="<?php echo $_POST['uid']; ?>">
<input type="datetime-local" class="nputs" name="fec_notasuper">
<select class="nputs" name="turno_notasuper">
  <option selected disabled>Turno</option>
  <option value="Matutino">Matutino</option>
  <option value="Vespertino">Vespertino</option>
  <option value="Nocturno">Nocturno</option>
</select>
<div class="miniseparator"></div>
<textarea class="tarea95new" rows="4" placeholder="Observaciones" name="evens_turno_notasuper"> </textarea>
</div>
<button type="submit" class="nputsave" id="savenotasuper" onclick="save_notasuper();" >Guardar</button>      
<div class="miniseparator"></div>
	</div>
<div id="subseanew_nota"></div>
		</div>
	</div>