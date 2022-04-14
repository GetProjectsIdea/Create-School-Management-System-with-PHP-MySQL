<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header_admin.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('alert.php'); ?>

<style>
.modal-content1 {
  height: auto;
  min-height: 100%;
  border-radius: 0;
  position: absolute;
  left: 25%; 
}

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
        	Group Message
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Group Message</a></li>
    	</ol>
	</section>
<?php

$my_index=$_SESSION['index_number'];
$my_type=$_SESSION['type'];

?>
    
	<!-- table for view all records -->
	<section class="content" > <!-- Start of table section -->
		<div class="row" id="table1"><!--MSK-000132-1-->
			<div class="col-md-10">
            	<div class="box">
                	<div class="box-header">
                  		<h3 class="box-title">All Group Message</h3>
                        <a href="#" onClick="cNewMessage('<?php echo $my_index; ?>','<?php echo $my_type; ?>')" class="btn btn-sm  bg-orange-active pull-right " data-id="" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Create New </a><!-- MSK-00094--> 
                	</div><!-- /.box-header -->
                	<div class="box-body table-responsive">
                    	<!--MSK-00101-->
                		<table id="example1" class="table table-bordered table-striped">
                    		<thead>
                        		<th>ID</th>
                            	<th>Message</th>
                                <th class="col-md-2">Group</th>
                                <th>Grade</th>
                                <th class="col-md-2">Date</th>
                                <th>Time</th>
                            	<th>Action</th>
                        	</thead>
                        	<tbody>
<?php
include_once('../controller/config.php');

$sql="SELECT * FROM group_message ORDER BY id DESC";
$result=mysqli_query($conn,$sql);
$count = 0;
$grade=0;
$grade_name='';
$prefix='';

if(mysqli_num_rows($result) > 0){
	while($row=mysqli_fetch_assoc($result)){
		$count++;
		$group=$row['group_id'];
		$grade=$row['grade'];
		
		if($group == 1){
			$group = "All";
		}else if($group == 2){
			$group = "All Teachers & Student";
		}else if($group == 3){
			$group = "All Teachers & Specific Grades";
		}else if($group == 4){
			$group = "Only Specific Grades";
		}else if($group == 5){
			$group = "Only Teachers";
		}else if($group == 6){
			$group = "Only Students";
		}else if($group == 7){
			$group = "Only Parents";
		}else{
			
		}
	
?>   
                        		<tr>
                            		<td> <?php echo $count; ?></td>
									<td> <?php echo $row['message']; ?> </td>
                      				<td> <?php echo $group; ?></td>
									<td>  
                                    	<?php 
											if($grade){
														
												$g=(explode(",",$grade));
														
												for($i=0;$i<count($g);$i++){
													$id=$g[$i];
															
													$sql1="SELECT * FROM grade WHERE id=$id";
													$result1=mysqli_query($conn,$sql1);
													$row1=mysqli_fetch_assoc($result1);
													echo $row1['name'].'<br>';
												}
														
											}else{
												echo "All";
											}
										?>
                                    </td>
                                    <td> <?php echo $row['date']; ?> </td>
                                    <td> <?php echo $row['time']; ?> </td>
             						<td> 
            <a href="#modalModalGMessage" onClick="showModalGMessage('<?php echo $row['id']; ?>')" class="btn btn-warning btn-xs" data-id="" data-toggle="modal">View Message</a>
                                    </td>
                            	</tr>
<?php } } ?>
                        	</tbody>
                    	</table>	
            	</div>
			</div>
		</div>
	</section> <!-- End of table section -->
    
    <div id="cGMsg">
    
    </div>
    
    <div id="showGMsg">
    
    </div>
    
<script>

function cNewMessage(my_index,my_type){
	
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
		xhttp.onreadystatechange = function() {
				
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById('cGMsg').innerHTML = this.responseText;//MSK-000132
				$('#modalcNewMessage').modal('show');
				
				$("#divGrade").hide();
				
				$("#group").change(function(){
					var group = this.value;
					if(group == 3 || group == 4 ){
						$("#divGrade").show();
					}else{
						$("#divGrade").hide();
					}
				});
				
				
			}
				
		};	
		
		//xhttp.open("GET", "show_events.php?event_id="+event_id , true);
		xhttp.open("GET", "create_group_message.php?my_index=" + my_index + "&my_type="+my_type , true);													
		xhttp.send();//MSK-00105-Ajax End
	
	
}


function showModalGMessage(msg_id){
	
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
		xhttp.onreadystatechange = function() {
				
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById('showGMsg').innerHTML = this.responseText;//MSK-000132
				$('#modalviewGMessage').modal('show');
				
			}
				
		};	
		
		//xhttp.open("GET", "show_events.php?event_id="+event_id , true);
		xhttp.open("GET", "show_group_message.php?msg_id=" + msg_id , true);													
		xhttp.send();//MSK-00105-Ajax End
	
	
}

</script>  

<!--run Insert alert using PHP & JS/jQuery  -->          
<?php
if(isset($_GET["do"])&&($_GET["do"]=="alert_from_insert")){
//MSK-000143-6-PHP-JS-INSERT
 
	$msg=$_GET['msg'];

	if($msg==1){
		echo"
			<script>
			
			var myModal = $('#insert_Success');
			myModal.modal('show');
			
    		myModal.data('hideInterval', setTimeout(function(){
    			myModal.modal('hide');
    		}, 3000));
						
			</script>
		";
	
	}

	if($msg==2){
		
		echo"
			<script>
			
			var myModal = $('#connection_Problem');
			myModal.modal('show');
			
			clearTimeout(myModal.data('hideInterval'));
    		myModal.data('hideInterval', setTimeout(function(){
    			myModal.modal('hide');
    		}, 3000));
			
			</script>
		";
	
	}
	
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
   