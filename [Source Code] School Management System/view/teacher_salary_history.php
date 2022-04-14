<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('alert.php'); ?>

<style>

body { 
	overflow-y:scroll;
}

.modal-dialog1 {
  width: 60%;
  height: 100%;
  margin: 0;
  padding: 0;

}
.modal-content1 {
  height: auto;
  min-height: 100%;
  border-radius: 0;
  position: absolute;
  left: 35%;  
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
        	Teacher Salary
            <small>History</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Teacher Salary History</a></li>
        </ol>
	</section>

<!-- table for view all records -->
       
	<!-- Main content -->
	<section class="content" > <!-- Start of table section -->
    	<div class="row" id="table1"><!--MSK-000132-1-->
        	<div class="col-md-10">
            	<div class="box">
                	<div class="box-header">
                  		<h3 class="box-title">Teacher Salary History</h3>
                	</div><!-- /.box-header -->
                	<div class="box-body table-responsive">
                    	<!-- MSK-00093-->
                		<table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <th class="col-md-1">ID</th>
                                <th class="col-md-1">Year</th>
                                <th class="col-md-1">Month</th>
                                <th class="col-md-1">Description</th>
                                <th class="col-md-1">Paid($)</th>
                                <th class="col-md-1">Date</th>
                                <th class="col-md-2">Action</th>
                            </thead>
                        	<tbody>
<?php
include_once('../controller/config.php');
$sql="select * from teacher_salary where index_number='3'";
$result=mysqli_query($conn,$sql);
$count = 0;
if(mysqli_num_rows($result) > 0) {
	while($row=mysqli_fetch_assoc($result)){
		$count++;
?>   
                                <tr>
                                    <td><?php echo $count; ?></td>
               <!--MSK-000115-td1--><td id="td1_<?php echo $row['sr_id']; ?>"><?php echo $row['year']; ?></td>
               <!--MSK-000115-td2--><td id="td2_<?php echo $row['sr_id']; ?>"><?php echo $row['month']; ?></td>
               <!--MSK-000115-td3--><td id="td3_<?php echo $row['sr_id']; ?>"><?php echo $row['_status']; ?></td>
               <!--MSK-000115-td4--><td id="td4_<?php echo $row['sr_id']; ?>"><?php echo $row['paid']; ?></td>
               						<td id="td4_<?php echo $row['sr_id']; ?>"><?php echo $row['date']; ?></td>
                                    <td> 
<!--MSK-00102-->                                                
<a href="#" onClick="showModal(this)" class="btn btn-info btn-xs" data-id="20">View Details</a>
<a href="#" onClick="showModal1(this)" class="btn btn-success btn-xs" data-id="20" >View Invoice</a>
                               		</td>
                            	</tr>
<?php } } ?>
                        	</tbody>
                    	</table>
                	</div><!-- ./box-body -->
            	</div><!-- ./box -->
        	</div> 
    	</div><!-- ./row -->
	</section> <!-- End of table section --> 
    
    <div id="salaryDetails">
    
    </div>
    
<script>
function showModal(sDetails){
//MSK-00104
	
	var id = $(sDetails).data("id"); 
	alert(id);
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
  		xhttp.onreadystatechange = function() {
    		
			if (this.readyState == 4 && this.status == 200) {
				
				document.getElementById('salaryDetails').innerHTML = this.responseText;//MSK-000137
				$('#modalviewSalary1').modal('show');			
    		}
			
  		};	
		
    	xhttp.open("GET", "teacher_salary_details3.php?teacher_id=" + id , true);												
  		xhttp.send();//MSK-00105-Ajax End
	 
};

function showModal1(viewINV){
//MSK-00104
	
	var id = $(viewINV).data("id"); 
	alert(id);
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
  		xhttp.onreadystatechange = function() {
    		
			if (this.readyState == 4 && this.status == 200) {
				
				document.getElementById('salaryDetails').innerHTML = this.responseText;//MSK-000137
				$('#modalviewSalary1').modal('show');			
    		}
			
  		};	
		
    	xhttp.open("GET", "teacher_salary_details4.php?teacher_id=" + id , true);												
  		xhttp.send();//MSK-00105-Ajax End
	 
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