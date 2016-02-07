function slowopa (e,e1,e2,timing) {
	var ts = timing/100+'s';
	e2.style = "transition:all "+ts+" ease-in-out;"; 
	e.style = "display:none;transition:all "+ts+" ease-in-out;opacity:0;";
	e1.style = "display:block;transition:all "+ts+" ease-in-out;opacity:0;";
	var h = e1.offsetHeight+document.getElementById("headerSection").offsetHeight+30;
	setTimeout(function(){
		e1.style = "display:block;transition:all "+ts+" ease-in-out; opacity:1;";
		ts = timing/200+'s';
		e2.style = "transition:all "+ts+" ease-in-out;height:"+h+"px;"; 
	}, timing);
}
function popupclass(){
	var popup = document.getElementsByClassName('pop');
	if(popup!=null){
		for (var i = 0; i < popup.length; i++) {
			popup[i].onclick = function  (event) {
				if(event.target.style.display == "block"){
					event.target.style.display = "none";
				}
			}
		}
	}
}
function btnCo(){
	if(document.getElementById('btnCo')!=null){
		document.getElementById('btnCo').onclick = function() {
			if(document.getElementById('popupco').style.display == 'none'){
				document.getElementById('popupco').style.display = 'block'; 
			}
		}
	}
}
function btnInsc(){
	if(document.getElementById('btnInsc')!=null){
		document.getElementById('btnInsc').onclick = function() {
			var login = document.getElementById('conex');
			var registration =document.getElementById('rgstr');
			var poprdr = document.getElementById('poprdr');
			if(login.style.display == 'block'|| login.style.display == '' && registration != null){
				slowopa(login,registration,poprdr,50); 
			}
		}
	}
}
function btnLog(){
	if(document.getElementById('btnLog')!=null){
		document.getElementById('btnLog').onclick = function() {
			var login = document.getElementById('conex');
			var registration =document.getElementById('rgstr');
			var poprdr = document.getElementById('poprdr');
			if(registration.style.display == 'block'|| registration.style.display == '' && login != null){
				slowopa(registration,login,poprdr,50); 
			}
		}
	}
}
