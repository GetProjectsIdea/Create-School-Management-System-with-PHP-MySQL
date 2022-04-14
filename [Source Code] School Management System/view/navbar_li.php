<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
            	<!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" onClick="showNavBar('<?php echo $my_index; ?>','<?php echo $my_type; ?>')">
                  <i class="fa fa-user-plus"></i>
                  <span class="label label-success"><?php echo $unread_count; ?></span>
                </a>
                <ul class="dropdown-menu" id="dropdown_menu_frequest">
                  <li class="header">You have <?php echo $unread_count; ?> friend request</li>
                  
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                   
                     <li id="friend_request"><!-- start friend request -->
                     
                     <?php

include_once('../controller/config.php');

$my_index=$_GET["my_index"];
$my_type=$_GET["my_type"];

$time='';
if($my_type=="Student"){
			
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
<h4><?php echo $friend_name; ?> </h4> 
<button onClick="confirmFriend('<?php echo $my_index; ?>','<?php echo $my_type; ?>','<?php echo $friend_index; ?>')" class="btn btn-xs bg-green-active"><i class="fa fa-user-plus" aria-hidden="true"> Confirm</i></button>
<button href="#" class="confirm-delete btn btn-xs btn-danger" data-id="<?php echo $my_index; ?>,<?php echo $friend_type; ?>,<?php echo $friend_index; ?>" ><i class="fa fa-user-plus" aria-hidden="true"> Delete Request</i></button>  
</a>
<?php } } ?> 
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                        
                      </li><!-- end friend request -->
                      
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Friend Request</a></li>
                </ul>
              </li>           
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
             	
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
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
if($type=="Student"){
	
	
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
		
		$sql1="SELECT * FROM student WHERE index_number='$friend_index'";	
		
		$result1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_assoc($result1);
		$friend_name=$row1['i_name'];
		$friend_image=$row1['image_name'];
		
		
		$sql2="SELECT * FROM online_chat WHERE conversation_id='$conversation_id' ORDER BY id DESC LIMIT 1";	
		$result2=mysqli_query($conn,$sql2);
		while($row2=mysqli_fetch_assoc($result2)){
		
			$last_msg=$row2['msg'];
			
			$datetime1 = new DateTime('2017-00-21 09:00:00');
			$datetime2 = new DateTime('2017-00-21 09:00:30');
			$interval = $datetime1->diff($datetime2);
			//$elapsed = $interval->format('%y y %m m %a d %h h %i mins %s sec');			
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
			
			
			
			
		

?>                      
                      
                      <li><!-- start message -->
                        <a href="my_friends10.php?do=showChatBox&my_index=<?php echo $index; ?>&conversation_id=<?php echo
						$conversation_id; ?>&friend_index=<?php echo $friend_index; ?>">
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
                      
 <?php } } } ?>                     
                     
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li> 


<?php
include_once('../controller/config.php');



if($type=="Student"){
	$sql="SELECT * FROM student where index_number='$index'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
}

if($type=="Teacher"){
	$sql="SELECT * FROM teacher where index_number='$index'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);	
}

if($type=="Admin"){
	$sql="SELECT * FROM admin where index_number='$index'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);	
}

?> 





                
                <!-- User Account: style can be found in dropdown.less -->
            	<li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="../<?php echo $row['image_name']; ?>" class="user-image" alt="User Image">
                      <span class="hidden-xs"><?php echo $row['i_name']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <img src="../<?php echo $row['image_name']; ?>" class="img-circle" alt="User Image">
        
                        <p>
                          <?php echo $row['i_name']; ?> - <?php echo $type; ?>
                          <small>Member since Nov. 2012</small>
                        </p>
                      </li>
                      <!-- Menu Body -->
                      
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="#" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                          <a href="login.php" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                      </li>
                    </ul>
              </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
           