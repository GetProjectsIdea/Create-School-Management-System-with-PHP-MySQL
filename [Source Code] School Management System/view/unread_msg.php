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
$unread_msg_count=0;

$sql="SELECT * FROM my_friends WHERE my_index='$my_index'";
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result)){
	
	$friend_index=$row['friend_index'];
	
	$sql1="SELECT count(id)
		  FROM online_chat
		  WHERE user_index='$friend_index' AND _isread='0'";
		  
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_assoc($result1);
	$unread_msg_count+=$row1['count(id)'];
	
}

?> 

<a href="#" class="dropdown-toggle" data-toggle="dropdown">
	<i class="fa fa-envelope-o"></i>
    <span class="label label-success"><?php echo $unread_msg_count; ?></span>
</a>
<ul class="dropdown-menu">
	<li class="header">You have <?php echo $unread_msg_count; ?> messages</li>
                  
    <li>
    	<!-- inner menu: contains the actual data -->
		<ul class="menu">
<?php

include_once('../controller/config.php');

$index=$_GET["my_index"];
$type=$_GET["my_type"];

$time='';
		
	$sql="SELECT 
           DISTINCT conversation_id,friend_index 
           FROM
              my_friends
           WHERE
              	my_index='$index'  
           ORDER BY
              conversation_id";
	
	$result=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_assoc($result)){
		
		$conversation_id=$row['conversation_id'];
		$friend_index=$row['friend_index'];
		
		$sql3="SELECT * FROM my_friends WHERE conversation_id='$conversation_id' and friend_index='$friend_index'";	
		$result3=mysqli_query($conn,$sql3);
		$row3=mysqli_fetch_assoc($result3);
		$friend_type=$row3['friend_type'];
		
		if($friend_type == "Admin"){
			
			$sql1="SELECT * FROM admin WHERE index_number='$friend_index'";	
		
			$result1=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_assoc($result1);
			$friend_name=$row1['i_name'];
			$friend_image=$row1['image_name'];
			
		}
		
		if($friend_type == "Teacher"){
			
			$sql1="SELECT * FROM teacher WHERE index_number='$friend_index'";	
		
			$result1=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_assoc($result1);
			$friend_name=$row1['i_name'];
			$friend_image=$row1['image_name'];
			
		}
		
		if($friend_type == "Student"){
			
			$sql1="SELECT * FROM student WHERE index_number='$friend_index'";	
		
			$result1=mysqli_query($conn,$sql1);
			$row1=mysqli_fetch_assoc($result1);
			$friend_name=$row1['i_name'];
			$friend_image=$row1['image_name'];
			
		}
		
		$sql2="SELECT * FROM online_chat WHERE conversation_id='$conversation_id' ORDER BY id DESC LIMIT 1";	
		$result2=mysqli_query($conn,$sql2);
		while($row2=mysqli_fetch_assoc($result2)){
		
			$last_msg=$row2['msg'];
			$msg_time=$row2['time'];
			
			$datetime1 = new DateTime($msg_time);
			$datetime2 = new DateTime();
			$interval = $datetime1->diff($datetime2);
						
			$year = $interval->format('%y y ');
			$month = $interval->format('%m m ');
			$days = $interval->format('%a d');
			$hours = $interval->format('%h h');
			$minutes = $interval->format('%i mins');
			$seconds = $interval->format('%s sec');
			
			if($year>0){
				$time=$year;
			}else if($month>0){
				$time=$month;
			}else if($days>0){
				$time=$days;
			}else if($hours>0){
				$time=$hours;
			}else if($minutes>0){
				$time=$minutes;
			}else{
				$time=$seconds;
			}
			
			if($type=="Admin"){
				$file_path="my_friends.php?do=showChatBox&my_index=$index&conversation_id=$conversation_id&friend_index=$friend_index&my_type=$type";
			}
			
			
			if($type=="Teacher"){
				$file_path="my_friends2.php?do=showChatBox&my_index=$index&conversation_id=$conversation_id&friend_index=$friend_index&my_type=$type";
			}
			
			if($type=="Student"){
				$file_path="my_friends1.php?do=showChatBox&my_index=$index&conversation_id=$conversation_id&friend_index=$friend_index&my_type=$type";
			}
			
?>                      
			<li><!-- start message -->
            	<a href="<?php echo $file_path; ?>">
                <div class="pull-left">
                        <img src="../<?php echo $friend_image; ?>" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                        <?php echo $friend_name; ?>
                        <small><i class="fa fa-clock-o"></i> <?php echo $time; ?></small>
                    </h4>
                    <p><?php echo $last_msg; ?></p>
                </a>
            </li><!-- end message -->
                      
 <?php }  } ?>                     
                     
		</ul>
	</li>
   	<li class="footer"><a href="#">See All Messages</a></li>
</ul>