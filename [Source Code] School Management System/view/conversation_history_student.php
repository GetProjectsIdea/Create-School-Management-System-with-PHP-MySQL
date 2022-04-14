<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="row">
	<div class="col-md-12">
    	<div class="panel" id="conversation-panel"><!--panel bg-maroon--> 
        	<div class="panel-heading bg-aqua-active text-right">
                            
<?php
include_once("../controller/config.php");

$my_index=$_GET['my_index'];
$friend_index=$_GET['friend_index'];
$conversation_id=$_GET['conversation_id'];
$name="";
	
$sql="select * from my_friends where conversation_id='$conversation_id' and friend_index='$friend_index'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$friend_type=$row['friend_type'];	


	if($friend_type == "Admin"){
			
		$sql1="select * from admin where index_number='$friend_index'";
		
		$result1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_assoc($result1);
	
		$name=$row1['i_name'];
			
	}
		
	if($friend_type == "Teacher"){
			
		$sql1="select * from teacher where index_number='$friend_index'";
		
		$result1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_assoc($result1);
	
		$name=$row1['i_name'];
			
	}
		
	if($friend_type == "Student"){
			
		$sql1="select * from student where index_number='$friend_index'";
		
		$result1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_assoc($result1);
	
		$name=$row1['i_name'];
			
	}




	
?>                            
            	<h4 class="panel-title" id="hname"><?php echo $name; ?></h4>
            </div>
            <div class="panel-body" id="conversation-panel-body"><!--panel-body -->
            	<div class="row">
                	<div class=" col-md-12"> 
                    	<table class="table" id="chatRoom">
                        	<tbody >
<?php
include_once("../controller/config.php");
$my_index=$_GET['my_index'];
$my_type=$_GET['my_type'];
$conversation_id=$_GET['conversation_id'];
	
$sql="select * from online_chat where conversation_id='$conversation_id'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
	
	$user_index=$row['user_index'];
	$msg=$row['msg'];
	$user_type=$row['user_type'];
	
	if($user_index==$my_index){
		
		echo '<tr class="msg-tr"><td style="border:none;"><p class="msg-p1"> '.$msg.' </p></td></tr>';
		
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
		
		echo '<tr class="msg-tr"><td style="border:none;"><img class="logo1" src="../'.$image.'" ><p class="msg-p2"> '.$msg.' </p></td></tr>';
	}
	
}

?>
                                          
                        	</tbody>
                    	</table>
                	</div>
            	</div>
            </div><!--/.panel-body -->
            <div class=""><!--panel-footer -->
           		<textarea class="form-control" id="msg" name="msg" rows="2"></textarea>
                <input type="hidden" name="conversation_id" id="conversation_id" value="<?php echo $conversation_id; ?>">
                <input type="hidden" name="my_index" id="my_index" value="<?php echo $my_index; ?>">
                <input type="hidden" name="friend_index" id="friend_index" value="<?php echo $friend_index; ?>">
                <input type="hidden" name="my_type" id="my_type" value="<?php echo $my_type; ?>">
        	</div><!--/.panel-footer-->
    	</div><!--/. panel--> 
	</div>
</div><!--/.row --> 