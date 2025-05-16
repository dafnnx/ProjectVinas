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

if (var0.includes("gral2")) {
    $("#gral2").addClass("disable-div");
}
else if (!var0.includes("gral2")) {
    $("#gral2").removeClass("disable-div");
};

if (var0.includes("gral3")) {
    $("#gral3").addClass("disable-div");
}
else if (!var0.includes("gral3")) {
    $("#gral3").removeClass("disable-div");
};

if (var0.includes("gral4")) {
    $("#gral4").addClass("disable-div");
}
else if (!var0.includes("gral4")) {
    $("#gral4").removeClass("disable-div");
};

if (var0.includes("gral5")) {
    $("#gral5").addClass("disable-div");
}
else if (!var0.includes("gral5")) {
    $("#gral5").removeClass("disable-div");
};


});
</script>