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

if (var0.includes("edifsw")) {
    $("#edifsw").addClass("disable-div");
}
else if (!var0.includes("edifsw")) {
    $("#edifsw").removeClass("disable-div");
};

if (var0.includes("varssw")) {
    $("#varssw").addClass("disable-div");
}
else if (!var0.includes("varssw")) {
    $("#varssw").removeClass("disable-div");
};

if (var0.includes("varsmed")) {
    $("#varsmed").addClass("disable-div");
}
else if (!var0.includes("varsmed")) {
    $("#varsmed").removeClass("disable-div");
};

if (var0.includes("varspers")) {
    $("#varspers").addClass("disable-div");
}
else if (!var0.includes("varspers")) {
    $("#varspers").removeClass("disable-div");
};

if (var0.includes("varsens")) {
    $("#varsens").addClass("disable-div");
}
else if (!var0.includes("varsens")) {
    $("#varsens").removeClass("disable-div");
};

if (var0.includes("varresi")) {
    $("#varresi").addClass("disable-div");
}
else if (!var0.includes("varresi")) {
    $("#varresi").removeClass("disable-div");
};

if (var0.includes("varecon")) {
    $("#varecon").addClass("disable-div");
}
else if (!var0.includes("varecon")) {
    $("#varecon").removeClass("disable-div");
};

if (var0.includes("varmedics")) {
    $("#varmedics").addClass("disable-div");
}
else if (!var0.includes("varmedics")) {
    $("#varmedics").removeClass("disable-div");
};

if (var0.includes("varbeds")) {
    $("#varbeds").addClass("disable-div");
}
else if (!var0.includes("varbeds")) {
    $("#varbeds").removeClass("disable-div");
};

});
</script>