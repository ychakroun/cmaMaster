function register () {
	if(document.getElementById('divselect')!=null){
		var choices = document.getElementsByClassName('choices');
		var form = document.getElementById('fos_user_registration_form_group');
		for (var i = 0; i < choices.length; i++) {
			choices[i].onclick = function(e){
				form.value = e.target.id;
				console.log(form.value);
				for (var y = 0; y < choices.length; y++) {
					choices[y].removeAttribute("data");
				}
				e.target.setAttribute("data", "selected");
			}
		}
	}
}