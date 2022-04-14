<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header_teacher.php'); ?>
<?php include_once('sidebar2.php'); ?>
<?php include_once('alert.php'); ?>

<style>

.msg-p1{
	
	max-width:250px !important;
	word-break: break-all;
	float:right;
	text-align:left;
	font-size:11px;  
	font-weight:700;
	
	background-color:#5bc0de;
	color:white;
	border-radius:15px;
	padding:7px;
	font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.msg-p2{
	
	max-width:250px !important;
	word-break: break-all;
	float:left;
	text-align:left;
	font-size:11px;  
	font-weight:600;
	
	background-color:#dbdada;
	color:black;
	border-radius:15px;
	padding:7px;
	font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
}


body{
	overflow-y:scroll;
	
}

.msk-fade {  
      
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s

}

.friend-image{
	float: left;
	width: 80px;
	height: 80px;
	
	
	text-align: center;
	
}

#conversation-panel-body{
	height:430px!important;
	overflow:auto !important;
}
.div-logo {
	float: left;
	height: 130px;
}

.logo1{
	float: left;
	width: 35px;
	height: 35px;
	margin-right: 10px;
	border-radius: 50%;
	text-align: center;
	background-color:#8860a7;
	margin-bottom:5px;
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
        
        $('#tableMyFriend').DataTable({
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
        	My Friends
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Friends</a></li>
            <li><a href="#">My Friends</a></li>
    	</ol>
	</section>
    
    <!-- table for view all records //MSK-00112 -->
    <section class="content" > <!-- Main content -->
        <div class="row" id="table1">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table id="tableMyFriend" class="table ">
                            <thead>
                                <th class="col-md-1"></th>
                                <th class="col-md-5"></th>
                                <th class="col-md-6"></th>
                            </thead>
                            <tbody>
<?php
include_once('../controller/config.php');
$my_index=$_SESSION["index_number"];
$my_type=$_SESSION["type"];

$current_year=date('Y');
$sql="select * from my_friends where my_index='$my_index' and _status='Friend'";
$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
    	
		$friend_type=$row['friend_type'];
		$friend_index=$row['friend_index'];
		$conversation_id=$row['conversation_id'];
		
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
                                <tr>
                                    <td><img src="../<?php echo $friend_image; ?>" class="friend-image"></td>
                                    <td id="td1_<?php echo $row['mf_id']; ?>">
									<a href="#"onClick="friendProfile('<?php echo $friend_type; ?>','<?php echo $friend_index; ?>')"><?php echo $friend_name; ?> </a><br>
                                        
                                        <?php 
											if($friend_type == "Student"){
												
												$sql2="select grade.name as g_name 
													   from student_grade
													   inner join grade
													   on student_grade.grade_id=grade.id
													   where index_number='$friend_index' and year='$current_year'";
												$result2=mysqli_query($conn,$sql2);
												$row2=mysqli_fetch_assoc($result2);
												
												echo "<small> Student - ".$row2['g_name']."</small>";
												
											}
										
											if($friend_type == "Teacher"){
												echo "<small> Teacher </small>";
											}
											
											if($friend_type == "Admin"){
												echo "<small> Admin </small>";
											}
										?>
                                        
                                        
                                    </td>
                                    <td>
<!--MSK-00146 --> 
<a href="#" onClick="showModal('<?php echo $my_index; ?>','<?php echo $conversation_id; ?>','<?php echo $friend_index; ?>','<?php echo $my_type; ?>')" class="btn btn-primary btn-xs"  >Send Messege</a>
                                    </td>
                                    
                                </tr>
<?php } } ?>
                            </tbody>
                        </table>
                	</div><!-- /.box-body -->	
                </div>
            </div>
            <div class="col-md-6" id="showMsg" style=" height:520px;">
        
    		</div>
        </div>
    </section> <!-- End of table section --> 

    <div class="row" id="fProfile">
        
    </div>
    
<script>
//MSK-00147

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

var timer1=0;
var myVar;
var intervalID;
var intervalID1;

function showModal(my_index,conversation_id,friend_index,my_type){
	
	timer1-=timer1;
	clearInterval(intervalID);
	
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {
				
				document.getElementById('showMsg').innerHTML = this.responseText;
				$('#conversation-panel-body').scrollTop($('#conversation-panel-body')[0].scrollHeight);
				 
    		}
			
  		};	
		
    	xhttp.open("GET", "conversation_history_teacher.php?my_index=" + my_index + "&my_type="+my_type + "&conversation_id="+conversation_id + "&friend_index="+friend_index, true);												
  		xhttp.send();//MSK-00149--End Ajax
								
};
 		
document.onkeydown=function(evt){//start press Enter Key
		
	var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
									
		if(keyCode == 13){
 
			var msg = document.getElementById('msg').value;
			var my_index = document.getElementById('my_index').value;
			var conversation_id = document.getElementById('conversation_id').value;
			var friend_index = document.getElementById('friend_index').value;
			var my_type = document.getElementById('my_type').value;
			
			var user_type = "Teacher";
			var do1 = "add_message";
			
			if(msg !== ""){
				
				var xhttp1 = new XMLHttpRequest();//MSK-00149-Start Ajax  
					xhttp1.onreadystatechange = function() {
																				
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById('msg').value = '';
									
							var myArray = eval( xhttp1.responseText );
							showCurrentmsg(my_index,conversation_id,friend_index);
							$('#conversation-panel-body').scrollTop($('#conversation-panel-body')[0].scrollHeight);
							timer1++;
							
							msgRead(conversation_id,friend_index,my_index,my_type);
							unreadMsgCount(my_index,my_type);
							
						}
										
					};
																				
					xhttp1.open("GET", "../model/add_message.php?conversation_id=" + conversation_id + "&user_index="+my_index  + "&msg="+msg + "&user_type="+user_type + "&do="+do1, true);												
					xhttp1.send();
						
						if(timer1 == 0){
							intervalID = setInterval(function(){
					 			
								$('#chatRoom').load("conversation_history_teacher1.php?my_index="+my_index+"&conversation_id="+conversation_id+"&friend_index="+friend_index+"");
								
													   
							}, 1000); // 1000 milliseconds = 1 second.
						}
											
			}
			
		}
		
};
    
function showCurrentmsg(my_index,conversation_id,friend_index){

	var xhttp2 = new XMLHttpRequest();//MSK-00149-Start Ajax  
		xhttp2.onreadystatechange = function() {
																																								
			if (this.readyState == 4 && this.status == 200) {	
																											
				document.getElementById('chatRoom').innerHTML = this.responseText;
				$("#msg").focus();	
				$('#conversation-panel-body').scrollTop($('#conversation-panel-body')[0].scrollHeight);
					
			}
															
		};
														
		xhttp2.open("GET", "conversation_history_teacher1.php?my_index=" + my_index + "&conversation_id="+conversation_id + "&friend_index="+friend_index, true);												
		xhttp2.send();

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
		
		intervalID1 = setInterval(function(){
										
			$('#unread_msg').load("unread_msg.php?my_index="+my_index+"&my_type="+my_type+"");
																		   
		}, 1000); // 1000 milliseconds = 1 second.
		
};

</script>

<?php
if(isset($_GET["do"])&&($_GET["do"]=="showChatBox")){///meeka mokadda
	
	$my_index=$_GET['my_index'];
	$my_type=$_GET['my_type'];
	$conversation_id=$_GET['conversation_id'];
	$friend_index=$_GET['friend_index'];

	echo '<script>','showModal('.$my_index.','.$conversation_id.','.$friend_index.',"'.$my_type.'");','</script>';
	echo '<script>','msgRead('.$conversation_id.','.$friend_index.','.$my_index.',"'.$my_type.'");','</script>';

	
}
?>

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