<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php 
include_once('../controller/config.php');
$my_index=$_GET["my_index"];
$my_type=$_GET["my_type"];

$sql="SELECT count(id)
      FROM my_friends
      WHERE my_index='$my_index' AND _status='Pending' AND _isread='0'";
	  
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$unread_count=$row['count(id)'];

?>    
          
<a href="#" class="dropdown-toggle" data-toggle="dropdown" onClick="showFriendRequest('<?php echo $my_index; ?>','<?php echo $my_type; ?>')">
	<i class="fa fa-user-plus"></i>
    <span class="label label-success"><?php echo $unread_count; ?></span>
</a>

<ul class="dropdown-menu" id="dropdown_menu_frequest">
	<li class="header">You have <?php echo $unread_count; ?> friend request</li>
                  
    <li>
		<!-- inner menu: contains the actual data -->
        <ul class="menu">
        	<li><!-- start friend request -->
                     
<?php

include_once('../controller/config.php');

$my_index=$_GET["my_index"];
$my_type=$_GET["my_type"];

$time='';

			
$sql="SELECT * FROM my_friends WHERE my_index='$my_index' AND _status='Pending' ORDER BY id";	
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
	
	$friend_type=$row['friend_type'];	
	$friend_index=$row['friend_index'];	
		
	if($friend_type=="Student"){
		
		$sql1="SELECT * FROM student WHERE index_number='$friend_index'";
		$result1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_assoc($result1);
		
		$friend_name=$row1['i_name'];
		$friend_image=$row1['image_name'];	
		
	}
		
	if($friend_type=="Teacher"){
		
		$sql1="SELECT * FROM teacher WHERE index_number='$friend_index'";
		$result1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_assoc($result1);
		
		$friend_name=$row1['i_name'];
		$friend_image=$row1['image_name'];	
			
	}
		
	if($friend_type=="Admin"){
	
		$sql1="SELECT * FROM admin WHERE index_number='$friend_index'";
		$result1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_assoc($result1);
		
		$friend_name=$row1['i_name'];
		$friend_image=$row1['image_name'];	
			
	}
			
?>  

<a href="#"  > 

<div class="pull-left">
	<img src="../<?php echo $friend_image; ?>" class="img-circle" alt="User Image">
</div>
<span onClick="friendProfile('<?php echo $friend_type; ?>','<?php echo $friend_index; ?>')"><h5 style="padding:0; margin:0;"><?php echo $friend_name; ?></h5>  </span> 
<button onClick="confirmFriend('<?php echo $my_index; ?>','<?php echo $my_type; ?>','<?php echo $friend_index; ?>')" class="btn btn-xs bg-green-active"><i class="fa fa-user-plus" aria-hidden="true"> Confirm</i></button>
<button href="#" class="confirm-delete-friend-req btn btn-xs btn-danger" data-id="<?php echo $my_index; ?>,<?php echo $friend_index; ?>" ><i class="fa fa-user-plus" aria-hidden="true"> Delete Request</i></button>  

</a>

<?php }  ?> 
                        
            	</li><!-- end friend request -->
        	</ul>
    	</li>
	<li class="footer"><a href="#">See All Friend Request</a></li>
</ul>



