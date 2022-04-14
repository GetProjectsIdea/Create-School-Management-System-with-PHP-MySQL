<body class="hold-transition skin-blue sidebar-mini" >
<div class="wrapper">
  <header class="main-header" >
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><strong>SMS</strong></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><strong>School Management System </strong></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
       		<span class="sr-only">Toggle navigation</span>
       	</a>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
            
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
<?php
include_once('../controller/config.php');
$my_type=$_SESSION["type"];

if($my_type == 'Admin'){
	
	$sql1="SELECT COUNT(id) FROM main_notifications WHERE _isread='0'";
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_assoc($result1);
	$notfi_count=$row1['COUNT(id)'];
	
?>
                  <span class="label label-warning"><?php echo $notfi_count; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <?php echo $notfi_count; ?> notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
<?php
include_once('../controller/config.php');

$sql="SELECT * FROM main_notifications ORDER BY id DESC";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
	$_status=$row['_status'];
	$notification_id=$row['notification_id'];
	
	if($_status=="Events"){
		$sql1="SELECT * FROM events WHERE id='$notification_id'";
		$result1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_assoc($result1);
		$title1=$row1['title'];
		
		
		echo '<li>
              	<a href="#" onClick="showNotifyEvent('.$notification_id.')">
                    <i class="fa fa-users text-aqua"></i> You have new event - '.$title1.'
                </a>
              </li>
                      
              ';
		
	}
	
	if($_status=="Payments"){
		
		$sql1="select student.index_number as std_index,student.i_name as std_name,payment_notifications.month as due_month,payment_notifications.year as due_year,payment_notifications.id as notifi_id
               from payment_notifications
	           inner join student
	           on payment_notifications.index_number=student.index_number
			   where payment_notifications.id='$notification_id'";
	    
		$result1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_assoc($result1);
		
		$std_name=$row1['std_name'];
		$due_month=$row1['due_month'];
		$due_year=$row1['due_year'];
		$std_index=$row1['std_index'];
		$notifi_id=$row1['notifi_id'];
		
		echo '<li>
              	<a href="#" onClick="viewNotifications('.$std_index.',\'' . $due_month . '\','.$due_year.','.$notifi_id.')">
                    <i class="fa fa-users text-aqua"></i> '.$std_name.' didnt paid monthly fee for '.$due_month.'
                </a>
              </li>
                      
              ';
		
	}

}

?>
					</ul>
                  </li>
                  <li class="footer"><a href="#" onClick="viewAllNotifi()">View all</a></li>
                </ul>
              </li>
<?php }  ?>           
           
<script>
var count = 0;

function viewAllNotifi(){
	
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
				
				document.getElementById('viewAllNotification').innerHTML = this.responseText;
				$('#modalviewAllNotifications').modal('show');
				count++;
				
    		}
			
  		};	
		
    	xhttp.open("GET", "all_notifications.php", true);												
  		xhttp.send();
}

function viewNotifications(std_index,due_month,due_year,notifications_id){
	
	$("#modalviewAllNotifications").modal('hide');
	
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
				
				document.getElementById('viewDuePayment').innerHTML = this.responseText;
				$('#modalviewDuePayment').modal('show');
				
				notifiRead(notifications_id);
    		}
			
  		};	
		
    	xhttp.open("GET", "student_due_payment.php?std_index=" + std_index +"&due_month="+due_month +"&due_year="+due_year, true);												
  		xhttp.send();
	
}

function showNotifyEvent(event_id){
	
	$("#modalviewAllNotifications").modal('hide');
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
		xhttp.onreadystatechange = function() {
				
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById('showEvent2').innerHTML = this.responseText;//MSK-000132
				$('#modalviewEvent5').modal('show');
				notifiRead(event_id);
			}
				
		};	
		
		xhttp.open("GET", "show_events2.php?event_id="+event_id , true);												
		xhttp.send();//MSK-00105-Ajax End
};

function showAllNotfi1(){
	
	if(count > 0){
		viewAllNotifi();
	}
	
}

function countEquel0(){
	
	count = count-count;
	
}
 
</script>           
                   
<!-- Notifications -->              
<?php 
include_once('../controller/config.php');

$my_index=$_SESSION["index_number"];
$my_type=$_SESSION["type"];

$sql="SELECT count(id)
      FROM my_friends
      WHERE my_index='$my_index' AND _status='Pending' AND _isread='0'";
	  
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$unread_count=$row['count(id)'];

?>              
            	<!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu"  id="friend_request">
              	<a href="#" class="dropdown-toggle" data-toggle="dropdown" onClick="showFriendRequest('<?php echo $my_index; ?>','<?php echo $my_type; ?>')">
                  <i class="fa fa-user-plus"></i>
                  <span class="label label-success"><?php echo $unread_count; ?></span>
                </a>
              </li> 
              	
<script>
//MSK-00147
var intervalID1;
var count3 = 0;
function showFriendRequest(my_index,my_type){
	
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
				
				document.getElementById('friend_request').innerHTML = this.responseText;
				$('#dropdown_menu_frequest').toggle(1);
    		}
			
  		};	
		
    	xhttp.open("GET", "show_friend_request.php?my_index=" + my_index +"&my_type="+my_type , true);												
  		xhttp.send();
	
};

function friendProfile(friend_type,friend_index){
	
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
		xhttp.onreadystatechange = function() {
																	
			if (this.readyState == 4 && this.status == 200) {
																		
				document.getElementById('fProfile').innerHTML = this.responseText;
				$('#modalviewFriend').modal('show');														
			}
		};
																
		xhttp.open("GET", "friend_profile.php?friend_type=" + friend_type + "&friend_index="+friend_index, true);												
		xhttp.send();	
	
};

function studentProfile(std_index){
	
	$("#modalviewAllDPayment").modal('hide');
	
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
		xhttp.onreadystatechange = function() {
																	
			if (this.readyState == 4 && this.status == 200) {
																		
				document.getElementById('stdProfile').innerHTML = this.responseText;
				$('#modalviewStudent').modal('show');														
			}
		};
																
		xhttp.open("GET", "student_profile1.php?std_index=" + std_index , true);												
		xhttp.send();
	
	
	
};

function confirmFriend(my_index,my_type,friend_index){
	
	var do1 = "confirm_friends";
	$('#dropdown_menu_frequest').toggle('hide');	
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
				
				var myArray = eval(xhttp.responseText);
				var msg = myArray[0];
				
				if(msg==1){
					
					showFriendRequest(my_index,my_type);
					
				}
				
    		}
			
  		};	
		
    	xhttp.open("GET", "../model/confirm_friends.php?my_index=" + my_index +"&friend_index="+friend_index +"&do="+do1, true);												
  		xhttp.send();
	
};

</script>          
            
<?php 
include_once('../controller/config.php');
$my_index=$_SESSION["index_number"];
$my_type=$_SESSION["type"];
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
              <li class="dropdown messages-menu" id="unread_msg">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
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

$index=$_SESSION["index_number"];
$type=$_SESSION["type"];

$time='';
$file_path='';

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
                        <a href="<?php echo $file_path; ?>" onClick="msgRead('<?php echo $index; ?>','<?php echo $conversation_id; ?>','<?php echo $friend_index; ?>','<?php echo $type; ?>')">
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
                      
 <?php } } ?>    
 
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li> 
<script>

$('body').on('click', '.dropdown-toggle', function (e){
//MSK-000122	
	
    //e.preventDefault();
   clearInterval(intervalID1);
  
 	
});
              
function unreadMsg(my_index,my_type){
	
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
				
				document.getElementById('unread_msg').innerHTML = this.responseText;
				
    		}
			
  		};	
		
    	xhttp.open("GET", "unread_msg.php?my_index=" + my_index +"&my_type="+my_type , true);												
  		xhttp.send();
	
};     

function notifiRead(id){
	
	var do1 = "confirm_notifications_read";
	
	var xhttp = new XMLHttpRequest();//MSK-000127-Ajax Start  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {
				//MSK-000129
				var myArray = eval( xhttp.responseText );
				
    		}
			
  		};	
		
    	xhttp.open("GET", "../model/confirm_notifications_read.php?id=" + id + "&do="+do1 , true);												
  		xhttp.send();//MSK-000127-Ajax End
			
}; 


function msgRead(conversation_id,friend_index,my_index,my_type){
	
	var do1 = "confirm_msg_read";
	
	var xhttp = new XMLHttpRequest();//MSK-000127-Ajax Start  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {
				//MSK-000129
				var myArray = eval( xhttp.responseText );
				
    		}
			
  		};	
		
    	xhttp.open("GET", "../model/confirm_msg_read.php?conversation_id=" + conversation_id + "&friend_index="+friend_index + "&do="+do1 , true);												
  		xhttp.send();//MSK-000127-Ajax End
			
};   

function unreadMsgCount(my_index,my_type){
	
	intervalID1 = setInterval(function(){
		
		count3++;		
					
		$('#unread_msg').load("unread_msg.php?my_index="+my_index+"&my_type="+my_type+"");
			
					
		if(count3 == 10){
			clearInterval(intervalID1);
			count3 = 0;
					
		}	
																	   
	}, 1000); // 1000 milliseconds = 1 second.
	
	
};      
              
</script>

<?php 

$my_index=$_SESSION["index_number"];
$my_type=$_SESSION["type"];

?>

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
                          <?php
                          		$date = strtotime($row['reg_date']);
                                echo '<small>'."Member since ".date('M'.'.'.' Y', $date).'</small>';
                           ?>
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
            </ul> 
        </div>
	</nav>
  </header>
  <div class="row" id="fProfile">
        
  </div>
  <div id="viewDuePayment">
    
  </div>
  <div id="viewAllNotification">
    
  </div>
  <div id="stdProfile">
    
  </div>
  <div id="showEvent2">
  
  </div>
  
   <!-- //MSK-000124 Modal-Delete Confirm Popup -->
	<div class="modal msk-fade" id="deleteConfirmReq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
				<div class="modal-header bg-primary">
        			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        			<h4 class="modal-title" id="frm_title">Delete</h4>
      			</div>

				<div class="modal-body bgColorWhite">
        			<strong style="color:red;">Are you sure?</strong>  Do you want to Delete this Friend Request.
        		</div>
      			<div class="modal-footer">
					<a href="#" style='margin-left:10px;' id="btnYesReq" class="deletebtn btn btn-danger col-sm-2 pull-right">Yes</a><!-- MSK-000125 -->
        			<button type="button" class="btn btn-primary col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
      			</div>
    		</div>
  		</div>
	</div>
    
    <script>

$('body').on('click', '.confirm-delete-friend-req', function (e){
//MSK-000122		
    e.preventDefault();
    var id = $(this).data('id');
	$('#deleteConfirmReq').data('id1', id).modal('show');//MSK-000123
	

});

$('#btnYesReq').click(function() {
//MSK-000126
    var myArray = $('#deleteConfirmReq').data('id1').split(',');	
	var my_index = myArray[0];
	var friend_index = myArray[1];

	var do1 = "delete_friend_request";	
		
	var xhttp = new XMLHttpRequest();//MSK-000127-Ajax Start  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {
				//MSK-000129
				var myArray = eval( xhttp.responseText );
			
				if(myArray[0]==1){//MSK-000130
				
					$("#deleteConfirmReq").modal('hide');	
					 Delete_alert(myArray[0])
				
				 }
		
				 if(myArray[0]==2){//MSK-000137
			
					$("#deleteConfirmReq").modal('hide');
					 Delete_alert(myArray[0])
					
				 }

    		}
			
  		};	
    	
		xhttp.open("GET", "../model/delete_friend_request.php?my_index=" + my_index + "&friend_index="+friend_index + "&do="+do1  , true);												
  		xhttp.send();//MSK-000127-Ajax End
	 			   		
});

function Delete_alert(msg){
//MSK-000136	
	if(msg==1){
		
    	var myModal = $('#delete_Success');
		myModal.modal('show');
		
		clearTimeout(myModal.data('hideInterval'));
    	myModal.data('hideInterval', setTimeout(function(){
    		myModal.modal('hide');
			
    	}, 3000));
			
	}
	
	if(msg==2){
		
    	var myModal = $('#connection_Problem');
		myModal.modal('show');
		
    	clearTimeout(myModal.data('hideInterval'));
    	myModal.data('hideInterval', setTimeout(function(){
    		myModal.modal('hide');
    	}, 3000));
				
	}

};	

</script>
    
<style>
.msk-fade {  
      
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s

}  
  /* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

.modal-content1 {
   position: absolute;
   left: 25%; 
}

</style>