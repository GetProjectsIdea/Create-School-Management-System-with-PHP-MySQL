<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php
include_once('../controller/config.php');
if(isset($_GET["friend_type"])&&($_GET["friend_type"]=="Student")){
	$my_index=$_GET["my_index"];
	$my_type=$_GET["my_type"];
	$current_year=date('Y');
		
	$sql="select student.index_number as std_index,student.i_name as std_name,student.image_name as std_image,grade.name as g_name
	      from student
	      inner join student_grade
	      on student.index_number=student_grade.index_number
	      inner join grade
	      on student_grade.grade_id=grade.id
	      where student.index_number!='$my_index' and student_grade.year='$current_year'";
	
	$result=mysqli_query($conn,$sql);
	$count = 0;
	if(mysqli_num_rows($result) > 0){
		while($row=mysqli_fetch_assoc($result)){
			
			$name=$row['std_name'];
			$image=$row['std_image'];
			$grade=$row['g_name'];
			$friend_index=$row['std_index'];
			
			$sql1="SELECT * FROM my_friends WHERE my_index='$my_index' and friend_index='$friend_index'";
			$result1=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_assoc($result1);
			$status=$row1['_status'];
			
?>   
			<tr>
				<td><img src="../<?php echo $image; ?>" class="friend-image"></td>
				<td>
					<a href="#"onClick="friendProfile('Student','<?php echo $friend_index; ?>')"><?php echo $name; ?> </a><br>
					<small>Student - <?php echo $grade; ?></small>
                </td>
				<td>
	 				
                    <?php 
					
						if($status == "Pending"){
							echo '<a href="#" onClick="confirmFriend1(this)" data-id="'.$my_type.','.$my_index.',Student,'.$friend_index.'" class="btn btn-xs bg-green-active">'.'<i class="fa fa-user-plus" aria-hidden="true">'. ' Confirm Friend Request'.'</i>'.'</a>'; 
						}
						if($status == "Friend_Request_Sent"){
							echo '<span class="label label-info label-lg">' .'Friend Request Sent'.'</span>'; 
						}
						
						if($status == "Friend"){
							echo '<span class="label label-lg bg-maroon">' .'Friend'.'</span>';  
						}
						
						if($status == ""){
							 
							echo '<a href="#" onClick="addFriends(this)" data-id="'.$my_type.','.$my_index.',Student,'.$friend_index.'" class="btn btn-xs bg-blue">'.'<i class="fa fa-user-plus" aria-hidden="true">'. ' Add Friend'.'</i>'.'</a>';
						}
									
					?>
	
	
				</td>
		   </tr>
<?php } } }?>

<?php
include_once('../controller/config.php');
if(isset($_GET["friend_type"])&&($_GET["friend_type"]=="Teacher")){
	$my_index=$_GET["my_index"];
	$my_type=$_GET["my_type"];
	
	$sql="SELECT * FROM teacher WHERE index_number!='$my_index'";
	$result=mysqli_query($conn,$sql);

	if(mysqli_num_rows($result) > 0){
		while($row=mysqli_fetch_assoc($result)){
			
			$name=$row['i_name'];
			$image=$row['image_name'];
			$friend_index=$row['index_number'];
			
			$sql1="SELECT * FROM my_friends WHERE my_index='$my_index' and friend_index='$friend_index'";
			$result1=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_assoc($result1);
			$status=$row1['_status'];
?>   
			<tr>
				<td><img src="../<?php echo $image; ?>" class="friend-image"></td>
				<td>
					<a href="#"onClick="friendProfile('Teacher','<?php echo $friend_index; ?>')"><?php echo $name; ?> </a><br>
					<small>Teacher</small>
                </td>
				<td>
	 
					<?php 
					
						if($status == "Pending"){
							echo '<a href="#" onClick="confirmFriend1(this)" data-id="'.$my_type.','.$my_index.',Teacher,'.$friend_index.'" class="btn btn-xs bg-green-active">'.'<i class="fa fa-user-plus" aria-hidden="true">'. ' Confirm Friend Request'.'</i>'.'</a>'; 
						}
					
						if($status == "Friend_Request_Sent"){
							echo '<span class="label label-info label-lg">' .'Friend Request Sent'.'</span>'; 
						}
											
						if($status == ""){
							echo '<a href="#" onClick="addFriends(this)" data-id="'.$my_type.','.$my_index.',Teacher,'.$friend_index.'" class="btn btn-xs bg-blue">'.'<i class="fa fa-user-plus" aria-hidden="true">'. ' Add Friend'.'</i>'.'</a>';
						}
											
						if($status == "Friend"){
							echo '<span class="label label-lg bg-maroon">' .'Friend'.'</span>'; 
						}
									
					
					?>
	
				</td>
		   </tr>
<?php } } }?>

<?php
include_once('../controller/config.php');
if(isset($_GET["friend_type"])&&($_GET["friend_type"]=="Admin")){
	$my_index=$_GET["my_index"];
	$my_type=$_GET["my_type"];
	
	$sql="SELECT * FROM admin WHERE index_number!='$my_index'";
	
	$result=mysqli_query($conn,$sql);
	$count = 0;
	if(mysqli_num_rows($result) > 0){
		while($row=mysqli_fetch_assoc($result)){
			
			$name=$row['i_name'];
			$image=$row['image_name'];
			$friend_index=$row['index_number'];
			
			$sql1="SELECT * FROM my_friends WHERE my_index='$my_index' and friend_index='$friend_index'";
			$result1=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_assoc($result1);
			$status=$row1['_status'];
?>   
			<tr>
				<td><img src="../<?php echo $image; ?>" class="friend-image"></td>
				<td>
					<a href="#"onClick="friendProfile('Admin','<?php echo $friend_index; ?>')"><?php echo $name; ?> </a><br>
                	<small>Admin</small>
                </td>
				<td>
	
					<?php 
					
					if($status == "Pending"){
						echo '<a href="#" onClick="confirmFriend1(this)" data-id="'.$my_type.','.$my_index.',Admin,'.$friend_index.'" class="btn btn-xs bg-green-active">'.'<i class="fa fa-user-plus" aria-hidden="true">'. ' Confirm Friend Request'.'</i>'.'</a>'; 
					}
					
					if($status == "Friend_Request_Sent"){
						echo '<span class="label label-info label-lg">' .'Friend Request Sent'.'</span>'; 
					}
										
					if($status == ""){
						echo '<a href="#" onClick="addFriends(this)" data-id="'.$my_type.','.$my_index.',Admin,'.$friend_index.'" class="btn btn-xs bg-blue">'.'<i class="fa fa-user-plus" aria-hidden="true">'. ' Add Friend'.'</i>'.'</a>';
					}
										
					if($status == "Friend"){
						echo '<span class="label label-lg bg-maroon">' .'Friend'.'</span>'; 
					}
									
					?>
				</td>
		   </tr>
           
<?php } } }?>