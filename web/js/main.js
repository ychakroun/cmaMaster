window.onload = function(){
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
	if(document.getElementById('btnCo')!=null){
		document.getElementById('btnCo').onclick = function() {
			if(document.getElementById('popupco').style.display == 'none'){
				document.getElementById('popupco').style.display = 'block'; 
			}
		}
	}
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
	if(document.getElementById('divselect')!=null){
		var choices = document.getElementsByClassName('choices');
		for (var i = 0; i < choices.length; i++) {
			choices[i].onclick = function(event){
				var form = document.getElementById('fos_user_registration_form_group');
				form.value = event.target.id;
				for (var y = 0; y < choices.length; y++) {
					choices[y].removeAttribute("data");
				}
				event.target.setAttribute("data", "selected");
			}
		}
	}
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
