<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Document</title>
 	<style type="text/css">
 	
 		.inputfile{
 			display: none;
 		}
		.label{
			display: flex;
		    height: 30px;
		    width: 200px;
		    background-color: red;
		    cursor: pointer;
		    align-items: center;
		    justify-content: center;
		}
		#img-container img{
			width: 200px;
			height: 200px;
		}
		#img-container{
			cursor: pointer;
		}
 	</style>
 </head>
 <body>
 	
	<div class="avatar-wrap">
	 	<div id="img-container">
	 		<img class="img"src="img/leo.jpg">
	 	</div>
	 	<input type="file" name="file" id="file" class="inputfile"  onchange="handleFiles(this.files)"/>
		<label class="label" for="file">Choose a file</label>
 	</div>
 </body>

 <script type="text/javascript">

document.querySelector('#img-container').addEventListener('click',function(){document.querySelector('.label').click()});


 function handleFiles(files) {
	if (typeof(FileReader) != undefined){
		var imgContainer = document.querySelector('#img-container');
		var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp|.ico)$/;
		var width = 200;
		var height = 200;
    	var file = files[0];
    	if (file){
	    	if (regex.test(file.name.toLowerCase())){
				var reader = new FileReader();
				reader.readAsDataURL(file);
				reader.onload = function(e){
					while (imgContainer.firstChild){
				    imgContainer.removeChild(imgContainer.firstChild);
					}
					var img = document.createElement('img');
					img.src = e.target.result;
					img.onload = function (){
						if (this.width<=width && this.height<=height){
							imgContainer.appendChild(img);
						}
						else{
							this.width = 200;
							this.height = 200;
							imgContainer.appendChild(img);
						}	
					}
				}
	    	}
	    	else{
	    		alert('Это не картинка');
				return;
	    	}
	}
	else{
		return;
	}
}

	else{
		alert('FileReader does not support');
		return;
	}
}

 	
 </script>
 </html>