function initProfileImage(){
        document.getElementById('imageHeader').onclick = function() {
        document.getElementById('profile_imageHeader_file').click();
        }
        var images =  document.getElementsByClassName('imageProfile');
        for (var i = images.length - 1; i >= 0; i--) {
        	images[i].onclick = function(e){
                id = e.target.id.replace(/[a-zA-Z]/g,'');
        		document.getElementById("profile_image"+id+"_file").click();
        	}
        }
        var inputs =  document.getElementsByTagName('input');
        for (var i = inputs.length - 1; i >= 0; i--) {
        	if(inputs[i].type=="file"){
        		input = inputs[i];
        		inputs[i].onchange = function (e){
        			document.getElementById('imgtmp').setAttribute('name',e.target.name);
        			var files = e.target.files;
        			for (var y = files.length - 1; y >= 0; y--) {
        				if(files[y].type == "image/jpeg" || files[y].type == "image/png"){
        					 var reader = new FileReader();
        					 reader.onload = function( e ) {
        						document.getElementById('imgtmp').innerHTML = e.target.result;
        						setImageTemp();
        					}
        					reader.readAsDataURL(files[y]);
        					
        				}
        			}
        		}
        	}
        }
    }
function initPieceImage(){
        var images =  document.getElementsByClassName('imagePiece');
        for (var i = images.length - 1; i >= 0; i--) {
            images[i].onclick = function(e){
                id = e.target.id.replace(/[a-zA-Z]/g,'');
                document.getElementById("piece_image"+id+"_file").click();
            }
        }
        var inputs =  document.getElementsByTagName('input');
        for (var i = inputs.length - 1; i >= 0; i--) {
            if(inputs[i].type=="file"){
                input = inputs[i];
                input.style.display = "none";
                inputs[i].onchange = function (e){
                    document.getElementById('imgtmp').setAttribute('name',e.target.name);
                    var files = e.target.files;
                    for (var y = files.length - 1; y >= 0; y--) {
                        if(files[y].type == "image/jpeg" || files[y].type == "image/png"){
                             var reader = new FileReader();
                             reader.onload = function( e ) {
                                document.getElementById('imgtmp').innerHTML = e.target.result;
                                setImageTemp();
                            }
                            reader.readAsDataURL(files[y]);
                            
                        }
                    }
                }
            }
        }
    }
function initProposalImage(){
        var images =  document.getElementsByClassName('imagePiece');
        for (var i = images.length - 1; i >= 0; i--) {
            images[i].onclick = function(e){
                id = e.target.id.replace(/[a-zA-Z]/g,'');
                document.getElementById("proposal_piece_image"+id+"_file").click();
            }
        }
        var inputs =  document.getElementsByTagName('input');
        for (var i = inputs.length - 1; i >= 0; i--) {
            if(inputs[i].type=="file"){
                input = inputs[i];
                input.style.display = "none";
                inputs[i].onchange = function (e){
                    document.getElementById('imgtmp').setAttribute('name',e.target.name);
                    var files = e.target.files;
                    for (var y = files.length - 1; y >= 0; y--) {
                        if(files[y].type == "image/jpeg" || files[y].type == "image/png"){
                             var reader = new FileReader();
                             reader.onload = function( e ) {
                                document.getElementById('imgtmp').innerHTML = e.target.result;
                                setImageTemp();
                            }
                            reader.readAsDataURL(files[y]);
                            
                        }
                    }
                }
            }
        }
    }
function initEstimateImage(){
        var images =  document.getElementsByClassName('imageEstimate');
        for (var i = images.length - 1; i >= 0; i--) {
            images[i].onclick = function(e){
                id = e.target.id.replace(/[a-zA-Z]/g,'');
                document.getElementById("estimate_image"+id+"_file").click();
            }
        }
        var inputs =  document.getElementsByTagName('input');
        for (var i = inputs.length - 1; i >= 0; i--) {
            if(inputs[i].type=="file"){
                input = inputs[i];
                input.style.display = "none";
                inputs[i].onchange = function (e){
                    document.getElementById('imgtmp').setAttribute('name',e.target.name);
                    var files = e.target.files;
                    for (var y = files.length - 1; y >= 0; y--) {
                        if(files[y].type == "image/jpeg" || files[y].type == "image/png"){
                             var reader = new FileReader();
                             reader.onload = function( e ) {
                                document.getElementById('imgtmp').innerHTML = e.target.result;
                                setImageTemp();
                            }
                            reader.readAsDataURL(files[y]);
                            
                        }
                    }
                }
            }
        }
    }
function initOpinionImage(){
        var img =  document.getElementById('div');
        img.onclick = function(e){
            document.getElementById("opinion_image_file").click();
        }
        var inputs =  document.getElementsByTagName('input');
        for (var i = inputs.length - 1; i >= 0; i--) {
            if(inputs[i].type=="file"){
                input = inputs[i];
                input.style.display = "none";
                inputs[i].onchange = function (e){
                    document.getElementById('imgtmp').setAttribute('name',e.target.name);
                    var files = e.target.files;
                    for (var y = files.length - 1; y >= 0; y--) {
                        if(files[y].type == "image/jpeg" || files[y].type == "image/png"){
                             var reader = new FileReader();
                             reader.onload = function( e ) {
                                document.getElementById('imgtmp').innerHTML = e.target.result;
                                setImageTemp();
                            }
                            reader.readAsDataURL(files[y]);
                            
                        }else{
                            document.getElementById("opinion_image_file").click();
                        }
                    }
                }
            }
        }
    }
function setImageTemp(){
	var image = document.getElementById('imgtmp').getAttribute('name');
	var data = document.getElementById('imgtmp').innerHTML;
	var id = image.slice(image.indexOf('[')+1,image.indexOf(']'));
    if(id =='piece'){
        var id = image.slice(image.indexOf('[',10)+1,image.indexOf(']',15));
    }
    if(id =='imageHeader'){
        document.getElementById(id).setAttribute('style','background-image: url("'+data+'"); background-size: cover; background-position: center center; background-repeat: no-repeat;)');
        document.getElementById(id).getElementsByTagName('img')[0].src = data;
    }else{
        id = 'div'+id.replace(/[a-zA-Z]/g,'');
        document.getElementById(id).setAttribute('style','background-image: url("'+data+'"); background-size: cover; background-position: center center; background-repeat: no-repeat;)');
        document.getElementById(id).getElementsByTagName('img')[0].style.display = 'none';
        document.getElementById(id).src = data;
    }
}