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

body { 
	overflow-y:scroll;
}
.modal-content1 {
   position: absolute;
   left: 125px; 
}
@media only screen and (max-width: 500px) {

	.modal-content1 {
   		
		position:static;
   
	}
}

.form-control-feedback {
  
   pointer-events: auto;
  
}

.set-width-tooltip + .tooltip > .tooltip-inner { 
  
     min-width:180px;
}
.set-color-tooltip + .tooltip > .tooltip-inner { 
  
     min-width:180px;
	 background-color:red;
}

.msk-fade{  
      
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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
        	Subject
            <small>Routing</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Subject Routing</a></li>
        </ol>
	</section>

	<!-- table for view all records -->
	<section class="content" > <!-- Start of table section -->
    	<div class="row" id="table1"><!--MSK-000132-1-->
        	<div class="col-md-7">
            	<div class="box">
                	<div class="box-header">
                 		
                  		<h3 class="box-title">My Subject</h3>
                	</div><!-- /.box-header -->
                	<div class="box-body table-responsive">
                    	<!-- MSK-00093-->
                		<table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <th class="col-md-1">ID</th>
                                <th class="col-md-1">Grade</th>
                                <th class="col-md-1">Subject</th>
                                <th class="col-md-1">Teacher</th>
                                <th class="col-md-1">Fee($)</th>
                            </thead>
                        	<tbody>
<?php
include_once('../controller/config.php');
$index=$_SESSION["index_number"];
$current_year=date('Y');

$sql1="SELECT * FROM student_grade WHERE index_number='$index' and year='$current_year'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$grade=$row1['grade_id'];

$sql="select subject_routing.id as sr_id,subject_routing.fee as s_fee,grade.name as g_name,subject.name as s_name,teacher.i_name as t_name
	  from subject_routing
      inner join grade
      on subject_routing.grade_id=grade.id 
      inner join subject
      on subject_routing.subject_id=subject.id 
      inner join teacher
      on subject_routing.teacher_id=teacher.id
	  where subject_routing.grade_id='$grade'";
$result=mysqli_query($conn,$sql);
$count = 0;
if(mysqli_num_rows($result) > 0) {
	while($row=mysqli_fetch_assoc($result)){
		$count++;
?>   
                                <tr>
                                    <td><?php echo $count; ?></td>
               <!--MSK-000115-td1--><td id="td1_<?php echo $row['sr_id']; ?>"><?php echo $row['g_name']; ?></td>
               <!--MSK-000115-td2--><td id="td2_<?php echo $row['sr_id']; ?>"><?php echo $row['s_name']; ?></td>
               <!--MSK-000115-td3--><td id="td3_<?php echo $row['sr_id']; ?>"><?php echo $row['t_name']; ?></td>
               <!--MSK-000115-td4--><td id="td4_<?php echo $row['sr_id']; ?>"><?php echo $row['s_fee']; ?></td>
                            	</tr>
<?php } } ?>
                        	</tbody>
                    	</table>
                	</div><!-- ./box-body -->
            	</div><!-- ./box -->
        	</div> 
    	</div><!-- ./row -->
	</section> <!-- End of table section --> 
    
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