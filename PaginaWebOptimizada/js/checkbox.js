$("#boxgral").on("click", function() {
  $(".thecheckgralt").prop("checked", this.checked);
  var checkk = $(".thecheckgralt:checked").length;
  $("#checkgral").text("Procesar: "+checkk);
});

$(".thecheckgralt").on("click", function() {
  var checkk = $(".thecheckgralt:checked").length;
  $("#checkgral").text("Procesar: "+checkk);
  if ($(".thecheckgralt").length == checkk) {
    $("#boxgral").prop("checked", true);
  } else {
    $("#boxgral").prop("checked", false);
  }
});


$("#boxgralbajas").on("click", function() {
  $(".thecheckgraltbajas").prop("checked", this.checked);
  var checkk = $(".thecheckgraltbajas:checked").length;
  $("#checkgralbajas").text("Procesar: "+checkk);
});

$(".thecheckgraltbajas").on("click", function() {
  var checkk = $(".thecheckgraltbajas:checked").length;
  $("#checkgralbajas").text("Procesar: "+checkk);
  if ($(".thecheckgraltbajas").length == checkk) {
    $("#boxgralbajas").prop("checked", true);
  } else {
    $("#boxgralbajas").prop("checked", false);
  }
});