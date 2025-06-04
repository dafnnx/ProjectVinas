<?php
require_once ("cn/connect2.php");
    $count_query= $db2->prepare("SELECT permisos_personal AS ppersonal FROM personal WHERE id_personal=:id");
    $count_query->bindParam(':id', $perid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){     $ppersonal = $row['ppersonal']; } ?>
<input type="hidden" id="var0" value="<?php echo $ppersonal; ?>">
<script type="text/javascript">
var var0= $('#var0').val();
$(document).ready(function() {

if (var0.includes("per_nbtn")) {
    $("#per_nbtn").addClass("disable-div");
}
else if (!var0.includes("per_nbtn")) {
    $("#per_nbtn").removeClass("disable-div");
};

if (var0.includes("per_sbtn")) {
    $("#per_sbtn").addClass("disable-div");
}
else if (!var0.includes("per_sbtn")) {
    $("#per_sbtn").removeClass("disable-div");
};

});
</script>