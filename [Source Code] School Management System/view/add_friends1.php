<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header_student.php'); ?>
<?php include_once('sidebar1.php'); ?>

<style>

body{
	overflow-y:scroll;
}

.friend-image{
	float: left;
	width: 80px;
	height: 80px;	
	text-align: center;
	
}
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

</style>

 <script>
      $(function () {
        
        $('#tableAddFriend').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": false,
          "info": true,
		  "pageLength": 4,
          "autoWidth": false
        });
      });
    </script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
        	Friends
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Friends</a></li>
            <li><a href="#">Add Friends</a></li>
    	</ol>
	</section>
    
    <!-- table for view all records //MSK-00112 -->
    <section class="content" > <!-- Main content -->
        <div class="row" id="table1"><!-- after delete methanata thamay overite karanne view_classroom table -->
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                    	
<?php 
$my_index=$_SESSION["index_number"]; 
$my_type=$_SESSION["type"];
?>                        
            				<div class="">
                            	<a href="#" onClick="showFriends('<?php echo $my_type; ?>','Student','<?php echo $my_index; ?>')" class="btn btn-md bg-navy-active"  data-id=""><i class="fa fa-user-plus" aria-hidden="true">Student</i></a>
                                <a href="#" onClick="showFriends('<?php echo $my_type; ?>','Teacher','<?php echo $my_index; ?>')" class="btn btn-md bg-orange-active"  data-id=""><i class="fa fa-user-plus" aria-hidden="true">Teachers</i></a> 
                                <a href="#" onClick="showFriends('<?php echo $my_type; ?>','Admin','<?php echo $my_index; ?>')" class="btn btn-md bg-green-active"  data-id=""><i class="fa fa-user-plus" aria-hidden="true">Admin</i></a>
                            </div>
                            <table id="tableAddFriend" class="table">
                                <thead>
                                    <th class="col-md-1"></th>
                                    <th class="col-md-5"></th>
                                    <th class="col-md-6"></th>
                                </thead>
                                <tbody id="tBodyFriends">
                            	<?php
include_once('../controller/config.php');
$my_index=$_SESSION["index_number"];
$current_year=date('Y');
$sql="select student.index_number as std_index,student.i_name as std_name,student.image_name as std_image,grade.name as g_name
	  from student
	  inner join student_grade
	  on student.index_number=student_grade.index_number
	  inner join grade
	  on student_grade.grade_id=grade.id
	  where student.index_number!='$my_index' and student_grade.year='$current_year'";

$result=mysqli_query($conn,$sql);

$action='';
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
					
if($status == ""){
	echo '<a href="#" onClick="addFriends(this)" data-id="'.$my_type.','.$my_index.',Student,'.$friend_index.'" class="btn btn-xs bg-blue">'.'<i class="fa fa-user-plus" aria-hidden="true">'. ' Add Friend'.'</i>'.'</a>';
}
				 	
if($status == "Friend"){
	echo '<span class="label label-lg bg-maroon">' .'Friend'.'</span>'; 
}								
?>
                                        </td>
                                     </tr>
<?php } }?>
                        		</tbody>   
                        	</table>
                	</div><!-- /.box-body -->	
                </div>
            </div>
        </div>
    </section> <!-- End of table section --> 
    
    <div id="fProfile">
    
    </div>
    
<script>
//MSK-00147

var intervalID7;
var count4=0;
var friend_type = '';
 
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


function showFriends(my_type,friend_type,my_index){
	
	clearInterval(intervalID7);
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
				document.getElementById('tBodyFriends').innerHTML = this.responseText;
				
    		}
			
  		};	
		
    	xhttp.open("GET", "find_friends.php?my_type=" + my_type + "&friend_type="+friend_type + "&my_index="+my_index, true);												
  		xhttp.send();//MSK-00149--End Ajax
		
		
	 
};

function new123(my_type,friend_type,my_index){
	
	intervalID7 = setInterval(function(){
	count4++;		
							
		$('#tBodyFriends').load("find_friends.php?my_type="+my_type+"&friend_type="+friend_type+"&my_index="+my_index+"");
		
		if(count4 == 20){
			
			clearInterval(intervalID7);
			count4 = 0;
					
		}	
																	   
	}, 1000); // 1000 milliseconds = 1 second.
	
};
</script>

<?php 

$my_index=$_SESSION["index_number"];
$my_type=$_SESSION["type"];

echo '<script>','new123("'.$my_type.'","Student",'.$my_index.');','</script>';

?>




<script>
setInterval(function() {
	
	var my_type = "Student";
	var my_index = 5;
	var friend_type = "Student";
	
  	//showFriends(my_type,friend_type,my_index);
	
	}, 1000);

function addFriends(aFriend){
	
	var myArray = $(aFriend).data("id").split(',');
	
	var my_type = myArray[0];
	var my_index = myArray[1];
	var friend_type = myArray[2];
	var friend_index = myArray[3];
	
	var do1 = "add_friends";
		
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
				
				var myArray = eval(xhttp.responseText);
				var msg = myArray[0];
				
				if(msg == 1){
					showFriends(my_type,friend_type,my_index);
					
				}
				
    		}
			
  		};	
		
    	xhttp.open("GET", "../model/add_friends.php?my_type=" + my_type +"&my_index="+my_index +"&friend_type="+friend_type +"&friend_index="+friend_index + "&do="+do1, true);												
  		xhttp.send();//MSK-00149--End Ajax
		new123(my_type,friend_type,my_index);
	 
};


function confirmFriend1(cFriend){
	
	var myArray = $(cFriend).data("id").split(',');
	
	var my_type = myArray[0];
	var my_index = myArray[1];
	var friend_type = myArray[2];
	var friend_index = myArray[3];
		
	var do1 = "confirm_friends";
		
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
				
				var myArray = eval(xhttp.responseText);
				var msg = myArray[0];
				
				if(msg==1){
					
					showFriends(my_type,friend_type,my_index);
				}
				
    		}
			
  		};	
		
    	xhttp.open("GET", "../model/confirm_friends.php?my_index=" + my_index +"&friend_index="+friend_index +"&do="+do1, true);												
  		xhttp.send();
	new123(my_type,friend_type,my_index);
};

  
</script>

<!--redirect your own url when clicking browser back button -->
<script>
(function(window, location) {
history.replaceState(null, document.title, location.pathname+"#!/history");
history.pushState(null, document.title, location.pathname);

window.addEventListener("popstate", function() {
  if(location.hash === "#!/history") {
    history.replaceState(null, document.title, location.pathname);
    setTimeout(function(){
      location.replace("../index.php");//path to when click back button
    },0);
  }
}, false);
}(window, location));
</script>

</div><!-- /.content-wrapper -->  
              
<?php include_once('footer.php');?>