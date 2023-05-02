<!DOCTYPE html>
<html>
<head>
	<title>AJAX CRUD APPLICATION</title>
	<style type="text/css">
		fieldset{
			width: 50%;
			padding: 10px;
		}
		body{
			padding-top: 50px;
			background-color: SandyBrown;
		}
	</style>
	<script type="text/javascript">
		setInterval(
			function ()
			{ 
			  document.getElementById("message").innerHTML = "";
			  show_posts();
			},
			5000
			);

		addForm();
		searchAll();
		show_posts();

		//add form
		function addForm(){
			var obj;
			if (window.XMLHttpRequest) {
				obj = new XMLHttpRequest();
			}else{
				obj = new ActiveXObject("Microsoft.XMLHTTP");
			}

			obj.onreadystatechange = function(){

				if (obj.status == 200 && obj.statusText == "OK" && obj.readyState == 4) {
					document.getElementById('show_form').innerHTML = obj.responseText;
				}
			}
			obj.open("GET",'process.php?action=show_posts');
			obj.send();

		}
		// add posts
		function addPost(){
			var title = document.getElementById('title').value;
			var summary = document.getElementById('summary').value;
			var description = document.getElementById('description').value;
			var obj;
			if (window.XMLHttpRequest) {
				obj = new XMLHttpRequest();
			}else{
				obj = new ActiveXObject("Microsoft.XMLHTTP");
			}

			obj.onreadystatechange = function(){

				if (obj.status == 200 && obj.statusText == "OK" && obj.readyState == 4) {
					  document.getElementById('message').innerHTML = obj.responseText;
				}
			}
			obj.open("POST",'process.php');
			obj.setRequestHeader("content-type",'application/x-www-form-urlencoded');
			obj.send("action=add_posts&title="+title+"&summary="+summary+"&description="+description);
		}

		//show posts
		function show_posts(){
			var obj;
			if (window.XMLHttpRequest) {
				obj = new XMLHttpRequest();
			}else{
				obj = new ActiveXObject("Microsoft.XMLHTTP");
			}

			obj.onreadystatechange = function(){

				if (obj.status == 200 && obj.statusText == "OK" && obj.readyState == 4) {
					document.getElementById('show_posts').innerHTML = obj.responseText;
				}
			}
			obj.open("GET",'process.php?action=show_all_posts');
			obj.send();
		}


		//delete posts
		function deletePost(post_id){
			flag = confirm("Are your sure you want to delete record?");
			if(!flag)
			{
				return 1

			}
			var obj;
			if (window.XMLHttpRequest) {
				obj = new XMLHttpRequest();
			}else{
				obj = new ActiveXObject("Microsoft.XMLHTTP");
			}

			obj.onreadystatechange = function(){

				if (obj.status == 200 && obj.statusText == "OK" && obj.readyState == 4) {
					document.getElementById('message').innerHTML = obj.responseText;
					show_posts();
				}
			}
			obj.open("GET",'process.php?action=delete_post&post_id='+post_id);
			obj.send();
		}

		//edit posts
		function editPost(post_id){
			var title = document.getElementById('title').value;
			var summary = document.getElementById('summary').value;
			var description = document.getElementById('description').value;
			var obj;
			if (window.XMLHttpRequest) {
				obj = new XMLHttpRequest();
			}else{
				obj = new ActiveXObject("Microsoft.XMLHTTP");
			}

			obj.onreadystatechange = function(){

				if (obj.status == 200 && obj.statusText == "OK" && obj.readyState == 4) {
					   document.getElementById('show_form').innerHTML = obj.responseText;
				}
			}
			obj.open("GET",'process.php?action=edit_posts&post_id='+post_id);
			obj.send();
		}

		function updatePost(post_id){
			var title = document.getElementById('title').value;
			var summary = document.getElementById('summary').value;
			var description = document.getElementById('description').value;
			var obj;
			if (window.XMLHttpRequest) {
				obj = new XMLHttpRequest();
			}else{
				obj = new ActiveXObject("Microsoft.XMLHTTP");
			}

			obj.onreadystatechange = function(){

				if (obj.status == 200 && obj.statusText == "OK" && obj.readyState == 4) {
					document.getElementById('message').innerHTML = obj.responseText;
					show_posts();
				}
			}
			obj.open("POST",'process.php');
			obj.setRequestHeader("content-type",'application/x-www-form-urlencoded');
			obj.send('action=update_post&post_id='+post_id +"&title="+title+"&summary="+summary+"&description="+description);

		}
		function clearAll(){
			document.getElementById('title').value = "";
			document.getElementById('summary').value = "";
			document.getElementById('description').value = "";
		}
		// function searchAll(){
		// 	var search_by_title = document.getElementById('title').value ;
			
		// 	var obj;
		// 	if (window.XMLHttpRequest) {
		// 		obj = new XMLHttpRequest();
		// 	}else{
		// 		obj = new ActiveXObject("Microsoft.XMLHTTP");
		// 	}

		// 	obj.onreadystatechange = function(){

		// 		if (obj.status == 200 && obj.statusText == "OK" && obj.readyState == 4) {
		// 			   document.getElementById('search').innerHTML = obj.responseText;
					   
		// 		}
		// 	}
		// 	obj.open("GET",'process.php?action=search_posts');
		// 	obj.send();

		// }
		
	</script>
</head>
<body>
	<center>
		<h2 style="background-color: sienna; width: 50%; height: 50%;">CRUD APPLICATION</h2>
	
<div id="message"></div>
<div id="show_form"></div>
<div id="show_posts"></div>
</center>

</body>
</html>