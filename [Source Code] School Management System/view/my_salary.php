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

<style>

.form-control-feedback {
  
   pointer-events: auto;
  
}

.set-width-tooltip + .tooltip > .tooltip-inner { 
     min-width:180px;
}

.msk-fade {  
      
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.5s;
    animation-name: animatetop;
    animation-duration: 0.5s

}
.modal-content3 {
  height: auto;
  min-height: 100%;
  border-radius: 0;
  position: absolute;
  left: -31%; 
}
#modalINV1 .pdetail1 {
	padding:0;
	float:right;
	margin-right:7px; 
	
}

#modalINV1 .pdetail2 {
	float: right;
	
}

@media only screen and (max-width: 500px) {
	
	.modal-content3{
		
	 	width:100%;
	  	position: static;
		
		
	}
	
	#salaryDetails, #salary_details, #salary_details2{
		width:100%;
	}
	
	 #tableSdetails, #tableSdetails1, #tableSdetails2 , #tableSdetails3{
		
		width:100%;
		
	}
	
	.panel-body, .table1-responsive, .table2-responsive {
		overflow-x:auto !important; 
	}
	
	

}

@media only screen and (max-width: 768px) {
    /* For mobile phones: */
    [class*="col-"] {
        width: 100%;
    }
	
	.panel-body, .table1-responsive, .table2-responsive  {
		overflow-x:auto !important; 
	}
	
	
	.modal-content3{
		
	 	width:100%;
	  	position: static;
		
		
	}
	
	#salaryDetails, #salary_details, #salary_details2{
		width:100%;
	}
	
	 #tableSdetails, #tableSdetails1, tableSdetails2{
		
		width:100%;
		
	}
	
	
	
}

@media only screen and (max-width: 1200px) {
    /* For mobile phones: */
 
	
	.modal-content3{
		
	 	width:100%;
	  	position: static;
		
		
	}
	
	[class*="col-"] {
        width: 100%;
    }
	
	#salaryDetails, #salary_details, #salary_details2{
		width:100%;
	}
	
	 #tableSdetails, #tableSdetails1, tableSdetails2{
		
		width:100%;
		
	}
	
	.panel-body, .table1-responsive, .table2-responsive  {
		overflow-x:auto !important; 
	}
	
	
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

/* #modalINV1 css  */

@media print{

	body{
		
		visibility: hidden;
	
	}

	#modalINV1{
		
	   visibility: visible;
	
	}

	#divPhoto{
		display:none;	
	}

}

#modalINV1 .div-logo {
	float: left;
	height: 130px;
}

#modalINV1 .logo{
	float: left;
	width: 90px;
	height: 90px;
	margin-right: 10px;
	border-radius: 50%;
	text-align: center;
	background-color:#8860a7;
}

#modalINV1 .class-name{
	float: left;		
	margin-top:0;
	padding-top:0;			
}

#modalINV1 h1,#modalINV1 h2,#modalINV1 h3{
	margin-top:0;
	color:#8860a7;

}

#modalINV1 .class-address {
	float: left;
			
}

#modalINV1 .class-email {
	float: right;
	margin-right:15px;
	padding-right:0;
	color:white;
	background-color:#8860a7;
}

#modalINV1 th{			
	background-color:#8860a7;
	color:white;
}
#modalINV1 .std-name{
	color:#8860a7;
	font-size:16px;
}
#modalINV1 #h1{
display:none;	
}


@media print{

#modalINV1 .logo{
		background-color:#8860a7 !important;	
	}

#modalINV1 h1,#modalINV1 h2,#modalINV1 h3,#modalINV1 .std-name{
		color:#8860a7 !important;	
	}
	
	
#modalINV1 .table-bordered th{
			
		color:white!important;
		background-color:#8860a7 !important;		
				
	}
#modalINV1 .class-email {
		color:white!important;
		background-color:#8860a7 !important;
		
} 

#modalINV1 .panel{
		border:hidden!important;
}
#modalINV1 #btn1,#modalINV1 .panel-footer ,#modalINV1 .msk-heading {
		display:none;
			
}
	
#modalINV1 #h1{
		display:inline;	
}

#modalINV1 .close{
		display:none;	
}
	
@-moz-document url-prefix() {
		
	.panel{
		
		margin:0;
		padding:0;
	}
	#modalINV1{
		
		margin:0!important;
		padding:0!important;
		position:absolute;
		left:-150px;
	}
	@page{
		margin:0;
		padding:0;	
	}

}

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
        	Salary
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">My Salary</a></li>
    	</ol>
	</section>
      
	<!-- table for view all records -->
	<section class="content" > <!-- Start of table section -->
    	<div class="row" id="table1"><!--MSK-000132-1-->
        	<div class="col-md-10">
            	<div class="box">
                	<div class="box-header">
<?php
include_once('../controller/config.php');
$index=$_SESSION["index_number"];

$sql="select * from student where index_number='$index'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['i_name'];
?>                    
                  		<h3 class="box-title">My Salary History</h3>
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
$index=$_SESSION["index_number"];

$sql="select * from teacher_salary where index_number='$index'";
$result=mysqli_query($conn,$sql);
$count = 0;
if(mysqli_num_rows($result) > 0) {
	while($row=mysqli_fetch_assoc($result)){
		$count++;
?>   
                                <tr>
                                    <td><?php echo $count; ?></td>
               <!--MSK-000115-td1--><td id="td_year_<?php echo $count; ?>"><?php echo $row['year']; ?></td>
               <!--MSK-000115-td2--><td id="td_month_<?php echo $count; ?>"><?php echo $row['month']; ?></td>
               <!--MSK-000115-td3--><td id="td_status_<?php echo $count; ?>"><?php echo $row['_status']; ?></td>
               <!--MSK-000115-td4--><td id="td_paid_<?php echo $count; ?>"><?php echo $row['paid']; ?></td>
               						<td id="td_date_<?php echo $count; ?>"><?php echo $row['date']; ?></td>
                                    <td> 
<!--MSK-00102-->                                                
<a href="#" onClick="showModal2(this)" class="btn btn-info btn-xs" data-id="<?php echo $index; ?>,<?php echo $row['year']; ?>,<?php echo $row['month']; ?>,<?php echo $count; ?>">View Details</a>
<a href="#" onClick="showModal3(this)" class="btn btn-success btn-xs" data-id="<?php echo $index; ?>,<?php echo $row['year']; ?>,<?php echo $row['month']; ?>,<?php echo $count; ?>" >View Invoice</a>
                               		</td>
                            	</tr>
<?php } } ?>
                        	</tbody>
                    	</table>
                	</div><!-- ./box-body -->
            	</div><!-- ./box -->
        	</div> 
 
        </div>
     </section>   
      
    
   	<div id="salaryDetails">
    
    </div>
    
    <section class="content">
        <div id="viewInvoice">
        
        </div>
    </section>

<script>

function showModal2(sDetails){
//MSK-00104
	
	var myArray = $(sDetails).data("id").split(',');
	
	var index = myArray[0];
	var year  = myArray[1];
	var month = myArray[2]; 
	
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
  		xhttp.onreadystatechange = function() {
    		
			if (this.readyState == 4 && this.status == 200) {
				
				document.getElementById('salaryDetails').innerHTML = this.responseText;//MSK-000137
				$('#modalviewSalary2').modal('show');			
    		}
			
  		};	
		
    	xhttp.open("GET", "teacher_salary_details3.php?index=" + index + "&year="+year  + "&month="+month , true);												
  		xhttp.send();//MSK-00105-Ajax End
	 
};

function showModal3(viewINV){
//MSK-00104
	
	var myArray = $(viewINV).data("id").split(','); 
	
	var index = myArray[0];
	var year  = myArray[1];
	var month = myArray[2];
	var count = myArray[3];
	
	var year =$('#td_year_'+count).text();
	var month =$('#td_month_'+count).text();
	var desc =$('#td_status_'+count).text();
	var paid =$('#td_paid_'+count).text();
	var date =$('#td_date_'+count).text();
	
		
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
  		xhttp.onreadystatechange = function() {
    		
			if (this.readyState == 4 && this.status == 200) {
				
				document.getElementById('viewInvoice').innerHTML = this.responseText;//MSK-000137
				$('#modalINV1').modal('show');	
				
				
				if(desc == 'Advance'){
					
					$('#trBalance1').hide();
					document.getElementById('spanTotal').innerHTML = 'NaN';
					document.getElementById('spanBalance').innerHTML = 'NaN';
				}
				if(desc == 'Total Salary'){
					$('#trBalance1').hide();
					
				}
				if(desc == 'Balance'){
					$('#trBalance1').show();
					document.getElementById('countBalance1').innerHTML=2;
				}	
					
    		}
			
  		};	
		
    	xhttp.open("GET", "teacher_salary_invoice1.php?index=" + index  + "&desc="+desc + "&paid="+paid + "&year="+year  + "&month="+month  + "&date="+date   , true);												
  		xhttp.send();//MSK-00105-Ajax End
	 
};

function scrollDown(){
	
	window.scrollTo(0,document.body.scrollHeight);
}

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