var secs = 30;
document.agree.agreeb.disabled=true;
for(var i=1;i<=secs;i++) {
	window.setTimeout("update(" + i + ")", i * 1000);
}
function update(num) {
	if(num == secs) {
		window.location.href = "#" ;
		document.agree.agreeb.disabled=false;
	}
	else {
		var printnr = secs-num;
		document.agree.agreeb.value = "本题剩余作答时间 (" + printnr +"s)";
	}
}

function showtime(t){
	document.myform.phone.disabled=true;
	for(i=1;i<=t;i++) {
		window.setTimeout("update_p(" + i + ","+t+")", i * 1000);
	}

}