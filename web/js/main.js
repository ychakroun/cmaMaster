window.onload = function(){
	btnCo();
	btnInsc();
	btnLog();
	register();
	popupclass();
	if(typeof initTags == 'function'){
		initTags();
	}
	if(typeof initProfileImage == 'function'){
		initProfileImage();
	}
}