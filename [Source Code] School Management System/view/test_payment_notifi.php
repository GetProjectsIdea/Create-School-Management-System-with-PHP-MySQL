<?php
include_once('../controller/config.php');
$my_type="Admin";

if($my_type == 'Admin'){
	
	$sql1="SELECT COUNT(id) FROM main_notifications WHERE _isread='0'";
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_assoc($result1);
	$notfi_count=$row1['COUNT(id)'];
	
?>
                  <span class="label label-warning"><?php echo $notfi_count; ?></span>
                </a>
                <ul class="dropdown-menu">
                  
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
		echo $sql1;
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
                 
                </ul>
              </li>
<?php }  ?>           
           
