function testqr(idresi) {
	var qrcode = document.getElementById("qrcode"+idresi);
	var qr = new QRCode(qrcode, {width:200, height:200, correctLevel : QRCode.CorrectLevel.H});
	qr.makeCode(idresi);
}

function qrdown(idresi) {
var link = document.getElementById("download"+idresi);
    var image = document.getElementById("qrcode"+idresi).getElementsByTagName("img");
    var qr = image[0].src;
    link.href = qr;
}