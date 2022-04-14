<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<tbody>

<?php
include_once("../controller/config.php");
$my_index=$_GET['my_index'];
$conversation_id=$_GET['conversation_id'];
	
$sql="select * from online_chat where conversation_id='$conversation_id'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
	
	$user_index=$row['user_index'];
	$msg=$row['msg'];
	$user_type=$row['user_type'];
	
	if($user_index==$my_index){
		
		echo '<tr><td style="border:none;"><p class="msg-p1"> '.$msg.' </span></td></tr>';
		
	}else{
		
		if($user_type == "Admin"){
			
			$sql1="select * from admin where index_number='$user_index'";
		
			$result1=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_assoc($result1);
	
			$image=$row1['image_name'];
			
		}
		
		if($user_type == "Teacher"){
			
			$sql1="select * from teacher where index_number='$user_index'";
		
			$result1=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_assoc($result1);
	
			$image=$row1['image_name'];
			
		}
		
		if($user_type == "Student"){
			
			$sql1="select * from student where index_number='$user_index'";
		
			$result1=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_assoc($result1);
	
			$image=$row1['image_name'];
			
		}

		$image=$row1['image_name'];
		
		echo '<tr><td style="border:none;"><img class="logo1" src="../'.$image.'" > <p class="msg-p2">  '.$msg.' </p></td></tr>';
	}
	
}

?>
                                          
</tbody>
                                 