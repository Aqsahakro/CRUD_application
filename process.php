
<?php
	require_once("connection.php");
	if (isset($_GET['action']) && $_GET['action'] == 'show_posts') {
		?>
	<body>
	<center>
	<fieldset>
		<legend>Add New Post</legend>
		<table>
			<tr>
				<td>Title:</td>
				<td><input type="text" name="title" id="title" 
					placeholder="Enter your post title"></td>
			</tr>
			<tr>
				<td>Summary:</td>
				<td><textarea name="summary" id="summary" rows="4" cols="50"></textarea></td>
			</tr>
			<tr>
				<td>Description:</td>
				<td><textarea name="description" id="description" rows="4" cols="50"></textarea></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><button onclick="addPost()" style="background-color: sienna; padding: 5px;">Add Post</button>
					<button onclick="clearAll()" style="background-color: sienna; padding: 5px;">Cancel</button>
				</td>
			</tr>
		</table>
	</fieldset>
</center>

</body>
</html>

<?php
	}

    elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add_posts') {
		
		 $insert_query = "INSERT INTO posts(post_title, post_summary,post_description) 
	    	VALUES('".$_REQUEST['title']."','".$_REQUEST['summary']."','".$_REQUEST['description']."')";

			 $result = mysqli_query($connection,$insert_query);
			 if($result)
				{
						echo "<h2 style= 'color:green'>Data Inserted Successfully</h2>";
						echo "<br />";

				}
				else
				{
					echo "<h2 style= 'color:red'>Data Not Inset Due to some reason</h2>";
				}
				

				}
	elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'show_all_posts') {

		$show_query = "SELECT * FROM posts";

		$result = mysqli_query($connection,$show_query);

     	if ($result->num_rows>0) { ?>
     			<center>
				<h2>ALL POSTS</h2>
				<table border="2px">
		       	<tr>
		       		<th>ID</th>
		       		<th>TITLE</th>
		       		<th>SUMMARY</th>
		       		<th>DESCRIPTION</th>
		       		<th>ACTIONS</th>
		       	</tr>
		       	<?php
		    while($row = mysqli_fetch_assoc($result)){
					?>
			<tr>
       		<td><?php echo $row['post_id'];?></td>
       		<td><?php echo $row['post_title'];?></td>
       		<td><?php echo $row['post_summary'];?></td>
       		<td style="width: 50%"><?php echo $row['post_description'];?></td>
       		<td align="center"><button onclick="editPost(<?php echo $row['post_id']; ?>)" style="background-color: sienna; padding: 5px;">Edit</button>
       			<button onclick="deletePost(<?php echo $row['post_id']; ?>)" style="background-color: sienna; padding: 5px;">Delete</button>
       		</td>
       		</tr>
       		<?php
				} ?>
				</table>
   			</center>
   			<?php

			}
		}

		 elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete_post') {



		 	 $delete_query = "DELETE FROM posts
		 					 WHERE post_id = '".$_REQUEST['post_id']."'";

		 $result = mysqli_query($connection,$delete_query);
		 	 if($result){
		 		echo "<h2 style= 'color:red'> Record Deleted</h2>";
		 	 	}
		 	 else
		 	 {
		 		echo "<h2 style= 'color:green'>Record Not Deleted</h2>";
		 	 }
		 	 }

   elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit_posts') { 
   		$select_query = "SELECT * FROM posts
   						 WHERE post_id = '".$_REQUEST['post_id']."'";

		$result = mysqli_query($connection,$select_query);

     	if ($result->num_rows>0) {
     		$row = mysqli_fetch_assoc($result)
   		?>

	<body>
	<center>
		<fieldset>
		<legend>Update Post</legend>
		<table>
			<tr>
				<td>Title:</td>
				<td><input type="text" name="title" id="title" value="<?php echo $row['post_title'];?>" 
					placeholder="Enter your post title"></td>
			</tr>
			<tr>
				<td>Summary:</td>
				<td><textarea name="summary" id="summary"  rows="4" cols="50"><?php echo $row['post_summary'];?></textarea></td>
			</tr>
			<tr>
				<td>Description:</td>
				<td><textarea name="description" id="description" rows="4" cols="50"><?php echo $row['post_description'];?></textarea></td>
			</tr>
			<tr>
				<td><button onclick="updatePost(<?php echo $row['post_id']; ?>)" style="background-color: sienna; padding: 5px;">Update Post</button>
					<button onclick="clearAll()" style="background-color: sienna; padding: 5px;">Cancel</button>
				</td>
			</tr>
		</table>
	</fieldset>
</center>

</body>
</html>
		<?php
				}

				}

	elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update_post') {

		$update_query = "UPDATE posts SET post_title = '".$_REQUEST['title']."', post_summary = '".$_REQUEST['summary']."', post_description = '".$_REQUEST['description']."' WHERE post_id = '".$_REQUEST['post_id']."' ";

		$result = mysqli_query($connection,$update_query);

		if($result){
			echo "<h2 style= 'color:green'>Record Updated</h2>";
		 	 	}
		 	 else
		 	 {
		 		echo "<h2 style= 'color:red'>Record Not Updated</h2>";
		 	 }

		}

		// elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'search_posts') { 
		// 	<!-- <table align="center" style="width: 50px;">
		// 	<tr style="width: 100%; height: 50%">
		// 			<td>Search by Title:</td>
		// 			<td><input type="text" name="search"></td>
		// 			<td><button style="background-color: sienna; padding: 5px;">Search</button>
		// 		</td>
		// 	</tr> 
		// </table> -->
		
	//}


?>